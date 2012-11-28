<?php

  require __DIR__ . '/../vendor/autoload.php';

  echo 'idCreateUnique:<br>';
  echo (new \Simplon\Helper\Helper())->idCreateUnique();
  echo '<hr>';

  echo 'idCreateShortUnique:<br>';
  echo (new \Simplon\Helper\Helper())->idCreateShortUnique(rand(0,100));
  echo '<hr>';

  echo 'idCreateShortReferenceByNumber:<br>';
  echo (new \Simplon\Helper\Helper())->idCreateShortReferenceByNumber(123);
  echo '<hr>';