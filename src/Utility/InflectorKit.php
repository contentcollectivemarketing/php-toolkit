<?php

namespace Toolkit\Utility;

/**
 * Class InflectorKit
 *
 * @copyright Copyright (c) 2012-2017, XiaoHe Software Foundation, Inc. (http://www.baonahao.com/)
 * @package   Toolkit\Utility
 * @date      2017-08-18 21:27
 * @author    majinyun <majinyun@xiaohe.com>
 */
class InflectorKit
{
    public static function camelize(string $string)
    {

        $subject = ucwords(preg_replace('/[\s_]+/', ' ', $string));
        $substring = mb_substr(str_replace(' ', '', $subject), 1);

        return strtolower($string[0]) . $substring;
    }
}
