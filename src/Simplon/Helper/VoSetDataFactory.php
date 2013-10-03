<?php

    namespace Simplon\Helper;

    class VoSetDataFactory
    {
        protected $_rawData = [];
        protected $_conditions = [];

        // ######################################

        /**
         * @param $key
         * @param $closure
         *
         * @return VoSetDataFactory
         */
        public function setConditionByKey($key, $closure)
        {
            $this->_conditions[$key] = $closure;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getConditions()
        {
            return $this->_conditions;
        }

        // ######################################

        /**
         * @param array $rawData
         *
         * @return VoSetDataFactory
         */
        public function setRawData(array $rawData)
        {
            $this->_rawData = $rawData;

            return $this;
        }

        // ######################################

        /**
         * @return array
         */
        protected function _getRawData()
        {
            return $this->_rawData;
        }

        // ######################################

        /**
         * @return bool
         * @throws \Exception
         */
        public function run()
        {
            $rawData = $this->_getRawData();
            $conds = $this->_getConditions();

            // make sure that we have data
            if (empty($rawData) || empty($conds))
            {
                throw new \Exception('Make sure that "rawData" and "conditions" have been set.', 500);
            }

            // run assignments
            foreach ($rawData as $k => $v)
            {
                if (isset($conds[$k]))
                {
                    $conds[$k]($v);
                }
            }

            return TRUE;
        }
    }