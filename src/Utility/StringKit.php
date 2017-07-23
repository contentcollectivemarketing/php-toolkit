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
}
