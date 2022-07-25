<?php
session_start();
require( "./conectar.php" );
$mes_pesq = $_SESSION['mesp'];
$x = $_SESSION['valor'];
$x = intval($x);
$y = 100 - $x;
$z = 0;
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Total feitos <?=$x?>%',<?=$x?>], //copia $x
          ['Falta <?=$y?>%', <?=$y?>], //copia $y
          ['',  <?=$z?>] //copia $z
          
        ]);
        var meses = <?=$mes_pesq?>
          //titulo do gráfico
        var options = {
          title: meses
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
