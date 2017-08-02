<?php

namespace Toolkit\Utility;

/**
 * Class NumKit
 *
 * @package Toolkit\Utility
 */
class NumberKit
{
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
        $epsilon = 0.00001;
        $a = (float)$a;
        $b = (float)$b;

        $func = function ($type = false) use ($a, $b, $epsilon) {
            $value = abs($a - $b);

            return $type ? $value > $epsilon : $value < $epsilon;
        };

        switch ($operator) {
            case '=':
                // equal
            case 'eq':
                return $func();
            case '<':
                // less than
            case 'lt':
                return $func() ? false : $a < $b ? true : false;
            case '<=':
                // less than or equal
            case 'lte':
                if (self::compare($a, $b, '<') || self::compare($a, $b)) {
                    return true;
                }
            case '>':
                // greater than
            case 'gt':
                return $func() ? false : $a > $b ? true : false;
            case '>=':
                // greater than or equal
            case 'gte':
                if (self::compare($a, $b, '>') || self::compare($a, $b)) {
                    return true;
                }
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
     * @param mixed  $phone
     * @param string $placeholder
     * @param int    $type
     * @return string
     */
    public static function toPhone(
        $phone,
        string $placeholder = '****',
        int $type = 1
    ) : string {
        if (!is_numeric($phone) || strlen($phone) !== 11) {
            return $phone;
        }

        if ($type === 1) {
            $phone = substr_replace($phone, $placeholder, 3, 4);
        } else {
            $phone = preg_replace('/(\d{3})\d{4}/', "$1{$placeholder}", $phone);
        }

        return $phone;
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
     * Format number to RMB forms.
     *
     * @param mixed $money
     * @param int   $precision
     * @return string
     */
    public static function toMoney($money, int $precision = 2) : string
    {
        setlocale(LC_ALL, 'zh_CN.UTF-8');
        $format = '%.' . $precision . 'n';

        return money_format($format, $money);
    }

    /**
     * Format bytes to bytes, kilobytes, megabytes, gigabytes, terabytes, petabytes.
     *
     * - `These two will be equivalent as of PHP 5.6.0`
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
        switch ($type) {
            case 2:
                foreach ($units as $pow) {
                    if ($bytes >= $base) {
                        $bytes /= $base;
                        continue;
                    }
                    break;
                }
                break;
            case 3:
                for ($i = 0, $pow = 0; $bytes >= $base && $i < 5; $i++, $pow++) {
                    $bytes /= $base;
                }
                break;
            default:
                $bytes = max($bytes, 0);
                $pow = floor(($bytes ? log($bytes) : 0) / log($base));
                $pow = min($pow, count($units) - 1);
                $bytes /= $base ** $pow;
                break;
        }
        $unit = in_array($type, [1, 3], true) ? $units[$pow] : $pow;

        return round($bytes, $precision) . $delimiter . $unit;
    }
}
