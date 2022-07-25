<?php 
require("./class/class.site.php");
require("./conectar.php");
$site= new site;
header("Content-type: application/vnd.ms-excel");
 header("Content-type: application/force-download");
 header("Content-Disposition: attachment; filename=linhas.xls");
 header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>  
    <meta charset="utf-8">
    <title>Linhas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Impressão com PDV">
    <meta name="author" content="Leandro Barbosa">
    <script src="js/site.js"></script>
</head>
<script type="text/javascript">
        window.print();
    </script>
<body>
    <div class="container">
        <?php 
		$responsavel=$site->list_linhas();
		?>
    </div>
</body>
</html>