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
     * Get chinese string length.
     *
     * @param string $string
     * @return int
     */
    public static function length(string $string) : int
    {
        return mb_strlen($string, 'UTF-8');
    }
}
