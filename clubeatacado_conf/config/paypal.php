<?php

return [

   'client_id' => env('PAYPAL_CLIENT_ID','Abt3oxeDHyggp-gAqbWqZhDCsvuPduMOmt2MuXixX0us7kHPK4oHTKfgnm9uPdD7_a_WpQf2_2SA3lzr'),

   'secret' => env('PAYPAL_SECRET','ENl19DA1DKEr31JwbI-xG34L5bY_MBaTBhBqObsJqS1mcVasqgwR5wdnPz1dcWQeRNczMeUTHGdL8jNd'),

   'settings' => array(

       'mode' => env('PAYPAL_MODE', 'sandbox'),

       'http.ConnectionTimeOut' => 30,

       'log.LogEnabled' => true,

       'log.FileName' => storage_path() . '/logs/paypal.log',

       'log.LogLevel' => 'ERROR'

   ),

];