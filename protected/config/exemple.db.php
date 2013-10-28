<?php

// this contains the application parameters that can be maintained via GUI
return array(
      'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=podymov',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
            'enableProfiling' => false,
            'enableParamLogging' => false,
        ),
);
