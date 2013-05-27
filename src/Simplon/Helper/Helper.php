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
         *
         * @return string
         */
        public static function urlTrim($url)
        {
            return trim($url, '/');
        }

        // ##########################################

        /**
         * @param $url
         *
         * @return bool|string
         */
        public static function urlGetContents($url)
        {
            // set option to ingore http errors
            $context = stream_context_create([
                'http' => ['ignore_errors' => TRUE],
            ]);

            // fetch contents
            try
            {
                $data = file_get_contents($url, FALSE, $context);
            }
            catch (\Exception $e)
            {
                $data = FALSE;
            }

            if ($data)
            {
                return $data;
            }

            return FALSE;
        }

        // ##########################################

        /**
         * @param $path
         *
         * @return string
         */
        public static function pathTrim($path)
        {
            return rtrim($path, '/');
        }

        // ##########################################

        /**
         * @param $json
         *
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
         *
         * @return string
         */
        public static function idCreateShortUnique($id = NULL)
        {
            $short_id = base_convert($id, 10, 36);
            $uuid = self::idCreateUnique();
            $uuid = str_replace("-", "", $uuid);

            if (strlen($short_id) <= 10)
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
         *
         * @return string
         */
        public static function idCreateShortReferenceByNumber($number)
        {
            return base_convert($number, 10, 36);
        }

        // ##########################################

        /**
         * @param $filePath
         *
         * @return bool|string
         */
        public static function fileRead($filePath)
        {
            if (file_exists($filePath))
            {
                return join('', file($filePath));
            }

            return FALSE;
        }

        // ##########################################

        /**
         * @param $binaryData
         *
         * @return bool|int|string
         */
        public static function fileIdentifyType($binaryData)
        {
            $found = FALSE;

            $types = [
                'jpeg' => "\xFF\xD8\xFF",
                'gif'  => 'GIF',
                'png'  => "\x89\x50\x4e\x47\x0d\x0a",
                'bmp'  => 'BM',
            ];

            $bytes = substr($binaryData, 8);

            foreach ($types as $type => $header)
            {
                if (strpos($bytes, $header) !== FALSE)
                {
                    $found = $type;
                    break;
                }
            }

            return $found;
        }

        // ##########################################

        /**
         * @param bool $string
         * @param $salt
         *
         * @return bool|string
         */
        public static function stringCreateMd5Hash($string = FALSE, $salt)
        {
            if ($string !== FALSE)
            {
                $string = md5($salt . $string);
            }

            return $string;
        }

        // ##########################################

        /**
         * Taken from: https://github.com/alixaxel/phunction/blob/master/phunction/Text.php
         *
         * @param bool $string
         * @param string $slug
         * @param null $extra
         *
         * @return string
         */
        public static function stringUrlable($string = FALSE, $slug = '-', $extra = NULL)
        {
            return strtolower(trim(preg_replace('~[^0-9a-z' . preg_quote($extra, '~') . ']+~i', $slug, self::unaccent($string)), $slug));
        }

        // ##########################################

        /**
         * Taken from: https://github.com/alixaxel/phunction/blob/master/phunction/Text.php
         *
         * @param $string
         *
         * @return string
         */
        public static function unaccent($string)
        {
            if (strpos($string = htmlentities($string, ENT_QUOTES, 'UTF-8'), '&') !== FALSE)
            {
                $string = html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|caron|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i', '$1', $string), ENT_QUOTES, 'UTF-8');
            }

            return $string;
        }

        // ##########################################

        /**
         * @param bool $string
         *
         * @return bool|string
         */
        public static function stringAscii($string = FALSE)
        {
            if ($string !== FALSE)
            {
                $string = self::stringReplace('Ä', 'Ae', $string);
                $string = self::stringReplace('ä', 'ae', $string);
                $string = self::stringReplace('Ü', 'Ue', $string);
                $string = self::stringReplace('ü', 'ue', $string);
                $string = self::stringReplace('Ö', 'Oe', $string);
                $string = self::stringReplace('ö', 'oe', $string);
                $string = iconv("UTF-8", 'ASCII//IGNORE', $string);
            }

            return $string;
        }

        // ######################################

        /**
         * @param $string
         *
         * @return mixed
         */
        public static function stringTrim($string = FALSE)
        {
            if ($string !== FALSE)
            {
                $string = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $string);
            }

            return $string;
        }

        // ######################################

        /**
         * @param $string
         * @param $find
         * @param $replace
         *
         * @return mixed
         */
        public static function stringReplace($find, $replace, $string)
        {
            return preg_replace('/' . $find . '/u', $replace, $string);
        }

        // ######################################

        /**
         * @param bool $string
         *
         * @return bool|string
         */
        public static function stringToLower($string = FALSE)
        {
            if ($string !== FALSE)
            {
                $string = mb_strtolower($string, 'UTF-8');
            }

            return $string;
        }

        // ######################################

        /**
         * @param bool $string
         *
         * @return bool|string
         */
        public static function stringToUpper($string = FALSE)
        {
            if ($string !== FALSE)
            {
                $string = mb_strtoupper($string, 'UTF-8');
            }

            return $string;
        }

        // ######################################

        /**
         * @param bool $string
         *
         * @return bool|int
         */
        public static function stringLength($string = FALSE)
        {
            if ($string !== FALSE)
            {
                $string = mb_strlen($string, 'UTF-8');
            }

            return $string;
        }
    }
