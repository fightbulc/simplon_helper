<?php

namespace Simplon\Helper;

/**
 * DataValidator
 * @package Simplon\Helper
 * @author Tino Ehrich (tino@bigpun.me)
 */
class DataValidator
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @param $fieldName
     * @param callable $voMethodClosure
     *
     * @return DataValidator
     */
    public function testField($fieldName, \Closure $voMethodClosure)
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
     * @param array $data
     *
     * @return array|bool
     */
    public function applyOn(array $data)
    {
        // get fields
        $fields = $this->getFields();

        // test data
        $responses = [];

        foreach ($fields as $k => $v)
        {
            // set default value
            $responses[$k] = false;

            if (isset($data[$k]))
            {
                // get response from closure
                $isValid = $fields[$k]($data[$k]);

                if ($isValid === true)
                {
                    unset($responses[$k]);
                    continue;
                }

                $responses[$k] = $isValid;
            }
        }

        // anything invalid?
        if (empty($responses) === false)
        {
            return $responses;
        }

        return true;
    }
} 