<?php

namespace BecworkUtils\Tests\Exception;

use PHPUnit\Framework\TestCase;
use BecworkUtils\Exception\JsonUtilException;

/**
 * Class JsonUtilExceptionTest
 *
 * Tests for json util exception handling
 *
 * @package BecworkUtils\Tests\Exception
 */
class JsonUtilExceptionTest extends TestCase
{
    /**
     * Test creating json util exception
     *
     * @return void
     */
    public function testCreateException(): void
    {
        // create exception
        $exception = new JsonUtilException('Error message');

        // assert result
        $this->assertInstanceOf(JsonUtilException::class, $exception);
        $this->assertEquals('Error message', $exception->getMessage());
    }
}
