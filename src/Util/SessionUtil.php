<?php

namespace BecworkUtils\Util;

/**
 * Class SessionUtil
 *
 * SessionUtil provides methods for working with sessions
 *
 * @package BecworkUtils\Util
 */
class SessionUtil
{
    /**
     * Start a session
     *
     * @return void
     */
    public function startSession(): void
    {
        if (session_status() == PHP_SESSION_NONE && (!headers_sent())) {
            session_start();
        }
    }

    /**
     * Destroy the current session and start a new one
     *
     * @return void
     */
    public function destroySession(): void
    {
        $this->startSession();
        if (session_status() == PHP_SESSION_ACTIVE && (!headers_sent())) {
            session_destroy();
        }
    }

    /**
     * Set a session value
     *
     * @param string $name The name of the session
     * @param string $value The value of the session
     *
     * @return void
     */
    public function setSession(string $name, string $value): void
    {
        // start session
        $this->startSession();

        // set session
        $_SESSION[$name] = $value;
    }

    /**
     * Get a session value
     *
     * @param string $name The name of the session
     *
     * @return string|null The value of the session or null if not found
     */
    public function getSession(string $name): ?string
    {
        // start session
        $this->startSession();

        // get session
        return $_SESSION[$name] ?? null;
    }

    /**
     * Delete a session value
     *
     * @param string $name The name of the session
     *
     * @return void
     */
    public function deleteSession(string $name): void
    {
        // start session
        $this->startSession();

        // delete session
        unset($_SESSION[$name]);
    }
}
