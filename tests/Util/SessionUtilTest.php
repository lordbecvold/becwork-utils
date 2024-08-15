<?php

namespace BecworkUtils\Tests\Util;

use PHPUnit\Framework\TestCase;
use BecworkUtils\Util\SessionUtil;

/**
 * Class SessionUtilTest
 *
 * SessionUtilTest tests the functionality of the SessionUtil class
 *
 * @package BecworkUtils\Tests\Util
 */
class SessionUtilTest extends TestCase
{
    private SessionUtil $sessionUtil;

    protected function setUp(): void
    {
        $this->sessionUtil = new SessionUtil();

        // simulate session environment
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = []; // reset $_SESSION before each test
    }

    /**
     * Test startSession method
     *
     * @return void
     */
    public function testStartSession(): void
    {
        // assert that session was not started
        $this->assertSame(PHP_SESSION_NONE, session_status());

        // start session
        $this->sessionUtil->startSession();

        // assert that session was started
        $this->assertSame(PHP_SESSION_ACTIVE, session_status());
    }

    /**
     * Test destroySession method
     *
     * @return void
     */
    public function testDestroySession(): void
    {
        // start session
        $this->sessionUtil->startSession();

        // assert that session is active
        $this->assertSame(PHP_SESSION_ACTIVE, session_status());

        // destroy session
        $this->sessionUtil->destroySession();

        // assert that session was destroyed
        $this->assertSame(PHP_SESSION_NONE, session_status());
    }

    /**
     * Test setSession method
     *
     * @return void
     */
    public function testSetSession(): void
    {
        // testing session data
        $name = 'test_session';
        $value = 'test_value';

        // set session data
        $this->sessionUtil->setSession($name, $value);

        // assert that session data was set
        $this->assertSame($value, $_SESSION[$name]);
    }

    /**
     * Test getSession method
     *
     * @return void
     */
    public function testGetSession(): void
    {
        // testing session data
        $name = 'test_session';
        $value = 'test_value';

        // simulate session data
        session_start();
        $_SESSION[$name] = $value;

        // assert that session data was retrieved
        $this->assertSame($value, $this->sessionUtil->getSession($name));
    }

    /**
     * Test getSessionNotFound method
     *
     * @return void
     */
    public function testGetSessionNotFound(): void
    {
        // testing session data
        $name = 'non_existent_session';

        // assert that session data was not retrieved
        $this->assertNull($this->sessionUtil->getSession($name));
    }

    /**
     * Test deleteSession method
     *
     * @return void
     */
    public function testDeleteSession(): void
    {
        // testing session data
        $name = 'test_session';
        $value = 'test_value';

        // simulate session data
        session_start();
        $_SESSION[$name] = $value;

        // assert that session data was set
        $this->assertSame($value, $_SESSION[$name]);

        // delete session data
        $this->sessionUtil->deleteSession($name);

        // assert that session data was deleted
        $this->assertArrayNotHasKey($name, $_SESSION);
    }
}
