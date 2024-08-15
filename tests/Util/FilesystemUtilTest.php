<?php

namespace BecworkUtils\Tests\Util;

use Exception;
use PHPUnit\Framework\TestCase;
use BecworkUtils\Util\FilesystemUtil;

/**
 * Class FilesystemUtilTest
 *
 * Test class for FilesystemUtil class
 *
 * @package BecworkUtils\Util\Tests
 */
class FilesystemUtilTest extends TestCase
{
    private FilesystemUtil $filesystemUtil;

    protected function setUp(): void
    {
        $this->filesystemUtil = new FilesystemUtil();
    }

    /**
     * Test getFilesList() method
     *
     * @return void
     */
    public function testGetFilesListDirectoryNotFound(): void
    {
        // expect exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("The path provided is not a directory.");

        // call method
        $this->filesystemUtil->getFilesList('/invalid/path');
    }

    /**
     * Test getFilesList() method
     *
     * @return void
     */
    public function testGetFilesList(): void
    {
        // call method
        $result = $this->filesystemUtil->getFilesList('/');

        // assert result
        $this->assertIsArray($result);
    }

    /**
     * Test isFileExecutable() method
     *
     * @return void
     */
    public function testIsFileExecutableFileNotFound(): void
    {
        // assert not found file
        $this->assertFalse($this->filesystemUtil->isFileExecutable('/nonexist/path/089879GZV'));
    }

    /**
     * Test isFileExecutable() method
     *
     * @return void
     */
    public function testIsFileExecutable(): void
    {
        // assert not executable file
        $this->assertTrue($this->filesystemUtil->isFileExecutable('/bin/cat'));
    }

    /**
     * Test isFileExecutable() method
     *
     * @return void
     */
    public function testIsFileExecutableNotExecutable(): void
    {
        // assert not executable file
        $this->assertFalse($this->filesystemUtil->isFileExecutable('/usr/lib/os-release'));
    }

    /**
     * Test getFileContent() method
     *
     * @return void
     */
    public function testGetFileContentFileNotFound(): void
    {
        // expect exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("error opening file: /invalid/path/089879GZV does not exist");

        // call method
        $this->filesystemUtil->getFileContent('/invalid/path/089879GZV');
    }

    /**
     * Test getFileContent() method
     *
     * @return void
     */
    public function testGetFileContent(): void
    {
        // get file content
        $result = $this->filesystemUtil->getFileContent('/usr/lib/os-release');

        // assert result
        $this->assertIsString($result);
    }

    /**
     * Test getFileContent() method
     *
     * @return void
     */
    public function testGetFileContentDirectoryOrLink(): void
    {
        // set test directory
        $testDir = __DIR__;

        // expect exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("error opening file: $testDir is a directory or a link");

        // call method
        $this->filesystemUtil->getFileContent($testDir);
    }
}
