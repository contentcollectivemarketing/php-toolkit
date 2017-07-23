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
     * Get an item from an array using key.
     *
     * @param array $array
     * @param mixed $key
     * @param null  $default
     * @return null|mixed
     */
    public static function get(array $array, $key, $default = null)
    {
        if ($key === null) {
            return $array;
        }

        if (static::exists($array, $key)) {
            return $array[$key] ?: $default;
        }
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @param array $array
     * @param mixed $key
     * @return bool
     */
    public static function exists(array $array, $key) : bool
    {
        return array_key_exists($key, $array);
    }
}
