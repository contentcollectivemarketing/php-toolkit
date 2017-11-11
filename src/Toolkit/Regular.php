<?php

namespace Toolkit;

class Regular
{
    /**
     * Regular expression.
     *
     * @var array
     */
    private static $patterns = [
        /**
         * 邮箱
         */
        'email'        => '/^\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',

        /**
         * 密码
         */
        'password'     => '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(?=\S+$).{6,}$/',

        /**
         * 大陆手机号码
         *
         * 13[0-9], 14[5,7], 15[0, 1, 2, 3, 5, 6, 7, 8, 9], 17[0, 1, 6, 7, 8], 18[0-9]
         *
         * 移动号段: 134,135,136,137,138,139,147,150,151,152,157,158,159,170,178,182,183,184,187,188
         * 联通号段: 130,131,132,145,155,156,170,171,175,176,185,186
         * 电信号段: 133,149,153,170,173,177,180,181,189
         *
         * <code>
         * /^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/
         * </code>
         */
        'phone'        => '/^(?=\d{11}$)^1(?:3\d|4[57]|5[^4\D]|7[^249\D]|8\d)\d{8}$/',

        /**
         * 中文
         */
        'chinese'      => '/^[\x{4e00}-\x{9fa5}]+$/u',

        /**
         * 中国移动: China Mobile
         *
         * 134,135,136,137,138,139,147,150,151,152,157,158,159,170,178,182,183,184,187,188
         *
         * <code>
         * /^1(3[4-9]|4[7]|5[0-27-9]|7[08]|8[2-478])\\d{8}$/
         * </code>
         */
        'cm'           => '/^(?=\d{11}$)^1((?:3(?!49)[4-9\D]|47|5[012789]|7[8]|8[23478])\d{8}$|70[356]\d{7}$)/',

        /**
         * 中国联通: China Unicom
         *
         * 130,131,132,145,155,156,170,171,175,176,185,186
         *
         * <code>
         * /^1(3[0-2]|4[5]|5[56]|7[0156]|8[56])\\d{8}$/
         * </code>
         */
        'cu'           => '/^(?=\d{11}$)^1((?:3[0-2]|45|5[56]|7[156]|8[56])\d{8}$|70[4789]\d{7}$)/',

        /**
         * 中国电信: China Telecom
         *
         * 133,149,153,170,173,177,180,181,189
         *
         * <code>
         * /^1(3[3]|4[9]|53|7[037]|8[019])\\d{8}$/
         * </code>
         */
        'ct'           => '/^(?=\d{11}$)^1(?:(?:33|49|53|7[37]|8[019])\d{8}$|(?:349|70[0-2])\d{7}$)/',

        /**
         * 大陆身份证
         */
        'idcard'       => '/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/',

        /**
         * 腾讯 QQ
         */
        'qq'           => '/^[1-9][0-9]{4,10}$/',

        /**
         * 大陆座机电话号码
         */
        'tel'          => '',

        /**
         * 颜色代码
         */
        'colorHexCode' => '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',

        /**
         * IPv4
         */
        'ipv4'         => '/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d))))$/',
    ];

    /**
     * Get regular expression.
     *
     * @param string $key
     *
     * @return string
     */
    public static function get(string $key) : string
    {
        return self::$patterns[$key] ?? '';
    }

    /**
     * Verify the email address.
     *
     * @param string $email
     *
     * @return bool
     */
    public static function isEmail(string $email) : bool
    {
        return self::match(self::get('email'), $email);
    }

    /**
     * Verify the mobile phone number.
     *
     * @param string|int $phone
     *
     * @return bool
     */
    public static function isPhone($phone) : bool
    {
        return self::match(self::get('phone'), $phone);
    }

    /**
     * Verify the string
     *
     * @param string $chinese
     *
     * @return bool
     */
    public static function isChinese(string $chinese) : bool
    {
        return self::match(self::get('chinese'), $chinese);
    }

    /**
     * Verify the china mobile phone number.
     *
     * @param string|int $phone
     *
     * @return bool
     */
    public static function isChinaMobile($phone) : bool
    {
        return self::match(self::get('cm'), $phone);
    }

    /**
     * Verify the china unicom phone number.
     *
     * @param string|int $phone
     *
     * @return bool
     */
    public static function isChinaUnicom($phone) : bool
    {
        return self::match(self::get('cu'), $phone);
    }

    /**
     * Verify the china telecom phone number.
     *
     * @param string|int $phone
     *
     * @return bool
     */
    public static function isChinaTelecom($phone) : bool
    {
        return self::match(self::get('ct'), $phone);
    }

    /**
     * Verify the identity card.
     *
     * @param string $idCard
     *
     * @return bool
     */
    public static function isIdCard(string $idCard) : bool
    {
        return self::match(self::get('idcard'), $idCard);
    }

    /**
     * Verify the qq number.
     *
     * @param int $qq
     *
     * @return bool
     */
    public static function isQq(int $qq) : bool
    {
        return self::match(self::get('qq'), $qq);
    }

    /**
     * Verify the code hex code.
     *
     * @param string $code
     *
     * @return bool
     */
    public static function isColorHexCode(string $code) : bool
    {
        return self::match(self::get('colorHexCode'), $code);
    }

    /**
     * Verify the IPv4 address.
     *
     * @param string $ip
     *
     * @return bool
     */
    public static function isIpv4(string $ip) : bool
    {
        return self::match(self::get('ipv4'), $ip);
    }

    /**
     * Perform a regular expression match.
     *
     * @param string $pattern
     * @param mixed  $subject
     *
     * @return bool
     */
    protected static function match(string $pattern, $subject) : bool
    {
        return (bool)preg_match($pattern, $subject);
    }
}
