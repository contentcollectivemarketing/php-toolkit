<?php

namespace Toolkit\Utility;

/**
 * Class StringKit
 *
 * @package Toolkit\Utility
 */
class StringKit
{
    /**
     * Get string length.
     *
     * @param string $string
     * @return int
     */
    public static function length(string $string) : int
    {
        return mb_strlen($string, 'UTF-8');
    }

    /**
     * Get part of string.
     *
     * @param string   $string
     * @param int      $start
     * @param int|null $length
     * @return string
     */
    public static function substr(string $string, int $start, int $length = null) : string
    {
        if ($length === null) {
            $length = self::length($string);
        }

        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * Get part of string that intercepts the fixed length.
     *
     * @param string $string
     * @param int    $length
     * @param string $placeholder
     * @return string
     */
    public static function truncate($string, $length = 15, $placeholder = '...') : string
    {
        if (self::length($string) >= ($length + 1)) {
            $string = self::substr($string, 0, $length) . $placeholder;
        }

        return $string;
    }
}
