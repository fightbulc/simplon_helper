<?php

    namespace Simplon\Helper;

    class VoManyFactory
    {
        /**
         * @param array $arrayValuesMany
         * @param callable $voClassClosure
         *
         * @return array
         */
        public static function factory(array $arrayValuesMany, \Closure $voClassClosure)
        {
            $factoriesVo = [];

            foreach ($arrayValuesMany as $key => $val)
            {
                $response = $voClassClosure($key, $val);

                if ($response !== NULL)
                {
                    $factoriesVo[] = $response;
                }
            }

            return $factoriesVo;
        }
    }