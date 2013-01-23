<?php

  namespace Simplon\Helper;

  class VoFlexFactory
  {
    /**
     * @param array $arrayValues
     * @param VoFlexAbstract $voClass
     * @return $this
     */
    public static function one(array $arrayValues, VoFlexAbstract $voClass)
    {
      return $voClass->setData($arrayValues);
    }

    // ##########################################

    /**
     * @param array $arrayValuesMany
     * @param VoFlexAbstract $voClass
     * @return array
     */
    public static function many(array $arrayValuesMany, VoFlexAbstract $voClass)
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