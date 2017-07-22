<?php

namespace Toolkit\Utility;

/**
 * Class ArrayKit
 *
 * @package Toolkit\Utility
 */
class ArrayKit
{
    /**
     * Get the value by key name in the one-dimensional array.
     *
     * @param array  $array
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function get(array $array, string $key, string $default = '')
    {
        if ($key === null) {
            return $key;
        }

        if (isset($array[$key])) {
            return $array[$key] ?: $default;
        }
    }
}
