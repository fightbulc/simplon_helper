<?php

  namespace Simplon\Helper;

  class VoFactory
  {
    /**
     * @param array $arrayValues
     * @param VoInterface $voClass
     * @return mixed
     */
    public static function one(array $arrayValues, VoInterface $voClass)
    {
      return $voClass->setData($arrayValues);
    }

    // ##########################################

    /**
     * @param array $arrayValuesMany
     * @param VoInterface $voClass
     * @return array
     */
    public static function many(array $arrayValuesMany, VoInterface $voClass)
    {
      $factoriesVo = array();

      foreach($arrayValuesMany as $arrayValues)
      {
        $voClass->setData($arrayValues);
        $factoriesVo[] = clone $voClass;
      }

      return $factoriesVo;
    }
  }