<?php

namespace Simplon\Helper;

/**
 * DataIterator
 * @package Simplon\Helper
 * @author Tino Ehrich (tino@bigpun.me)
 */
class DataIterator
{
    /**
     * @param array $data
     * @param callable $closure
     * @param bool $withKey
     *
     * @return array
     */
    public static function iterate(array $data, \Closure $closure, $withKey = false)
    {
        $responses = [];

        foreach ($data as $key => $value)
        {
            if ($withKey === true)
            {
                $responses[] = $closure($key, $value);
            }
            else
            {
                $responses[] = $closure($value);
            }
        }

        return $responses;
    }
}