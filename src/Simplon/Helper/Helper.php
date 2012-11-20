<?php

  namespace Simplon\Helper;

  class Helper
  {
    /**
     * @return int
     */
    public static function getUnixTime()
    {
      return time();
    }

    // ##########################################

    /**
     * @param $url
     * @return string
     */
    public static function urlTrim($url)
    {
      return trim($url, '/');
    }

    // ##########################################

    /**
     * @param $json
     * @return mixed
     */
    public static function jsonDecodeAsArray($json)
    {
      return json_decode($json, TRUE);
    }
  }
