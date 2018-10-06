<?php

return array(
    // set your paypal credential
//    'client_id' => 'AdCMpcNjs6RJRxwOgu1Ry7kOFXHGxpBeuj2Wlrd9tTw9J8QFyK6shSVwrsVidXPQ7b2bnFZcZOAA1X5Y',
//    'secret' => 'EFwi37K1Ux6tgk_EnGodQheGY_R64dQlYIJTVPDXP0FFJYmJSgc7kNqPjCcFGF1s5luWupHQpm6Kxn1h',
 'client_id' => 'AdJBPGNCfzPpaMFZ4SoGvJ8hr4tZpIQDkWMQA5dZ_db4keNRW9S1Ub1o6BFjUwqoGwFuodh9eykC5SoQ',
 'secret' => 'EIsWyHTWs9cQDBHcs3dU7pSUgFWVpCDyVkSYyzJlacuAJKDLgj74MRBKhLE3fiIMSRAiuDvILNB8RDCf',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 300,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'ERROR'
    ),
);
