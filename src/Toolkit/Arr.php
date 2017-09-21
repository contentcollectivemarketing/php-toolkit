<?php

namespace Toolkit;

class Arr
{
    /**
     * Get an item from an array using key.
     *
     * @param array      $array
     * @param mixed      $key
     * @param null|mixed $default
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
     * @param array      $array
     * @param mixed      $key
     * @param null|mixed $val
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
     * @param array      $array
     * @param mixed      $key
     * @param null|mixed $val
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
     * Builds a map (key-value pairs) from a multidimensional
     * array or an array of objects.
     *
     * @param array      $array
     * @param string     $from
     * @param string     $to
     * @param null|mixed $group
     * @return array
     */
    public static function map(
        array $array,
        string $from,
        string $to,
        $group = null
    ) : array {
        $result = [];
        foreach ($array as $item) {
            $key = static::get($item, $from);
            $val = static::get($item, $to);
            if (null !== $group) {
                $result[static::get($item, $group)][$key] = $val;
            } else {
                $result[$key] = $val;
            }
        }

        return $result;
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
     * Divide an array into two arrays. One with keys and
     * the other with values.
     *
     * @param array $array
     * @return array
     */
    public static function divide(array $array) : array
    {
        return [array_keys($array), array_values($array)];
    }

    /**
     * Get a subset of the items from the given array.
     *
     * @param array        $array
     * @param array|string $key
     * @return array
     */
    public static function only(array $array, $key) : array
    {
        return array_intersect_key($array, array_flip((array)$key));
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
