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
     * Set an array item to a given value using key.
     *
     * @param array $array
     * @param mixed $key
     * @param null  $val
     * @return array
     */
    public static function set(array & $array, $key, $val = null) : array
    {
        if (null === $key) {
            return $array;
        }

        $array[$key] = $val;

        return $array;
    }

    /**
     * Add an array item to a given value using key.
     *
     * @param array $array
     * @param mixed $key
     * @param null  $val
     * @return array
     */
    public static function add(array $array, $key, $val = null) : array
    {
        if (null === static::get($array, $key)) {
            static::set($array, $key, $val);
        }

        return $array;
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

    /**
     * Strip whitespace an array item from an given array.
     *
     * @param array $array
     * @return array
     */
    public static function trim(array $array) : array
    {
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = static::trim($val);
            } elseif (is_string($val)) {
                $array[$key] = trim($val);
            }
        }

        return $array;
    }
}
