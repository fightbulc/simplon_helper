<?php

  namespace Simplon\Helper;

  abstract class VoAbstract implements VoInterface
  {
    /**
     * @param array $rawData
     * @param $key
     * @return mixed|null
     */
    protected function _getRawDataByKey(array $rawData, $key)
    {
      if(isset($rawData[$key]))
      {
        return $rawData[$key];
      }

      return NULL;
    }
  }