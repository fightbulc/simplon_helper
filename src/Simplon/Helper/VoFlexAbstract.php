<?php

  namespace Simplon\Helper;

  abstract class VoFlexAbstract
  {
    /** @var array */
    protected $_data = [];

    // ##########################################

    /**
     * @param array $rawData
     * @return $this
     */
    public function setData(array $rawData)
    {
      $this->_data = $rawData;

      return $this;
    }

    // ##########################################

    /**
     * @param $key
     * @param $val
     * @return $this
     */
    protected function setDataByKey($key, $val)
    {
      $this->_data[$key] = $val;

      return $this;
    }

    // ##########################################

    /**
     * @return array
     */
    public function getData()
    {
      return $this->_data;
    }

    // ##########################################

    /**
     * @param $key
     * @return mixed|null
     */
    protected function getDataByKey($key)
    {
      if(isset($this->_data[$key]))
      {
        return $this->_data[$key];
      }

      return NULL;
    }
  }