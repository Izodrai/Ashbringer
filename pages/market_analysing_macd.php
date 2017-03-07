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
        var data_macd1 = new google.visualization.arrayToDataTable(<?=$data_macd1?>);
        var data_macd2 = new google.visualization.arrayToDataTable(<?=$data_macd2?>);
        var data_macd3 = new google.visualization.arrayToDataTable(<?=$data_macd3?>);


        var options_macd1 = {
          title: 'MACD evolution for <?=$symbol_to_display?> (charts_1)',
          seriesType: 'line',

          width: window.innerWidth,
          height: window.innerHeight-200,

          vAxes: {
            0: {title: 'Bid Value'},
            1: {title: 'Signal'}
          },

          hAxis: {title: 'Time'},

          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1, type: 'bars'},
            2: {targetAxisIndex: 1},
            3: {targetAxisIndex: 1}
          },
          crosshair: {
            color: '#000',
            trigger: 'selection'
          }
        };

        var options_macd2 = {
          title: 'MACD evolution for <?=$symbol_to_display?> (charts_2)',
          seriesType: 'line',

          width: window.innerWidth,
          height: window.innerHeight-200,

          vAxes: {
            0: {title: 'Bid Value'},
            1: {title: 'Signal'}
          },

          hAxis: {title: 'Time'},

          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1, type: 'bars'}
          },
          crosshair: {
            color: '#000',
            trigger: 'selection'
          }
        };
        var options_macd3 = {
          title: 'MACD evolution for <?=$symbol_to_display?> (charts_3)',
          seriesType: 'line',

          width: window.innerWidth,
          height: window.innerHeight-200,

          vAxes: {
            0: {title: 'Macd Value'},
            1: {title: 'Signal'}
          },

          hAxis: {title: 'Time'},

          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 0},
            2: {targetAxisIndex: 1, type: 'bars'}
          },
          crosshair: {
            color: '#000',
            trigger: 'selection'
          }
        };
        var chart_macd1 = new google.visualization.ComboChart(document.getElementById('charts_macd1'));
        chart_macd1.draw(data_macd1, options_macd1);

        var chart_macd2 = new google.visualization.ComboChart(document.getElementById('charts_macd2'));
        chart_macd2.draw(data_macd2, options_macd2);

        var chart_macd3 = new google.visualization.ComboChart(document.getElementById('charts_macd3'));
        chart_macd3.draw(data_macd3, options_macd3);
      }
    </script>
  </head>
  <body>
    <?php print_menu() ?>

    <p>Select your symbol :
      <form name="display_data" method="post" action="market_analysing_macd.php">
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
   <div id="charts_macd1"></div>
   <div id="charts_macd2"></div>
   <div id="charts_macd3"></div>
  </body>
</html>
