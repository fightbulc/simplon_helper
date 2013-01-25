<?php

  namespace Simplon\Helper;

  trait VoFlexTrait
  {
    /** @var array */
    protected $_data = [];

    // ##########################################

    public function __construct(array $data)
    {
      $this->_data = $data;
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
  }