<?php

namespace BecworkUtils\Util;

/**
 * Class SiteUtil
 *
 * SiteUtil provides functions for retrieving site URL and URI
 *
 * @package BecworkUtils\Util
 */
class SiteUtil
{
    /**
     * Get site URL
     *
     * @return string The site URL
     */
    public function getSiteUrl(): string
    {
        // get site URL
        $siteUrl = 'http://' . $_SERVER['HTTP_HOST'];

        // get site URL
        if ($this->isSsl()) {
            $siteUrl = 'https://' . $_SERVER['HTTP_HOST'];
        }

        // return site URL
        return $siteUrl;
    }

    /**
     * Get site URI
     *
     * @return string The site URI
     */
    public function getUri(): string
    {
        // get URI
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        // return URI
        return $uri;
    }

    /**
     * Check if the site is using HTTPS
     *
     * @return bool True if the site is using HTTPS, false otherwise
     */
    public function isSsl(): bool
    {
        // check if HTTPS header is set and its value is either 1 or 'on'
        return isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 1 || strtolower($_SERVER['HTTPS']) === 'on');
    }
}
