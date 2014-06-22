<?php

namespace Simplon\Helper;

class VoDataSetter
{
    /** @var array */
    protected $data = [];

    /** @var array */
    protected $fields = [];

    /**
     * @param array $data
     *
     * @return VoDataSetter
     */
    public static function init(array $data)
    {
        // create instance
        $instance = new VoDataSetter();

        // set data
        $instance->setData($data);

        return $instance;
    }

    /**
     * @return bool
     */
    protected function reset()
    {
        $this->data = [];
        $this->fields = [];

        return true;
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return (array)$this->data;
    }

    /**
     * @param array $data
     *
     * @return VoDataSetter
     */
    protected function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param $fieldName
     * @param callable $voMethodClosure
     *
     * @return VoDataSetter
     */
    public function assignData($fieldName, \Closure $voMethodClosure)
    {
        $this->fields[$fieldName] = $voMethodClosure;

        return $this;
    }

    /**
     * @return array
     */
    protected function getFields()
    {
        return (array)$this->fields;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function apply()
    {
        // get fields
        $fields = $this->getFields();

        // make sure that we have data
        if (empty($data) || empty($fields))
        {
            throw new \Exception('Make sure that "data" and "fields" have been set.', 500);
        }

        // ----------------------------------

        // apply data
        foreach ($data as $k => $v)
        {
            if (isset($fields[$k]))
            {
                $fields[$k]($v);
            }
        }

        // reset
        $this->reset();

        return true;
    }
} 