<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'fixture' => array(
                'class' => 'system.test.CDbFixtureManager',
            ),
            // uncomment the following to provide test database connection
            'db' => array(
                // mysql -h 192.254.181.238 -u shassan_v2user -P 3306 -D shassan_v2 -p 123Karmiopma
                'connectionString' => 'mysql:host=localhost;dbname=shassan_v2;port=3306',
                'emulatePrepare' => true,
                'username' => 'rbujans',
                'password' => 'kreyszig',
                'charset' => 'utf8',
            ),
        ),
        'params' => array(
            // this is used in contact page
            "AUTHORIZENET_API_LOGIN_ID" => "6b9Fc32M7r",
            "AUTHORIZENET_TRANSACTION_KEY" =>"8d7G7w6422vGF4kw",
            "AUTHORIZENET_SANDBOX" => true,
            /*"AUTHORIZENET_API_LOGIN_ID" => "9M9qM7w62b",
            "AUTHORIZENET_TRANSACTION_KEY" =>"9k748HYdpyH6B487",
            "AUTHORIZENET_SANDBOX" => false,
            "TEST_REQUEST" => false,*/
            "NFG_PARTNER_PW" => "kachu6H3",
            "NFG_URL" => "https://api-sandbox.networkforgood.org/PartnerDonationService/DonationServices.asmx?wsdl"
        ),
    )
);
