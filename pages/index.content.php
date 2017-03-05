<?php

include 'tools/config.php';

$config = load_config();

var_dump($config);

echo $config->database_server->host;

/*
try {
  $datas = getData($db);
} catch(PDOException $ex) {
  echo $ex->getMessage();
}

$json = "{\"datas\":[";

foreach($datas as $row) {
  $json .= "{\"id\":\"".$row['id']."\", \"values_1\":\"".$row['values_1']."\", \"values_2\":\"".$row['values_2']."\"},";
}

$json=substr($json,0,-1);

$json = $json."]}";

echo $json;

function retrieveJsonData() {

}

function getData($db) {
  $stmt = $db->query('SELECT id, values_1, values_2 FROM datas');
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
*/
 ?>
