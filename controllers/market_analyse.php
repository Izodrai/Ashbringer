<?php

include '../tools/config.php';
include '../tools/db_connect.php';
include '../models/symbols.php';
include '../models/stock_values.php';

$config = load_config();

try {
  $db = db_connect($config->database_server);
} catch(PDOException $ex) {
  echo $ex->getMessage();
  exit(1);
}

try {
  $activ_symbols = get_activ_symbols($db);
} catch(PDOException $ex) {
  echo $ex->getMessage();
  exit(1);
}

$data_sma = array();
$data_ema = array();
$data_macd = array();
$symbol_to_display = "";
//$current_symbol = NULL;

if (!isset($_POST["select_symbol"])) {
  $symbol_to_display = $activ_symbols[0]->reference;
  list($data_sma,$data_ema,$data_macd) = load_last_data_for_symbol($db, $activ_symbols[0]);
  return;
}

foreach($activ_symbols as $activ_symbol) {
  if ($activ_symbol->id == $_POST["select_symbol"]) {
    $current_symbol = $activ_symbol;
    break;
  }
}

if ($current_symbol->id == 0) {
  echo 'not a valid symbol...';
  return;
}

$symbol_to_display = $current_symbol->reference;

list($data_sma,$data_ema,$data_macd) = load_last_data_for_symbol($db, $current_symbol);

function load_last_data_for_symbol($db, $current_symbol){
  $data = get_stock_value_for_symbol($db, $current_symbol);

  $data_sma = format_data_sma($data);
  $data_ema = format_data_ema($data);
  $data_macd = format_data_macd($data);

  return array($data_sma,$data_ema,$data_macd);
}

function format_data_sma($data) {
  $table = array();

  $table[]= array('Time', 'last_bid', 'sma_c', 'sma_l', 'diff');

  foreach($data as $row) {
    $table[]= array($row->bid_at, $row->last_bid, $row->sma_c, $row->sma_l, $row->sma_c-$row->sma_l);
  }

  return json_encode($table);
}

function format_data_ema($data) {
  $table = array();

  $table[]= array('Time', 'last_bid', 'ema_c', 'ema_l', 'diff');

  foreach($data as $row) {
    $table[]= array($row->bid_at, $row->last_bid, $row->ema_c, $row->ema_l, $row->ema_c-$row->ema_l);
  }

  return json_encode($table);
}

function format_data_macd($data) {
  $table = array();

  $table[]= array('Time', 'last_bid', 'macd_value', 'macd_trigger', 'signal');

  foreach($data as $row) {
    $table[]= array($row->bid_at, $row->last_bid, $row->macd_value, $row->macd_trigger, $row->macd_signal);
  }

  return json_encode($table);
}

?>
