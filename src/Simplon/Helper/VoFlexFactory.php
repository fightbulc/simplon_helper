<?php

  namespace Simplon\Helper;

  class VoFlexFactory
  {
    /**
     * @param array $arrayValues
     * @param VoFlexInterface $voClass
     * @return mixed
     */
    public static function one(array $arrayValues, VoFlexInterface $voClass)
    {
      return $voClass->setRawData($arrayValues);
    }

    // ##########################################

    /**
     * @param array $arrayValuesMany
     * @param VoFlexInterface $voClass
     * @return array
     */
    public static function many(array $arrayValuesMany, VoFlexInterface $voClass)
    {
      $factoriesVo = array();

      foreach($arrayValuesMany as $arrayValues)
      {
        $voClass->setRawData($arrayValues);
        $factoriesVo[] = clone $voClass;
      }

      return $factoriesVo;
    }
  }