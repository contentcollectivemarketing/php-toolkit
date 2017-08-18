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
     * Returns the input string as a camelCasedString.
     *
     * @param string $string
     * @return string
     */
    public static function camelize(string $string) : string
    {

        $subject = ucwords(preg_replace('/[\s_]+/', ' ', $string));
        $substring = mb_substr(str_replace(' ', '', $subject), 1);

        return strtolower($string[0]) . $substring;
    }
}
