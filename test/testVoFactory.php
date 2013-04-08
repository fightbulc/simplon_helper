<?php

    require __DIR__ . '/../vendor/autoload.php';

    // ############################################

    class TestAVoFlex
    {
        use \Simplon\Helper\VoFlexTrait;

        /**
         * @return mixed|null
         */
        public function getName()
        {
            return $this->getByKey('name');
        }
    }

    // ############################################

    $data = [
        ['name' => 'AAA'],
        ['name' => 'BBB'],
        ['name' => 'CCC'],
    ];

    $voMany = \Simplon\Helper\VoManyFactory::factory($data, function ($data)
    {
        return new TestAVoFlex($data);
    });

    var_dump($voMany);