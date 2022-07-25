<?php
session_start();
require( "./conectar.php" );
$x = 0;
$y = 0;
$z = 0;
$data_ = $_SESSION['mesp'];
$query = mysqli_query($conn,"SELECT * from `mensal2022` WHERE MES='$data_'") or die(mysqli_error());
if (mysqli_num_rows($query)) {
      while ($array = mysqli_fetch_row($query)) {
      $sql= mysqli_query($conn,"SELECT  * from `horario` WHERE prefixo='$array[0]'") or die(mysqli_error());
        if (mysqli_num_rows($sql)) {
          while ($array1 = mysqli_fetch_row($sql)) {
            $direto = $array1[2];
          }
        }
        $valor = $array[1] / $direto * 100;
        $valor = intval($valor);
        if ($valor > 100) {
            $x = $x + 1;
        }elseif ($valor > 50) {
          $y = $y + 1;
        }elseif ($valor < 49) {
          $z = $z + 1;
        }
      }
    }
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
          ['Viagens acima 100', <?=$x?>],//copia $x
          ['Viagens de 50 á 99', <?=$y?>],//copia $y
          ['Viagens 0 a 49', <?=$z?>],//copia $z
          
        ]);  
          //titulo do gráfico
        var options = {
          title: 'MONITRIIP DO MÊS'
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
