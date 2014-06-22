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

    /**
     * @param array $voMany
     *
     * @return array|null
     */
    public static function many(array $voMany)
    {
        if (empty($voMany))
        {
            return null;
        }

        // --------------------------------------

        $export = [];

        foreach ($voMany as $vo)
        {
            $result = static::one($vo);

            if ($result !== null)
            {
                $export[] = $result;
            }
        }

        return $export;
    }
}