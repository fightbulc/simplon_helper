<?php

  namespace Simplon\Helper;

  trait VoFlexTrait
  {
    /** @var array */
    protected $_data = [];

    // ##########################################

    public function __construct(array $data = [])
    {
      $this->_data = $data;
    }

    // ##########################################

    /**
     * @param $key
     * @param $val
     * @return static
     */
    protected function setByKey($key, $val)
    {
      $this->_data[$key] = $val;

      return $this;
    }

    // ##########################################

    /**
     * @param $key
     * @return mixed|null
     */
    protected function getByKey($key)
    {
      if(isset($this->_data[$key]))
      {
        return $this->_data[$key];
      }

      return NULL;
    }

    // ##########################################

    /**
     * @return array
     */
    public function getData()
    {
      return $this->_data;
    }
  }