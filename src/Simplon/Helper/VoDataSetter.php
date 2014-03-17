<?php

    namespace Simplon\Helper;

    class VoDataSetter
    {
        protected $_data = [];
        protected $_fields = [];

        // ######################################

        /**
         * @param $fieldName
         * @param callable $voMethodClosure
         *
         * @return VoDataSetter
         */
        public function setField($fieldName, \Closure $voMethodClosure)
        {
            $this->_fields[$fieldName] = $voMethodClosure;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getFields()
        {
            return (array)$this->_fields;
        }

        // ######################################

        /**
         * @param array $data
         *
         * @return VoDataSetter
         */
        protected function _setData(array $data)
        {
            $this->_data = $data;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getData()
        {
            return (array)$this->_data;
        }

        // ######################################

        /**
         * @param array $data
         *
         * @return bool
         * @throws \Exception
         */
        public function applyOn(array $data)
        {
            // remember data
            $this->_setData($data);

            // get fields
            $fields = $this->_getFields();

            // make sure that we have data
            if (empty($data) || empty($fields))
            {
                throw new \Exception('Make sure that "data" and "fields" have been set.', 500);
            }

            // ----------------------------------

            // run assignments
            foreach ($data as $k => $v)
            {
                if (isset($fields[$k]))
                {
                    $fields[$k]($v);
                }
            }

            return TRUE;
        }
    } 