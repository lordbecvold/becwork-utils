<?php

namespace BecworkUtils\Tests\Util;

use PHPUnit\Framework\TestCase;
use BecworkUtils\Util\CookieUtil;

/**
 * Class CookieUtilTest
 *
 * CookieUtilTest provides tests for CookieUtil
 *
 * @package BecworkUtils\Util
 */
class CookieUtilTest extends TestCase
{
    private CookieUtil $cookieUtil;

    protected function setUp(): void
    {
        $this->cookieUtil = new CookieUtil();
        $_COOKIE = [];
    }

    /**
     * Test set cookie
     *
     * @return void
     */
    public function testSetCookie(): void
    {
        // testing cookie data
        $name = 'test_cookie';
        $value = 'test_value';
        $expire = time() + 3600;

        // check if cookie is not set
        $this->assertNull($this->cookieUtil->getCookie($name));

        // set cookie
        $this->cookieUtil->setCookie($name, $value, $expire);

        // simulate browser setting cookie value in $_COOKIE
        $_COOKIE[$name] = $value;

        // assert that cookie is set
        $this->assertSame($value, $this->cookieUtil->getCookie($name));
    }

    /**
     * Test get cookie
     *
     * @return void
     */
    public function testGetCookie(): void
    {
        // testing cookie data
        $name = 'test_cookie';
        $value = 'test_value';

        // simulate cookie existence
        $_COOKIE[$name] = $value;

        // assert that method returns correct value
        $this->assertSame($value, $this->cookieUtil->getCookie($name));
    }

    /**
     * Test get cookie not found
     *
     * @return void
     */
    public function testGetCookieNotFound(): void
    {
        // testing cookie data
        $name = 'non_existent_cookie';

        // assert that method returns null, if cookie does not exist
        $this->assertNull($this->cookieUtil->getCookie($name));
    }

    /**
     * Test delete cookie
     *
     * @return void
     */
    public function testDeleteCookie(): void
    {
        // testing cookie data
        $name = 'test_cookie';
        $value = 'test_value';

        // simulate cookie existence
        $_COOKIE[$name] = $value;

        // assert that cookie is set
        $this->assertSame($value, $this->cookieUtil->getCookie($name));

        // delete cookie
        $this->cookieUtil->deleteCookie($name);

        // simulate browser deleting cookie value in $_COOKIE
        unset($_COOKIE[$name]);

        // assert that cookie is deleted
        $this->assertNull($this->cookieUtil->getCookie($name));
    }
}
