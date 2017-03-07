<?php

include '../tools/menu.php';
include '../controllers/market_analyse.php';

 ?>
<html>
   <head>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var data_ema = new google.visualization.arrayToDataTable(<?=$data_ema?>);

        var options_ema = {
          title: 'EMA evolution for <?=$symbol_to_display?>',
          seriesType: 'line',

          width: window.innerWidth,
          height: window.innerHeight-200,

          vAxes: {
            0: {title: 'Bid Value'},
            1: {title: 'Diff Value'}
          },

          hAxis: {title: 'Time'},

          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 0},
            2: {targetAxisIndex: 0},
            3: {targetAxisIndex: 1, type: 'bars'}
          },
          crosshair: {
            color: '#000',
            trigger: 'selection'
          }
        };

        var chart_ema = new google.visualization.ComboChart(document.getElementById('charts_ema'));
        chart_ema.draw(data_ema, options_ema);
      }
    </script>
  </head>
  <body>
    <?php print_menu() ?>

    <p>Select your symbol :
      <form name="display_data" method="post" action="market_analysing_ema.php">
        <select name="select_symbol">
          <?php
            if (isset($current_symbol)) {
              echo "<option selected=\"selected\" value=\"".$activ_symbol->id."\">".$activ_symbol->reference."</option>";
            }

            foreach($activ_symbols as $activ_symbol) {
              if (isset($current_symbol) && $activ_symbol->id == $current_symbol->id) {
                continue;
              }
              echo "<option value=\"".$activ_symbol->id."\">".$activ_symbol->reference."</option>";
            }
           ?>
        </select>
        <input type="submit" value="Select it"/>
      </form>
    </p>
   <div id="charts_ema"></div>
  </body>
</html>
