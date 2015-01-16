<?php

namespace Simplon\Helper;

/**
 * Helper
 * @package Simplon\Helper
 * @author Tino Ehrich (tino@bigpun.me)
 */
class Helper
{
    /**
     * @param $url
     *
     * @return string
     */
    public static function urlTrim($url)
    {
        return trim($url, '/');
    }

    /**
     * @param $path
     *
     * @return string
     */
    public static function pathTrim($path)
    {
        return rtrim($path, '/');
    }

    /**
     * @param string|array $url
     * @param array $params
     * @param string $paramsKeyPatternLeft
     * @param string $paramsKeyPatternRight
     *
     * @return string
     */
    public static function urlRender($url, array $params = [], $paramsKeyPatternLeft = '{{', $paramsKeyPatternRight = '}}')
    {
        if (is_array($url))
        {
            $parts = [];

            foreach ($url as $val)
            {
                $parts[] = trim($val, '/');
            }

            $url = join('/', $parts);
        }

        foreach ($params as $key => $val)
        {
            $url = str_replace($paramsKeyPatternLeft . $key . $paramsKeyPatternRight, $val, $url);
        }

        return (string)$url;
    }

    /**
     * @param int $length
     * @param null $prefix
     * @param null $customCharacters
     *
     * @return string
     */
    public static function stringCreateRandomToken($length = 12, $prefix = null, $customCharacters = null)
    {
        $randomString = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // set custom characters
        if ($customCharacters !== null && !empty($customCharacters))
        {
            $characters = $customCharacters;
        }

        // handle prefix
        if ($prefix !== null)
        {
            $prefixLength = strlen($prefix);
            $length -= $prefixLength;

            if ($length < 0)
            {
                $length = 0;
            }
        }

        // generate token
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $prefix . $randomString;
    }

    /**
     * @param $url
     *
     * @return bool|string
     */
    public static function urlGetContents($url)
    {
        // set option to ingore http errors
        $context = stream_context_create([
            'http' => ['ignore_errors' => true],
        ]);

        // fetch contents
        try
        {
            $data = file_get_contents($url, false, $context);
        }
        catch (\Exception $e)
        {
            $data = false;
        }

        if ($data)
        {
            return $data;
        }

        return false;
    }

    /**
     * @param $filePath
     *
     * @return bool|string
     */
    public static function fileGetContent($filePath)
    {
        if (file_exists($filePath))
        {
            return file_get_contents($filePath);
        }

        return false;
    }

    /**
     * @param $binaryData
     * @param null $typeShouldHave
     *
     * @return bool
     */
    public static function fileIsMimeType($binaryData, $typeShouldHave = null)
    {
        if ($typeShouldHave === null)
        {
            return false;
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($binaryData);

        return strpos($mimeType, $typeShouldHave) !== false;
    }

    /**
     * Taken from: https://github.com/alixaxel/phunction/blob/master/phunction/Text.php
     *
     * @param bool $string
     * @param string $slug
     * @param null $extra
     *
     * @return string
     */
    public static function stringUrlable($string = false, $slug = '-', $extra = null)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z' . preg_quote($extra, '~') . ']+~i', $slug, self::stringUnaccent($string)), $slug));
    }

    /**
     * Taken from: https://github.com/alixaxel/phunction/blob/master/phunction/Text.php
     *
     * @param $string
     *
     * @return string
     */
    public static function stringUnaccent($string)
    {
        if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== false)
        {
            $string = html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|caron|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string), ENT_QUOTES, 'UTF-8');
        }

        return (string)$string;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function stringAscii($string)
    {
        $string = str_replace('Ä', 'Ae', $string);
        $string = str_replace('ä', 'ae', $string);
        $string = str_replace('Ü', 'Ue', $string);
        $string = str_replace('ü', 'ue', $string);
        $string = str_replace('Ö', 'Oe', $string);
        $string = str_replace('ö', 'oe', $string);
        $string = iconv("UTF-8", 'ASCII//IGNORE', $string);

        return (string)$string;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function stringTrim($string)
    {
        return (string)preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $string);
    }
}