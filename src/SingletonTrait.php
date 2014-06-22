<?php

namespace Simplon\Helper;

trait SingletonTrait
{
    /** @var  static */
    protected static $_instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!static::$_instance)
        {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    /**
     * Prevent creation of new instance other than singleton
     */
    protected function __construct()
    {
    }

    /**
     * Prevent cloning
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserialisation
     */
    private function __wakeup()
    {
    }
}