<?php

namespace Toolkit\Utility;

use NumberFormatter;

/**
 * Class Number
 *
 * @package Toolkit\Utility
 */
class Number
{
    const EPSILON = 0.00001;

    /**
     * Compare floating point numbers.
     *
     * @param float  $a
     * @param float  $b
     * @param string $operator
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function compare(float $a, float $b, string $operator = '=') : bool
    {
        switch ($operator) {
            case '=':
                // equal
            case 'eq':
                return self::epsilon($a, $b);
            case '<':
                // less than
            case 'lt':
                return self::epsilon($a, $b) ? false : $a < $b;
            case '>':
                // greater than
            case 'gt':
                return self::epsilon($a, $b) ? false : $a > $b;
            case '<=':
                // less than or equal
            case 'lte':
                return self::equalTo($a, $b);
            case '>=':
                // greater than or equal
            case 'gte':
                return self::equalTo($a, $b, true);
            case '<>':
                // not equal
            case '!=':
                // not equal
            case 'ne':
                return self::epsilon($a, $b, true) ? true : false;
            default:
                throw new \InvalidArgumentException('Invalid operator.');
        }
    }

    /**
     * Mobile phone number partial encryption with given placeholder.
     *
     * - Perform a regular expression search and replace
     *
     * ```php
     * $phone = preg_replace('/(\d{3})\d{4}/', "$1{$placeholder}", '12345678901');
     * ```
     *
     * @param string $phone
     * @param string $placeholder
     * @return string
     */
    public static function toPhone(string $phone, string $placeholder = '****') : string
    {
        if (!is_string($phone) || strlen($phone) !== 11) {
            return $phone;
        }

        return (string)substr_replace($phone, $placeholder, 3, 4);
    }

    /**
     * Format a number with grouped thousands.
     *
     * @param float  $number
     * @param int    $decimal
     * @param string $point
     * @return string
     */
    public static function toNumber(
        float $number,
        int $decimal = 2,
        string $point = '.'
    ) : string {
        return number_format($number, $decimal, $point, '');
    }

    /**
     * Format number to decimal forms.
     *
     * - white space and non breaking space question
     *
     * ```php
     * $value = str_replace("\x20", "\xC2\xA0", $value);
     * ```
     *
     * @param float  $money
     * @param int    $precision
     * @param string $currency
     * @return string
     * @see http://dwz.cn/6q4xWs
     */
    public static function toDecimal(
        float $money,
        int $precision = 2,
        string $currency = 'zh-CN'
    ) : string {
        $formatter = new NumberFormatter(
            $currency,
            NumberFormatter::DECIMAL
        );
        $formatter->setAttribute(
            NumberFormatter::FRACTION_DIGITS,
            $precision
        );
        $value = $formatter->format($money);

        return $value;
    }

    /**
     * Format bytes to bytes, kilobytes, megabytes, gigabytes, terabytes, petabytes.
     *
     * - These two will be equivalent as of PHP 5.6.0
     *
     * ```php
     * $bytes /= $base ** $pow;
     * $bytes /= pow($base, $pow);
     *
     * $bytes /= (1 << (10 * $pow));
     * ```
     *
     * @param int    $bytes
     * @param int    $precision
     * @param string $delimiter
     * @param int    $type
     * @return string
     * @link https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
     */
    public static function toBytes(
        int $bytes,
        int $precision = 2,
        string $delimiter = ' ',
        int $type = 1
    ) : string {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $base = 1024;
        $pow = 0;

        if ($type === 1) {
            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log($base));
            $pow = min($pow, count($units) - 1);
            $bytes /= $base ** $pow;
        } else {
            for ($i = 0; $bytes >= $base && $i < 5; $i++) {
                $bytes /= $base;
                $pow++;
            }
        }
        $unit = $units[$pow];

        return round($bytes, $precision) . $delimiter . $unit;
    }

    /**
     * @param float $a
     * @param float $b
     * @param bool  $flag
     * @return bool
     * @throws \InvalidArgumentException
     */
    private static function equalTo(float $a, float $b, $flag = false) : bool
    {
        return self::compare($a, $b, $flag ? '>' : '<')
            || self::compare($a, $b);
    }

    /**
     * @param float $a
     * @param float $b
     * @param bool  $flag
     * @return bool
     */
    private static function epsilon(float $a, float $b, $flag = false) : bool
    {
        $value = abs($a - $b);

        return $flag ? $value > self::EPSILON : $value < self::EPSILON;
    }
}
