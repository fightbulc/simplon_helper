<?php

  namespace Simplon\Helper;

  class VoManyFactory
  {
    /**
     * @param array $arrayValuesMany
     * @param callable $voClassClosure
     * @return array
     */
    public static function factory(array $arrayValuesMany, \Closure $voClassClosure)
    {
      $factoriesVo = array();

      foreach($arrayValuesMany as $arrayValues)
      {
        $factoriesVo[] = $voClassClosure($arrayValues);
      }

      return $factoriesVo;
    }
  }