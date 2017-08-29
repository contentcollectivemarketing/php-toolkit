<?php

namespace Toolkit\Utility;

/**
 * Class Text.
 *
 * @package Toolkit\Utility
 */
class Text
{
    /**
     * Generate a random UUID.
     *
     * @return string
     */
    public static function uuid() : string
    {
        return sprintf(
            '%08x-%04x-%04x-%04x-%04x%08x',
            random_int(0, 16777215),
            random_int(0, 65535),
            random_int(0, 65535),
            random_int(0, 65535),
            random_int(0, 65535),
            random_int(0, 16777215)
        );
    }
}
