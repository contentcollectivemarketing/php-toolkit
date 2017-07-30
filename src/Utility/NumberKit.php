<?php

namespace Toolkit\Utility;

/**
 * Class NumberKit
 *
 * @package Toolkit\Utility
 */
class NumberKit
{
    /**
     * Format bytes to bytes, kilobytes, megabytes, gigabytes, terabytes, petabytes.
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

                // Uncomment one of the following alternatives
                // pow($base, $pow): http://php.net/manual/en/function.pow.php#114389
                $bytes /= $base ** $pow;
                // $bytes /= (1 << (10 * $pow));
                break;
        }
        $unit = in_array($type, [1, 3], true) ? $units[$pow] : $pow;

        return round($bytes, $precision) . $delimiter . $unit;
    }
}