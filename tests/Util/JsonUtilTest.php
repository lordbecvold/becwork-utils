<?php

namespace BecworkUtils\Tests\Util;

use Exception;
use PHPUnit\Framework\TestCase;
use BecworkUtils\Util\JsonUtil;

/**
 * Class JsonUtilTest
 *
 * Tests for json util
 *
 * @package BecworkUtils\Tests\Util
 */
class JsonUtilTest extends TestCase
{
    private JsonUtil $jsonUtil;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jsonUtil = new JsonUtil();
    }

    /**
     * Test getting json data
     *
     * @return void
     */
    public function testGetJsonSuccess(): void
    {
        // mock fetchData and decodeJson methods
        $mock = $this->getMockBuilder(JsonUtil::class)->onlyMethods(['fetchData', 'decodeJson'])->getMock();
        $mock->method('fetchData')->willReturn('{"key":"value"}');
        $mock->method('decodeJson')->willReturn(['key' => 'value']);

        // get json data
        $result = $mock->getJson('http://example.com');

        // assert result
        $this->assertEquals(['key' => 'value'], $result);
    }

    /**
     * Test fetching data
     *
     * @return void
     */
    public function testFetchDataSuccess(): void
    {
        // create context
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: becwork-utils-unit-test fetchData success'
                ],
                'timeout' => 5
            ]
        ]);

        $mock = $this->getMockBuilder(JsonUtil::class)->onlyMethods(['fetchData'])->getMock();

        // mock fetchData to return JSON string
        $mock->method('fetchData')->willReturn('{"key":"value"}');

        // fetch data
        $result = $mock->fetchData('http://example.com', $context);

        // assert result
        $this->assertEquals('{"key":"value"}', $result);
    }

    /**
     * Test fetching data failure
     *
     * @return void
     */
    public function testFetchDataFailure(): void
    {
        // create context
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: becwork-utils-unit-test fetchData failure'
                ],
                'timeout' => 5
            ]
        ]);

        // expect exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Failed to retrieve data from http://example.com');

        // mock fetchData to throw JsonUtilException
        $mock = $this->getMockBuilder(JsonUtil::class)->onlyMethods(['fetchData'])->getMock();
        $mock->method('fetchData')->willThrowException(new Exception('Failed to retrieve data from http://example.com'));

        // fetch data
        $mock->fetchData('http://example.com', $context);
    }

    /**
     * Test decoding json data
     *
     * @return void
     */
    public function testDecodeJsonSuccess(): void
    {
        $data = '{"key":"value"}';
        $target = 'http://example.com';

        // decode json data
        $result = $this->jsonUtil->decodeJson($data, $target);

        // assert result
        $this->assertEquals(['key' => 'value'], $result);
    }

    /**
     * Test decoding json data failure
     *
     * @return void
     */
    public function testDecodeJsonFailure(): void
    {
        // expect exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Error decoding JSON data from http://example.com: Syntax error');

        // mock decodeJson to throw JsonUtilException
        $mock = $this->getMockBuilder(JsonUtil::class)->onlyMethods(['decodeJson'])->getMock();
        $mock->method('decodeJson')->willThrowException(new Exception('Error decoding JSON data from http://example.com: Syntax error'));

        // call json decode method
        $mock->decodeJson('invalid json', 'http://example.com');
    }
}
