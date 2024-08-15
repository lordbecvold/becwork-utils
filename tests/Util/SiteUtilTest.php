<?php

namespace BecworkUtils\Tests\Util;

use BecworkUtils\Util\SiteUtil;
use PHPUnit\Framework\TestCase;

/**
 * Class SiteUtilTest
 *
 * SiteUtilTest tests the functionality of the SiteUtil class
 *
 * @package BecworkUtils\Tests\Util
 */
class SiteUtilTest extends TestCase
{
    private SiteUtil $siteUtil;

    protected function setUp(): void
    {
        $this->siteUtil = new SiteUtil();
    }

    /**
     * Test getSiteUrlHttp method
     *
     * @return void
     */
    public function testGetSiteUrlHttp(): void
    {
        $_SERVER['HTTP_HOST'] = 'example.com';
        unset($_SERVER['HTTPS']);

        // get result
        $result = $this->siteUtil->getSiteUrl();

        // assert result
        $this->assertEquals('http://example.com', $result);
    }

    /**
     * Test getSiteUrlHttps method
     *
     * @return void
     */
    public function testGetSiteUrlHttps(): void
    {
        $_SERVER['HTTP_HOST'] = 'example.com';
        $_SERVER['HTTPS'] = 'on';

        // get result
        $result = $this->siteUtil->getSiteUrl();

        // assert result
        $this->assertEquals('https://example.com', $result);
    }

    /**
     * Test getUri method
     *
     * @return void
     */
    public function testGetUri(): void
    {
        $_SERVER['REQUEST_URI'] = '/path/to/resource';

        // get result
        $result = $this->siteUtil->getUri();

        // assert result
        $this->assertEquals('/path/to/resource', $result);
    }

    /**
     * Test getUriWhenUriNotSet method
     *
     * @return void
     */
    public function testGetUriWhenUriNotSet(): void
    {
        unset($_SERVER['REQUEST_URI']);

        // get result
        $result = $this->siteUtil->getUri();

        // assert result

        $this->assertEquals('', $result);
    }

    /**
     * Test isSslWhenHttpsOn method
     *
     * @return void
     */
    public function testIsSslWhenHttpsOn(): void
    {
        $_SERVER['HTTPS'] = 'on';

        // get result
        $result = $this->siteUtil->isSsl();

        // assert result
        $this->assertTrue($result);
    }

    /**
     * Test isSslWhenHttpsOff method
     *
     * @return void
     */
    public function testIsSslWhenHttpsOff(): void
    {
        $_SERVER['HTTPS'] = 'off';

        // get result
        $result = $this->siteUtil->isSsl();

        // assert result
        $this->assertFalse($result);
    }

    /**
     * Test isSslWhenHttps1 method
     *
     * @return void
     */
    public function testIsSslWhenHttps1(): void
    {
        $_SERVER['HTTPS'] = '1';

        // get result
        $result = $this->siteUtil->isSsl();

        // assert result
        $this->assertTrue($result);
    }

    /**
     * Test isSslWhenHttpsUnset method
     *
     * @return void
     */
    public function testIsSslWhenHttpsUnset(): void
    {
        unset($_SERVER['HTTPS']);

        // get result
        $result = $this->siteUtil->isSsl();

        // assert result
        $this->assertFalse($result);
    }
}
