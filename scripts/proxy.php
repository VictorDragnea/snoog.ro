<?php

if (isset($_GET)) {

  $url = 'http://api.forismatic.com/api/1.0/?method=getQuote&format=json&lang=en' ;

  echo json_encode(file_get_contents($url));
 }


?>