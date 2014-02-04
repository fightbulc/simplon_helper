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
         * @return array|null
         */
        public static function many($voMany)
        {
            if (empty($voMany))
            {
                return NULL;
            }

            $export = [];

            if ($voMany !== FALSE)
            {
                foreach ($voMany as $vo)
                {
                    $result = static::one($vo);

                    if ($result)
                    {
                        $export[] = $result;
                    }
                }
            }

            return $export;
        }
    }