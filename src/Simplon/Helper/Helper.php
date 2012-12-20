<?php

  namespace Simplon\Helper;

  class Helper
  {
    /**
     * @return int
     */
    public static function timeGetUnix()
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

    // ##########################################

    /**
     * Create unique id
     *
     * @return string
     */
    public static function idCreateUnique()
    {
      return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }

    // ##########################################

    /**
     * Create short unique id
     *
     * @param $id
     * @return string
     */
    public static function idCreateShortUnique($id = NULL)
    {
      $short_id = base_convert($id, 10, 36);
      $uuid = self::idCreateUnique();
      $uuid = str_replace("-", "", $uuid);

      if(strlen($short_id) <= 10)
      {
        $short_id = $short_id . substr($uuid, 0, 10 - strlen($short_id));
      }

      return $short_id;
    }

    // ##########################################

    /**
     * Create short reference id
     *
     * @param $number
     * @return string
     */
    public static function idCreateShortReferenceByNumber($number)
    {
      return base_convert($number, 10, 36);
    }

    // ##########################################

    /**
     * @param $filePath
     * @return bool|string
     */
    public static function fileRead($filePath)
    {
      if(file_exists($filePath))
      {
        return join('', file($filePath));
      }

      return FALSE;
    }
  }
