<?php

namespace BecworkUtils\Util;

use Exception;

/**
 * Class FilesystemUtil
 *
 * This class is responsible for handling filesystem related operations
 *
 * @package BecworkUtils\Util
 */
class FilesystemUtil
{
    /**
     * Returns a list of files and directories in the specified path
     *
     * @param string $path The path to list files and directories
     *
     * @return array<array<mixed>> The list of files and directories
     */
    public function getFilesList(string $path): array
    {
        $files = [];

        if (!is_dir($path)) {
            throw new Exception("The path provided is not a directory.");
        }

        // get items
        $items = scandir($path);

        // check items is set
        if ($items === false) {
            throw new Exception('error get files list: ' . $path);
        }

        // scan the directory
        $items = array_diff($items, ['.', '..']);

        // get file and directory information
        foreach ($items as $item) {
            $fullPath = $path . DIRECTORY_SEPARATOR . $item;

            if (is_file($fullPath) || is_dir($fullPath)) {
                $files[] = [
                    'name' => $item,
                    'size' => is_file($fullPath) ? filesize($fullPath) : 0,
                    'permissions' => substr(sprintf('%o', fileperms($fullPath)), -4),
                    'isDir' => is_dir($fullPath),
                    'path' => realpath($fullPath),
                ];
            }
        }

        // sort the files and directories
        usort($files, function ($a, $b) {
            // sort directories first
            if ($a['isDir'] && !$b['isDir']) {
                return -1;
            } elseif (!$a['isDir'] && $b['isDir']) {
                return 1;
            }

            // sort by filename
            return strcasecmp($a['name'], $b['name']);
        });

        return $files;
    }

    /**
     * Checks if the file is executable
     *
     * @param string $path The path to the file
     *
     * @return bool True if the file is executable, false otherwise
     */
    public function isFileExecutable(string $path): bool
    {
        // check file exists
        if (!file_exists($path)) {
            return false;
        }

        // check if path is directory
        if (is_dir($path) || is_link($path)) {
            return false;
        }

        // get file info
        $fileInfo = exec('sudo file ' . $path);

        // check file info is set
        if (!$fileInfo) {
            // handle the error
            throw new Exception('error get file info: ' . $path . ' file info detection failed');
        }

        // check if the file type is supported
        if (strpos($fileInfo, 'executable')) {
            return true;
        }

        return false;
    }

    /**
     * Returns the contents of a file
     *
     * @param string $path The path to the file
     *
     * @return string|null The file content or null if the file does not exist
     */
    public function getFileContent(string $path): ?string
    {
        // check file exists
        if (!file_exists($path)) {
            throw new Exception('error opening file: ' . $path . ' does not exist');
        }

        try {
            // check if path is directory
            if (is_dir($path) || is_link($path)) {
                // handle the error
                throw new Exception('error opening file: ' . $path . ' is a directory or a link');
            }

            // get the file content
            $fileContent = shell_exec('sudo cat ' . escapeshellarg($path));

            // check file content is set
            if (!$fileContent) {
                // handle the error
                throw new Exception('error opening file: ' . $path);
            }

            // return the file content
            return $fileContent;
        } catch (\Exception $e) {
            // handle the error
            throw new Exception('error opening file: ' . $e->getMessage());
        }
    }
}
