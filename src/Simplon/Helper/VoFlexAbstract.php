<?php

  namespace Simplon\Helper;

  abstract class VoFlexAbstract implements VoFlexInterface
  {
    /** @var array */
    protected $_rawData = [];

    // ##########################################

    /**
     * @param array $rawData
     * @return $this
     */
    public function setRawData(array $rawData)
    {
      $this->_rawData = $rawData;

      return $this;
    }

    // ##########################################

    /**
     * @param $key
     * @return mixed|null
     */
    public function getRawDataByKey($key)
    {
      if(isset($this->_rawData[$key]))
      {
        return $this->_rawData[$key];
      }

      return NULL;
    }
  }