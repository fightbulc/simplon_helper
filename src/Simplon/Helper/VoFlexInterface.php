<?php

  namespace Simplon\Helper;

  interface VoFlexInterface
  {
    public function setRawData(array $rawData);
    public function getRawDataByKey($key);
  }