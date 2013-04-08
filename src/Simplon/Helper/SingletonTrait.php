<?php

    namespace Simplon\Helper;

    trait SingletonTrait
    {
        /** @var static */
        protected static $_instance;

        // ##########################################

        /**
         * @return static
         */
        final public static function getInstance()
        {
            if (!static::$_instance)
            {
                static::$_instance = new static();
            }

            return static::$_instance;
        }
    }