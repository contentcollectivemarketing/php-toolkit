<?php

namespace Toolkit\Utility;

/**
 * Class InflectorKit
 *
 * @package Toolkit\Utility
 */
class InflectorKit
{
    /**
     * Takes multiple words separated by spaces or underscores and camelizes them.
     *
     * @param string $string
     * @return string
     */
    public static function camelize(string $string) : string
    {
        $subject = ucwords(preg_replace('/[\s_]+/', ' ', $string));
        $substring = mb_substr(str_replace(' ', '', $subject), 1);

        return mb_strtolower($string[0]) . $substring;
    }

    /**
     * Takes multiple words separated by the delimiter and changes them to spaces.
     *
     * @param string $string
     * @param string $delimiter
     * @return string
     */
    public static function humanize(string $string, string $delimiter = '_') : string
    {
        $array = explode(' ', str_replace($delimiter, ' ', $string));
        foreach ($array as & $word) {
            $word = mb_strtolower(mb_substr($word, 0, 1)) . mb_substr($word, 1);
        }

        return implode(' ', $array);
    }
}
