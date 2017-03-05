<?php

class stock_value {

 var $id;
 var $bid_at;
 var $start_bid;
 var $last_bid;
 var $symbol;
 var $calc_id;
 var $sma_c;
 var $sma_l;
 var $ema_c;
 var $ema_l;
 var $macd_value;
 var $macd_trigger;
 var $macd_signal;
 var $macd_absol_max_signal;
 var $macd_trigger_percent;
 var $macd_absol_trigger_signal;

 function stock_value($id, $bid_at, $start_bid, $last_bid, $symbol, $calc_id, $sma_c, $sma_l, $ema_c, $ema_l, $macd_value, $macd_trigger, $macd_signal, $macd_absol_max_signal, $macd_trigger_percent, $macd_absol_trigger_signal) {
   $this->id = $id;
   $this->bid_at = $bid_at;
   $this->start_bid = $start_bid;
   $this->last_bid = $last_bid;
   $this->symbol = $symbol;
   $this->calc_id = $calc_id;
   $this->sma_c = floatval($sma_c);
   $this->sma_l = floatval($sma_l);
   $this->ema_c = floatval($ema_c);
   $this->ema_l = floatval($ema_l);
   $this->macd_value = floatval($macd_value);
   $this->macd_trigger = floatval($macd_trigger);
   $this->macd_signal = floatval($macd_signal);
   $this->macd_absol_max_signal = floatval($macd_absol_max_signal);
   $this->macd_trigger_percent = $macd_trigger_percent;
   $this->macd_absol_trigger_signal = floatval($macd_absol_trigger_signal);
 }
}

function get_stock_value_for_symbol($db, $symbol) {
  $stock_values = array();

  $stmt = $db->prepare('SELECT sv_id, bid_at, start_bid, last_bid, sa_id, sma_c, sma_l, ema_c, ema_l, macd_value, macd_trigger, macd_signal, macd_absol_max_signal, macd_trigger_percent, macd_absol_trigger_signal FROM v_last_day_stock_values WHERE s_id = :s_id');

  $stmt->bindParam(':s_id', $symbol->id, PDO::PARAM_INT);

  $stmt->execute();

  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

    $stock = new stock_value($row['sv_id'], $row['bid_at'], $row['start_bid'], $row['last_bid'], $symbol, $row['sa_id'], $row['sma_c'], $row['sma_l'], $row['ema_c'], $row['ema_l'], $row['macd_value'], $row['macd_trigger'], $row['macd_signal'], $row['macd_absol_max_signal'], $row['macd_trigger_percent'], $row['macd_absol_trigger_signal']);
    $stock_values[]=$stock;
  }

  return $stock_values;
}

?>
