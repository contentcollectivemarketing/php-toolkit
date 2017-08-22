<?php

namespace Toolkit\Utility;

/**
 * Class NumKit
 *
 * @package Toolkit\Utility
 */
class NumberKit
{
    const EPSILON = 0.00001;

    /**
     * Currency Formats.
     *
     * @var array
     */
    private static $currencies = [
        'CNY' => [
            'code'              => 'CNY',
            'title'             => 'China Yuan Renminbi',
            'symbol'            => 'CN¥',
            'precision'         => 2,
            'thousandSeparator' => ',',
            'decimalSeparator'  => '.',
            'symbolPlacement'   => 'before'
        ],
        'EUR' => [
            'code'              => 'EUR',
            'title'             => 'Euro',
            'symbol'            => ' €',
            'precision'         => 2,
            'thousandSeparator' => '.',
            'decimalSeparator'  => ',',
            'symbolPlacement'   => 'after'
        ],
        'USD' => [
            'code'              => 'USD',
            'title'             => 'US Dollar',
            'symbol'            => '$',
            'precision'         => 2,
            'thousandSeparator' => ',',
            'decimalSeparator'  => '.',
            'symbolPlacement'   => 'before'
        ],
    ];

    /**
     * Compare floating point numbers.
     *
     * @param mixed  $a
     * @param mixed  $b
     * @param string $operator
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function compare($a, $b, string $operator = '=') : bool
    {
        $a = (float)$a;
        $b = (float)$b;

        $func = function ($type = false) use ($a, $b) {
            $value = abs($a - $b);

            return $type ? $value > self::EPSILON : $value < self::EPSILON;
        };

        switch ($operator) {
            case '=':
                // equal
            case 'eq':
                return $func();
            case '<':
                // less than
            case 'lt':
                return $func() ? false : $a < $b;
            case '>':
                // greater than
            case 'gt':
                return $func() ? false : $a > $b;
            case '<=':
                // less than or equal
            case 'lte':
                // less than or equal
            case '>=':
                // greater than or equal
            case 'gte':
                $flag = in_array($operator, ['>=', 'gte'], true);

                return self::compare($a, $b, $flag ? '>' : '<')
                    || self::compare($a, $b);
            case '<>':
                // not equal
            case '!=':
                // not equal
            case 'ne':
                return $func(true) ? true : false;
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
     * @param mixed  $number
     * @param int    $decimal
     * @param string $point
     * @return string
     */
    public static function toNumber($number, int $decimal = 2, string $point = '.') : string
    {
        return number_format($number, $decimal, $point, '');
    }

    /**
     * Format number to decimal forms.
     *
     * @param float  $money
     * @param int    $precision
     * @param string $currency
     * @return string
     */
    public static function toDecimal(float $money, int $precision = 2, string $currency = 'zh-CN') : string
    {
        $formatter = new \NumberFormatter(
            $currency,
            \NumberFormatter::CURRENCY
        );
        $formatter->setAttribute(
            \NumberFormatter::FRACTION_DIGITS,
            $precision
        );
        $value = (string)$formatter->format($money);
        $value = str_replace("\x20", "\xC2\xA0", $value);

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
}
