<?php

class symbol {

 var $id ;
 var $reference;
 var $description;

 function symbol($id, $ref, $desc) {
   $this->id = $id;
   $this->reference = $ref;
   $this->description = $desc;
 }
}

function get_activ_symbols($db) {

  $activ_symbols = array();

  $stmt = $db->query('SELECT id, reference, description FROM v_activ_symbols');

  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

    $symbol = new symbol($row['id'],$row['reference'],$row['description']);

    $activ_symbols[]=$symbol;
  }

  return $activ_symbols;
}

function get_all_symbols($db) {

  $activ_symbols = array();

  $stmt = $db->query('SELECT id, reference, description FROM symbols');

  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

    $symbol = new symbol($row['id'],$row['reference'],$row['description']);

    $activ_symbols[]=$symbol;
  }

  return $activ_symbols;
}

?>
