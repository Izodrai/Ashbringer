<?php

function db_connect($db_serv) {
  $db = new PDO('mysql:host='.$db_serv->host.';dbname='.$db_serv->database.';charset=utf8',$db_serv->login, $db_serv->pwd);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  return $db;
}

?>
