<?php

namespace BecworkUtils\Util;

/**
 * Class CookieUtil
 *
 * CookieUtil provides methods for working with cookies
 *
 * @package BecworkUtils\Util
 */
class CookieUtil
{
    /**
     * Set a cookie value
     *
     * @param string $name The name of the cookie
     * @param string $value The value of the cookie
     * @param int $expire The expiration time of the cookie (in seconds)
     * @param string $path The path of the cookie
     * @param string $domain The domain of the cookie
     * @param bool $secure Whether the cookie is secure
     * @param bool $httpOnly Whether the cookie is HTTP only
     *
     * @return void
     */
    public function setCookie(string $name, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httpOnly = false): void
    {
        // set cookie
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    /**
     * Get a cookie value
     *
     * @param string $name The name of the cookie
     *
     * @return string|null The value of the cookie or null if not found
     */
    public function getCookie(string $name): ?string
    {
        // get cookie
        return $_COOKIE[$name] ?? null;
    }

    /**
     * Delete a cookie
     *
     * @param string $name The name of the cookie
     *
     * @return void
     */
    public function deleteCookie(string $name): void
    {
        // delete cookie
        setcookie($name, '', time() - 3600, '/');
    }
}
