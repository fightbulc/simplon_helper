<?php

namespace Simplon\Helper;

/**
 * CastAway
 * @package Simplon\Helper
 * @author  Tino Ehrich (tino@bigpun.me)
 */
class CastAway
{
    /**
     * @param $val
     *
     * @return int|null
     */
    public static function toInt($val)
    {
        return self::hasValue($val) ? (int)trim($val) : null;
    }

    /**
     * @param $val
     *
     * @return null|string
     */
    public static function toString($val)
    {
        return self::hasValue($val) ? (string)trim($val) : null;
    }

    /**
     * @param $val
     *
     * @return bool|null
     */
    public static function toBool($val)
    {
        return self::hasValue($val) ? $val === true : null;
    }

    /**
     * @param $val
     *
     * @return float|null
     */
    public static function toFloat($val)
    {
        return self::hasValue($val) ? (float)trim($val) : null;
    }

    /**
     * @param $val
     *
     * @return array|null
     */
    public static function toArray($val)
    {
        return self::hasValue($val) ? (array)$val : null;
    }

    /**
     * @param $val
     *
     * @return null|object
     */
    public static function toObject($val)
    {
        return self::hasValue($val) ? (object)$val : null;
    }

    /**
     * @param string|null $val
     * @param \DateTimeZone $dateTimeZone
     *
     * @return \DateTime|null
     */
    public static function toDateTime($val, \DateTimeZone $dateTimeZone = null)
    {
        return self::hasValue($val) ? new \DateTime(trim($val), $dateTimeZone) : null;
    }

    /**
     * @param mixed $val
     *
     * @return bool
     */
    private static function hasValue($val)
    {
        return $val !== null && $val !== '';
    }
}