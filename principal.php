<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require("./conectar.php");
require("./class/class.site.php");
$db_c = new site;
//Variaveis php
$dia = 0;
$via = "";
$horas = 0;
$minutos = 0;
$hminutos = 0;
$count = 0;
$time = 0;
$resul = 0;
$valida = 0;
$datadia = date('d/m/Y');
$saida = 0;
$di = 0;
$barra = 0;
$mi = 0;
$cal = 0;
$hatual = 0;
$matual = 0;
$prefixo = 0;
$hora_v = 0;
$Minutos_v = 0;
$linha = "";
$limite_M = 0;
$limite_u = 0;
$livre = 0;
$data_M = "";
$data_u = "";
$dados = "";
$dias_v = "";
$valide_v = 0;
$sql = "";
$atual = date('Y-m-d');
$data_ = date('m/Y');
$estilo_fundo = 0;
//verificação de motoristas e liberação
$query = mysqli_query($conn, "SELECT * from `motoristas` WHERE LIVRE=1 AND DATA_M <'$atual'") or die(mysqli_error($mysqli));
if (mysqli_num_rows($query)) {
    while ($array = mysqli_fetch_row($query)) {
        $query = mysqli_query($conn, "update motoristas set DATA_M='',LIVRE=0 WHERE LIVRE=1 AND DATA_M <'$atual'") or die(mysqli_error($mysqli));
    }
    echo "atualização completa";
}
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL, 'pt_BR', 'pt_BR. iso-8859-1', 'pt_BR. utf-8', 'portuguese');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="mobile-web-app-capable" , content="yes" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding:wght@400;700&display=swap" rel="stylesheet">
    <title>Viagem</title>
    <!--Bootstrap-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--CSS-->
    <?php
    $estilo_fundo = $_SESSION['estilo'];
    if ($estilo_fundo == 0) {
        echo "<link href=css/styles.css rel=stylesheet type=text/css>";
    }
    if ($estilo_fundo == 1) {
        echo "<link href=css/styles1.css rel=stylesheet type=text/css>";
    }
    ?>
    <!--javascript funcões-->
<script src="js/site.js"></script>
</head>

<body>
   

    <form id="form1" name="form1" method="post" action="">
        <div class="container"><br>

 <?php
if($_SESSION['acesso_pag'] <> 1 )
{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Padrão) </label>  Data:<label> {$datedia}</label>" ; 
	header('Location: BLOQUEIO.php');
	echo "NIVEL SEM ACESSO: ", $_SESSION['nivel'];
}else{
	#echo "<p align=left><em></em>Login: <label>{$nome} (Administrador) </label>  Data:<label> {$datedia}</label>" ;
    echo "Login: {$_SESSION['nome']} || {$_SESSION['data']} ||  {$_SESSION['nivel']}";
}
echo "<h1>Controle de Viagem</h1>";
?>
<br>
<nav class="navbar navbar-expand-lg  style=background-color: #e49e1b">
     <ul class="menu" >
		<li><a href="principal.php">Início</a></li>
		<li><a href="#">Configurações</a>
				<ul>
	                  <li><a href="cadastro.php" >Linhas</a></li>
	                  <li><a href="#" onclick="<script>alert ('pagina em desenvolvimento')</script>">Motoristas</a></li>
	                  <li><a href="index.php">Login</a></li>
	       		</ul>
				   </li>
		<li><a href="#">Links</a>
            <ul>
	            <li><a href="" target="_black">Link</a></li>
	            <li><a href="https://sgp.antt.gov.br/src.br.gov.antt/apresentacao/controledeacesso/login.aspx" target="_black">ANNT</a></li>
	            <li><a href="" target="_black">Link</a></li>
	       	</ul>
               </li>
		<li><a href="#">Contato</a>
		<ul>
	    <li><a href="#">Sem descrição</a></li>
	    </ul>
		</li>
</ul>
</nav>
         <?php echo "<h3>Saída no dia:{$datadia}</h3>"; ?>
            <h6>
                <?php
                if (isset($_POST['conf3'])) {
                    $_SESSION['estilo'] = 1;
                    $estilo_fundo = $_SESSION['estilo'];
                    if ($estilo_fundo == 1) {
                        echo "<link href=css/styles1.css rel=stylesheet type=text/css>";
                    }
                }
                if (isset($_POST['conf2'])) {
                    $_SESSION['estilo'] = 0;
                    $estilo_fundo = $_SESSION['estilo'];
                    if ($estilo_fundo == 0) {
                        echo "<link href=css/styles.css rel=stylesheet type=text/css>";
                    }
                }
                if (isset($_POST['loc'])) {
                    $prefixo = $_POST['linha'];
                    $resposta = $db_c->pesq_viagens($prefixo, $linha);
                    $hora_v = $_SESSION['Horas'];
                    $Minutos_v = $_SESSION['Minutos'];
                    $hatual = new DateTime();
                    $hatual = date('H');
                    $matual = new DateTime();
                    $matual = date('i');
                    $cal = $_SESSION['prefixo'];
                }
                ?>
                <h6>
                    <label>Horário de saída</label><br>
                    <label>Saída:</label>
                    <input type="text" name="sai" id="sai" size="2" onfocus="focusFunction()" onblur="blurFunction()" maxlength="2" value="<?php echo $hatual; ?>">
                    <label>:</label>
                    <input type="text" name="minutos" id="minutos" onfocus="focusFunction()" onblur="blurFunction()" size="2" maxlength="2" value="<?php echo  $matual; ?>">
                    <label>Horas</label>
                    <input type="text" name="hora" id="hora" size="3" maxlength="5" value="<?php echo $hora_v; ?>">
                    <label>Minutos</label>
                    <input type="text" name="hminutos" id="hminutos" onfocus="focusFunction()" onblur="blurFunction()" size="2" maxlength="2" value="<?php echo $Minutos_v; ?>">
                    <label>Prefixo</label>
                    <input type="text" name="linha1" id="linha1" size="8" maxlength="11" value="<?php echo $cal; ?>" onclick="#topo">
                    <input type="submit" name="cal" id="cal" value="Calcular" class="btn btn-dark btn-sm" onclick=''>
                    <br>
                    <br>
                    <label>Linha</label>
                    <input type="text" name="linha" id="linha" size="11" maxlength="11" value="">
                    <input type="submit" name="loc" id="loc" value="Localizar" class="btn btn-dark btn-sm" onclick="numclick()">
                    <br>
                    <br>
                    <label>Direção</label>
                    <select name="cmb1" id="cmb1">
                        <option value=1>Ida</option>
                        <option value=2>Volta</option>
                    </select>
                    <label>Horário Manual</label>
                    <select name="cmb2" id="cmb2">
                        <option value=0>Horário Automatico</option>
                        <option value=1>Manha</option>
                        <option value=2>Tarde</option>
                        <option value=3>Noite</option>
                    </select>
                    <input type="submit" name="via" id="via" value="Viagens do dia" class="btn btn-dark btn-sm" onclick="<?php echo"<a href=#topo>Resultado</a>"?>" >
                </h6>
                <p id='topo'>
                <h3>Informações</h3>
                </p>
                <a href='#topo'>Ver Resultado</a>
                <br><label>
                    <h6>Mês Referênte</h6>
                </label><br>
                <select name="cmb" id="cmb">
                    <?php
                    $query = mysqli_query($conn, "SELECT * from mensal2022 GROUP BY MES ORDER BY MES DESC");
                    if (mysqli_num_rows($query)) {

                        while ($array1 = mysqli_fetch_row($query)) {
                            $direto = $array1[2];
                            echo "<option>{$direto}</option>";
                        }
                    }
                    $aba="Resultado oculto";
                    ?>
                </select>
                <br>
                <br>
                <p><input type="submit" name="list" id="list" value="Linhas" class="btn btn-success">
                    <input type="submit" name="por" id="por" value="Porcentagem do mês %" class="btn btn-warning">
                    <button class="btn btn-primary" type="button" id="aba"data-toggle="collapse" data-target="#adm" aria-expanded="false" aria-controls="collapseExample"><?php echo $aba;?></button>
                    <button class="btn btn-primary" type="button" id="exc" onclick="excel()">Excel</button>
                </p>
                <div class="collapse" id="adm">
                    <div class="card card-body">
                        <div class="alert alert-success btn-sm" id='topo' role="alert">
                            <p>
                            <h6>Click em algum botão para ver o resultado!</h6>
                            </p>
                            <?php
                               
                            if (isset($_POST['list'])) {
                                $resposta = $db_c->list_linhas();
                            }
                            if (isset($_POST['por'])) {
                                $mes = $_POST['cmb'];
                                if (empty($mes)) {
                                    $mes = date('mY');
                                }
                                $_SESSION['mesp'] = $mes;
                                $resposta = $db_c->porcento($mes);
                                echo "<h6>Mês Atual: {$data_}</h6>";
                                echo "<iframe frameborder=0 src=graf01.php height=200px width=600% scrolling=no>Grafico</iframe>
                              <iframe frameborder=0 src=graf02.php height=200px width=600% scrolling=no>Grafico</iframe>
                        <br>
                      ";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                </p>
            </h6>

            <?php

            if (isset($_POST['via'])) {
                $dias_v = $_POST['cmb1'];
                $auto = $_POST['cmb2'];
                $resposta = $db_c->semana($dias_v,$auto);
            }
            if (isset($_POST['cal'])) {
                $limite_M = 0;
                $prefixo = $_POST['linha1'];
                $resposta = $db_c->pesq_viagens($prefixo, $linha);
                if (empty($prefixo)) {
                } else {
                    $hora_v = $_SESSION['Horas'];
                    $Minutos_v = $_SESSION['Minutos'];
                    //variaveis
                    //$hora = $dia * 24;
                    $horas = $_POST['hora'];
                    $minutos = $_POST['minutos'];
                    $hminutos = $_POST['hminutos'];
                    $saida = $_POST['sai'];
                    $sai_M = $_POST['hora'];
                    $h = $_POST['sai'];
                    $dias_c = $_POST['sai'];
                    $t = $_POST['hora'];
                    $dia = $horas / 24;
                    $d = date('d');
                    $d = $d + intval($dia);
                    $m = date('m/Y');
                    //______________________________________________//
                    //Logica Repita quantidade de horas
                    //______________________________________________//
                    
                    for ($i = 0; $i < $horas; $i++) {
                        //conte um dia em 24hs
                        $count = $count + 1;
                        if ($count == 24) {
                            $count = 0;
                            $di = $di + 1;
                        } else {
                            if ($saida == 24) {
                                $saida = 0;
                            }
                            $saida = $saida + 1; 
                            $resul = $saida; 
                        }
                    }
                    //verificar horas 
                    $dias_h = $count;
                    if ($di > 0) {
                        if ($dias_h < 24) {
                            $dias_c = $dias_c + $dias_h;
                        }
                    }
                    //verificando se as horas somadas são 24hs
                    if ($horas < 24) {
                        $conf = $h + $t;
                        if ($conf > 24) {
                            $d = date('d');
                            $d = $d + 1;
                        }
                    }
                    if ($minutos != "00" and $hminutos != "00") {
                        $time = $minutos + $hminutos;
                        //Logica Repita quantidade de minutos
                        for ($i = 0; $i < $time; $i++) {
                            $mi = $mi + 1;
                            if ($mi >= 60) {
                                $mi = 0;
                                         if ($mi == 0) {$resul = $resul + 1;}
                                }
                            }
                        }else{
                            $mi = $minutos + $hminutos;
                        }
                    //filtra numeros sem zero a esquerda
                    switch ($mi) {
                        case 0:
                            $mi = "00";
                            break;
                        case 1:
                            $mi = "01";
                            break;
                        case 2:
                            $mi = "02";
                            break;
                        case 3:
                            $mi = "03";
                            break;
                        case 4:
                            $mi = "04";
                            break;
                        case 5:
                            $mi = "05";
                            break;
                        case 6:
                            $mi = "06";
                            break;
                        case 7:
                            $mi = "07";
                            break;
                        case 8:
                            $mi = "08";
                            break;
                        case 9:
                            $mi = "09";
                            break;
                    }  
                    if ($dias_c > 23) {
                        $d = $d + 1;
                    }
                    $final_M = date("t");
                    if ($d > $final_M) {
                        $d = 1;
                    }

                    
                   // echo $final_M,$d;
                    echo "<p><h6> Dados da chegada da viagem</h6></p>";
                    echo "<p><h6> Data da chegada: {$d}/{$m}</h6></p>";
                    echo "<p><h6> Hora da chegada: {$resul}:{$mi} - dias de viagem: {$di} | Horas:$count | Minutos: {$mi}</h6></p>";
                    $data_M = date('d/m/Y');
                    $data_u = "{$d}/{$m}";
                    $confir = 0;
                    echo "<p><h6> Digite a quant. de motorista </h6></p>";
                    echo "<input type=text name=quant id=quant size=2>";
                    echo "<p><h6> Digite a data da chegada </h6></p>";
                    echo "<input type=date name=chegada id=chegada >";
                    echo "<input type=submit name=cof id=cof value= Confirmar>";
                    echo "<br><p><h1></h1></p>";
                }
            }
            if (isset($_POST['cof'])) {
                $data_M = $_POST['chegada'];
                $limite_M = $_POST['quant'];
                $confir = 1;
                $respost = $db_c->motorista($limite_M, $data_M, $confir);
            }
            ?>
        </div>
    </form>

</body>

</html>