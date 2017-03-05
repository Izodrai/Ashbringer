<?php

include '../tools/menu.php';
include '../tools/config.php';
include '../tools/db_connect.php';
include '../models/symbols.php';


$config = load_config();

try {
  $db = db_connect($config->localhost_server);
} catch(PDOException $ex) {
  echo $ex->getMessage();
}

try {
  $datas = getData($db);
} catch(PDOException $ex) {
  echo $ex->getMessage();
}

$table = array();
$table['cols'] = array(
    array('label' => 'Id', 'type' => 'number'),
    array('label' => 'values_1', 'type' => 'number'),
    array('label' => 'values_2', 'type' => 'number')

);

$rows = array();

foreach($datas as $row) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (int) $row['id']);

    // Values of each slice
    $temp[] = array('v' => (int) $row['values_1']);
    $temp[] = array('v' => (int) $row['values_2']);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;

$json_data = json_encode($table);

echo $json_data;


function getData($db) {
  $stmt = $db->query('SELECT id, values_1, values_2 FROM datas');
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/*
try {
  $activ_symbols = get_activ_symbols($db);
} catch(PDOException $ex) {
  echo $ex->getMessage();
}

var_dump($activ_symbols);

try {
  $symbols = get_all_symbols($db);
} catch(PDOException $ex) {
  echo $ex->getMessage();
}

var_dump($symbols);
*/
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable(<?=$json_data?>);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);


        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);

      }
    </script>
  </head>
  <body>
    <?php print_menu() ?>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    <div id="curve_chart2" style="width: 900px; height: 500px"></div>
  </body>
</html>
