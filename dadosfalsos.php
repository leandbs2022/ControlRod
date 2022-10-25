<?php
require("./class/class.site.php");
require("./conectar.php");
$cad = new site;
$dadosreg=0;


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alterar dados</title>
<h1>Alterar dados</h1>
<?php
 $query = mysqli_query($conn, "SELECT COUNT(PREFIXO) FROM  `horario` WHERE 1");
 $dadosreg=mysqli_fetch_assoc($result);
echo $dadosreg['total'];
?>

<p> <label> </label></p>

</head>
<body>
    
</body>
</html>