<?php

namespace Toolkit\Utility;

use Collator;

/**
 * Class Str.
 *
 * @package Toolkit\Utility
 */
class Str
{
    /**
     * Make a comparison with a string.
     *
     * @param string $a
     * @param string $b
     * @return int
     */
    public static function compare(string $a, string $b) : int
    {
        if (false !== class_exists('Collator')) {
            $collator = new Collator(setlocale(LC_COLLATE, null));

            return $collator->compare($a, $b);
        }

        return strcmp($a, $b);
    }

    /**
     * Make a string uppercase.
     *
     * @param string $string
     * @return string
     */
    public static function toUpper(string $string) : string
    {
        return strtoupper($string);
    }

    /**
     * Make a string lowercase.
     *
     * @param string $string
     * @return string
     */
    public static function toLower(string $string) : string
    {
        return strtolower($string);
    }

    /**
     * Get a decimal code representation of a specific character.
     *
     * @param string $char Character.
     * @return int
     */
    public static function toCode(string $char) : int
    {
        $code = ord($char[0]);
        $bytes = 1;

        if (!($code & 0x80)) { // 0xxxxxxx
            return $code;
        }

        if (($code & 0xe0) === 0xc0) { // 110xxxxx
            $bytes = 2;
            $code &= ~0xc0;
        } elseif (($code & 0xf0) === 0xe0) { // 1110xxxx
            $bytes = 3;
            $code &= ~0xe0;
        } elseif (($code & 0xf8) === 0xf0) { // 11110xxx
            $bytes = 4;
            $code &= ~0xf0;
        }

        for ($i = 2; $i <= $bytes; $i++) {
            $code = ($code << 6) + (ord($char[$i - 1]) & ~0x80);
        }

        return $code;
    }

    /**
     * @param string $string
     * @param string $character
     * @return string
     */
    public static function trim(string $string, string $character = " \t\n\r\0\x0B") : string
    {
        return trim($string, $character);
    }

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

    /**
     * Get string before the first occurrence of the specified character in the string.
     *
     * @param string $string
     * @param string $given
     * @return string
     */
    public static function beforeOfFirst(string $string, string $given) : string
    {
        return self::substr($string, 0, mb_strpos($string, $given));
    }

    /**
     * Get string before the last occurrence of the specified character in the string.
     *
     * @param string $string
     * @param string $given
     * @return string
     */
    public static function beforeOfLast(string $string, string $given) : string
    {
        return self::substr($string, 0, mb_strrpos($string, $given));
    }

    /**
     * Get string after the first occurrence of the specified character in the string.
     *
     * @param string $string
     * @param string $given
     * @return string
     */
    public static function afterOfFirst(string $string, string $given) : string
    {
        if (false !== $pos = mb_strpos($string, $given)) {
            return self::substr($string, $pos + self::length($given));
        }

        return '';
    }

    /**
     * Get string after the last occurrence of the specified character in the string.
     *
     * @param string $string
     * @param string $given
     * @return string
     */
    public static function afterOfLast(string $string, string $given) : string
    {
        if (false !== $pos = mb_strrpos($string, $given)) {
            return self::substr($string, $pos + self::length($given));
        }

        return '';
    }
}
