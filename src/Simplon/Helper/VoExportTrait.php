<?php

    namespace Simplon\Helper;

    trait VoExportTrait
    {
        /**
         * @param $vo
         *
         * @return array
         */
        public static function one($vo)
        {
            return [];
        }

        // ##########################################

        /**
         * @param $voMany
         *
         * @return array
         */
        public static function many($voMany)
        {
            $export = [];

            if ($voMany !== FALSE)
            {
                foreach ($voMany as $vo)
                {
                    $export[] = static::one($vo);
                }
            }

            return $export;
        }
    }