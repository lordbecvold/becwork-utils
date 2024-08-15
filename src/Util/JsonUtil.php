<?php

namespace BecworkUtils\Util;

use BecworkUtils\Exception\JsonUtilException;

/**
 * Class JsonUtil
 *
 * JsonUtil provides functions for retrieving JSON data from source target
 *
 * @package BecworkUtils\Util
 */
class JsonUtil
{
    public function test(): void
    {
        echo 'test';
    }

    /**
     * Get JSON data from a file or URL
     *
     * @param string $target The file path or URL
     * @param string $method The HTTP method to use
     * @param string $userAgent The user agent to use
     * @param int $timeout The timeout in seconds
     *
     * @return mixed The decoded JSON data
     */
    public function getJson(string $target, string $method = 'GET', string $userAgent = 'becwork-utils', int $timeout = 5): mixed
    {
        // create request context
        $context = stream_context_create([
            'http' => [
                'method' => $method,
                'header' => [
                    'User-Agent: ' . $userAgent
                ],
                'timeout' => $timeout
            ]
        ]);

        // fetch data
        $data = $this->fetchData($target, $context);

        // decode json
        $output = $this->decodeJson($data, $target);

        // return final data output
        return $output;
    }

    /**
     * Fetch data from a file or URL
     *
     * @param string $target The file path or URL
     * @param resource $context The request context
     *
     * @return string The data retrieved from the file or URL
     */
    public function fetchData(string $target, $context): string
    {
        try {
            // fetch data
            $data = file_get_contents($target, false, $context);

            if ($data === false) {
                throw new JsonUtilException('Failed to retrieve data from ' . $target);
            }

            // return data
            return $data;
        } catch (\Exception $e) {
            throw new JsonUtilException('Error fetching data from ' . $target . ': ' . $e->getMessage());
        }
    }

    /**
     * Decode JSON data
     *
     * @param string $data The JSON data to decode
     * @param string $target The file path or URL
     *
     * @return mixed The decoded JSON data
     */
    public function decodeJson(string $data, string $target): mixed
    {
        // decode json
        $decodedData = json_decode($data, true);

        // check for errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonUtilException('Error decoding JSON data from ' . $target . ': ' . json_last_error_msg());
        }

        // return decoded data
        return $decodedData;
    }
}
