<?php
$msg[] = "<p style=\"color:#FF0000;font-size:14px;font-family:Verdana;\" align=\"center\">";
$sql = "";
class site
{
  //Filtra viagens do dia*************************************************************************************
  function semana($dias_v, $auto)
  {
    require("./conectar.php");
    //Variaveis
    $seg = "Monday";
    $ter = "Tuesday";
    $qua = "Wednesday";
    $qui = "Thursday";
    $sex = "Friday";
    $sab = "Saturday";
    $dom = "Sunday";
    $aponta  = date("l");
    $busca = "";
    $filtro = "";
    $direcao = "";
    $direto = 0;
    $valor = 0;
    $validas = 0;
    $color = "";
    //direção de da viagem e dia
    if ($dias_v == 1) {
      $direcao = "IDA";
    }
    if ($dias_v == 2) {
      $direcao = "VOLTA";
    }
    switch ($aponta) {
      case $seg:
        $aponta = "Segunda";
        if ($direcao == "IDA") {
          $busca = "S_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "S_V";
        }
        break;
      case $ter:
        $aponta = "Terça";
        if ($direcao == "IDA") {
          $busca = "T_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "T_V";
        }
        break;
      case $qua:
        $aponta = "Quarta";
        if ($direcao == "IDA") {
          $busca = "Q_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "Q_V";
        }
        break;
      case $qui:
        $aponta = "Quinta";
        if ($direcao == "IDA") {
          $busca = "Qu_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "Qu_V";
        }
        break;
      case $sex:
        $aponta = "Sexta";
        if ($direcao == "IDA") {
          $busca = "Se_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "Se_V";
        }
        break;
      case $sab:
        $aponta = "Sabado";
        if ($direcao == "IDA") {
          $busca = "Sa_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "Sa_V";
        }
        break;
      case $dom:
        $aponta = "Domingo";
        if ($direcao == "IDA") {
          $busca = "D_I";
        }
        if ($direcao == "VOLTA") {
          $busca = "D_V";
        }
        break;
    }
    //horario da viagem
    if ($direcao == "IDA") {
      $filtro = "I_H";
    }
    if ($direcao == "VOLTA") {
      $filtro = "V_H";
    }
    echo "<h3>{$direcao} | {$aponta}</h3>";
    //filtro de horario
    $manual = $auto;
    switch ($manual) {
      case 0:
        $control = date('H');
        echo "<h6>Horário: Automático</h6>";
        break;
      case 1:
        $control = 0;
        echo "<h6>Horário: Manhã Manual</h6>";
        break;
      case 2:
        $control = 12;
        echo "<h6>Horário: Tarde Manual</h6>";
        break;
      case 3:
        $control = 18;
        echo "<h6>Horário: Noite Manual</h6>";
        break;
    }

    $manha = 0;
    $tarde = 0;
    $noite = 0;
    $inciom = 0;
    $pesquisa = 0;
    $pesquisai = 0;

    if ($control >= 0 and $control <= 11) {
      $manha = "11:59";
      $inciom = "00:00";
      $pesquisai = $inciom;
      $pesquisa = $manha;
    }
    if ($control >= 12 and $control <= 17) {
      $tarde = "17:59";
      $inciot = "12:00";
      $pesquisai = $inciot;
      $pesquisa = $tarde;
    }
    if ($control >= 18 and $control <= 23) {
      $noite = "23:59";
      $incion = "18:00";
      $pesquisai = $incion;
      $pesquisa = $noite;
    }
    //mensagem com dados
    $control = date('H:i');
    echo "<h2>Hora Atual: {$control} hs | Filtro: {$pesquisai} á {$pesquisa}</h2>";
    //confirmar se encontrar ou não se e dia atual
    $query = mysqli_query($conn, "SELECT * FROM  `horario` WHERE  $filtro >= '$pesquisai' and $filtro <='$pesquisa' and $busca='1' AND Ativa='1' order by $filtro,prefixo asc") or die(mysqli_error($$mysqli));
    if (mysqli_num_rows($query)) {
      $estilos[0] = "background-color: #ecb605;font-size:18px;color:black;font-style:bold;font-family:Arial;
      text-align: center; width: auto;";
      if ($direcao == "IDA") {
        echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">Prefixo</td>
        <td style=\"$estilos[0]\">Linha</td>
        <td style=\"$estilos[0]\">Programado</td>
        <td style=\"$estilos[0]\">Ida</td>
        <td style=\"$estilos[0]\">Hora</td>
        <td style=\"$estilos[0]\">OBS</td>
        <td style=\"$estilos[0]\">MÊS</td>
        <td style=\"$estilos[0]\">%</td>
         </tr>";
      }
      if ($direcao == "VOLTA") {
        echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
        <td style=\"$estilos[0]\">Prefixo</td>
        <td style=\"$estilos[0]\">Linha</td>
        <td style=\"$estilos[0]\">Programado</td>
          <td style=\"$estilos[0]\">Volta</td>
          <td style=\"$estilos[0]\">Hora</td>
          <td style=\"$estilos[0]\">OBS</td>
          <td style=\"$estilos[0]\">Mês</td>
          <td style=\"$estilos[0]\">%</td>
           </tr>";
      }
      $reg = 0;
      while ($array = mysqli_fetch_row($query)) {
        $reg = $reg + 1;

        if ($array[7] <> "TODOS") {
          $color = "Orange";
        } else {
          $color = "white";
        }
        if ($array[8] <> "TODOS") {
          $color = "Crimson";
        } else {
          $color = "white";
        }
        $mes = date('mY');
        //$mes ="72022";
        $sql = mysqli_query($conn, "SELECT * from `mensal2022` WHERE prefixo='$array[0]' and mes='$mes'") or die(mysqli_error($mysqli));
        if (mysqli_num_rows($sql)) {
          while ($array1 = mysqli_fetch_row($sql)) {
            $validas = $array1[1];
            $direto = $array[2];
          }
          $valor = $validas / $direto * 100;
          $valor = intval($valor);
          if ($valor >= 100) {
            $color = "MediumSpringGreen";
          }
          if ($valor >= 50 and $valor <= 99) {
            $color = "Cyan";
          }
          if ($valor <= 49) {
            $color = "yellow";
          }
        }

        $estilos[1] = "background-color: {$color};font-size:16px;color:black;
      font-style:bold;font-family: Times New Roman, Times, serif;
      text-align: center; width: auto;";
        if ($direcao == "IDA") {
          echo "<tr>
            
            <td style=\"$estilos[1]\">$array[0]</td>
            <td style=\"$estilos[1]\">$array[1]</td>
            <td style=\"$estilos[1]\">$array[2]</td>
            <td style=\"$estilos[1]\">$array[3]</td>
            <td style=\"$estilos[1]\">$array[5]</td>
            <td style=\"$estilos[1]\">$array[25]</td>
            <td style=\"$estilos[1]\">$array[7]</td>
            <td style=\"$estilos[1]\">$valor%</td>
             </tr>";
        }
        if ($direcao == "VOLTA") {
          echo "<tr>
              
              <td style=\"$estilos[1]\">$array[0]</td>
              <td style=\"$estilos[1]\">$array[1]</td>
              <td style=\"$estilos[1]\">$array[2]</td>
              <td style=\"$estilos[1]\">$array[4]</td>
              <td style=\"$estilos[1]\">$array[6]</td>
              <td style=\"$estilos[1]\">$array[25]</td>
              <td style=\"$estilos[1]\">$array[7]</td>
              <td style=\"$estilos[1]\">$valor%</td>
               </tr>";
        }
      }
    }
  }
  
  //Calular porcentagem das linhas do mês**************************************************************************
  function porcento($mes)
  {
    require("./conectar.php");
    $direto = 0;
    $valor = 0;
    $total = 0;
    $valort = 0;
    $ano_m=""; 
    $ano_color ="";
    $dt = date('d/m/Y');
    $query = mysqli_query($conn, "SELECT * from `mensal2022` WHERE MES='$mes'") or die(mysqli_error($mysqli));
    if (mysqli_num_rows($query)) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
      $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
      $estilos[] = "text-align: center;font-size:14px; width: 100%;";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
      <td style=\"$estilos[0]\">Prefixo</td>
      <td style=\"$estilos[0]\">Validas</td>
      <td style=\"$estilos[0]\">Viagens</td>
      <td style=\"$estilos[0]\">%</td>
       </tr>";
      while ($array = mysqli_fetch_row($query)) {
        $sql = mysqli_query($conn, "SELECT  * from `horario` WHERE prefixo='$array[0]'") or die(mysqli_error($mysqli));
        if (mysqli_num_rows($sql)) {
          while ($array1 = mysqli_fetch_row($sql)) {
            $direto = $array1[2];
            $ano_m = $array1[7];
          }
        }
        $valor = $array[1] / $direto * 100;
        $valor = intval($valor);
        $color = "";
        if ($valor >= 100) {
          $color = "MediumSpringGreen";
        } elseif ($valor >= 50) {
          $color = "Aqua / Cyan";
        } elseif ($valor > 10) {
          $color = "Yellow";
        } elseif ($valor >= 0) {
          $color = "Red";
        }
        if($ano_m <> "TODOS"){$ano_color = "Red";
        }else{
          $ano_color = "GhostWhite";
        }
        echo "<tr>
              <td style=background-color:{$ano_color} align=center>$array[0]</td>
              <td style=background-color:{$ano_color} align=center>$array[1]</td>
              <td style=background-color:{$ano_color} align=center>$direto</td>
              <td style=background-color:{$color} align=center>{$valor}%</td>
              </tr>";
        $total = $total + $array[1];
      }
      $valort = $total / 1909 * 100;
      $_SESSION['valor'] =  $total / 1900 * 100;
      $valort = intval($valort);
      if ($valort >= 75) {
        $color = "green";
      }
      if ($valort < 70) {
        $color = "yellow";
      }
      if ($valort < 45) {
        $color = "red";
      }
      echo "<tr><td style=background-color:white align=center>Validas: {$total}</td>
      <td style=background-color:white align=center>Total mês: 1909 </td>
      <td style=background-color:white align=center>Geral: {$valort}% </td>
      <td style=background-color:white align=center>Data Atual: {$dt} </td>
      </tr>";
    }
  }
   //Alterações/Deletar/Adicionar/pesquisar - Motoristas**************************************************************
   function mupdate($limite_u, $data_u)
   {
     if (empty($limite_u) or ($limite_u == 0)) {
       echo " Error na confirmação das informação";
     } else {
       require("./conectar.php");
       $query = mysqli_query($conn, "SELECT  DISTINCT * from `motoristas` WHERE LIVRE=0 limit $limite_u") or die(mysqli_error($mysqli));
       if (mysqli_num_rows($query)) {
         while ($array = mysqli_fetch_row($query)) {
           if (empty($data_u)) {
             echo "<br>Data chegada inexistente {$data_u}<br>";
           } else {
             $cpf = $array[1];
             $sql = mysqli_query($conn, "UPDATE motoristas SET DATA_M='$data_u',LIVRE=1 WHERE CPF='$cpf'") or die(mysqli_error($mysqli));
             echo "Motoristas: {$limite_u} - Data Saída: {$data_c} e chegada: {$data_u}";
             echo "Viagem confirmada";
           }
         }
       }
     }
   }
   function motorista($limite_M, $data_M, $confir)
  {
    require("./conectar.php");
    $query = mysqli_query($conn, "SELECT  DISTINCT * from `motoristas` WHERE LIVRE=0 and ATIVO=1 limit $limite_M") or die(mysqli_error());
    if (mysqli_num_rows($query)) {
      $estilos[] = "text-align: center; background-color: rgba(90,96,113);font-size:14px;color:white;";
      $estilos[] = "text-align: center;font-size:14px; font-style: oblique;";
      $estilos[] = "text-align: center;font-size:14px; width: 200%;";
      echo "<table style=\"width: 100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody> <tr>
      <td style=\"$estilos[0]\">Nome</td>
      <td style=\"$estilos[0]\">CPF</td>
       </tr>";
      while ($array = mysqli_fetch_row($query)) {
        echo "<tr>
                 <td style=background-color:white align=center>$array[0]</td>
                 <td style=background-color:white align=center>$array[1]</td>
              </tr>";
        if ($confir == 1) {
          $cpf = $array[1];
          $sql = mysqli_query($conn, "UPDATE motoristas SET DATA_M='$data_M',LIVRE=1 WHERE CPF='$cpf'") or die(mysqli_error());
        }
      }
      echo "<p><h6> {$limite_M} - Motoristas estarão livre depois do dia {$data_M}</h6></p>";
    }
  }
    //Alterações/Deletar/Adicionar/pesquisar - Linhas**************************************************************
  function pesq_viagens($prefixo, $linha)
  {
    require("./conectar.php");
    if (empty($prefixo)) {
      echo "<script> alert('O campo linha é obrigatorio!')</script>";
    } else {
      $viai = 0;
      $viav = 0;
      $query = mysqli_query($conn, "SELECT * FROM horario WHERE prefixo ='$prefixo'");
      if (mysqli_num_rows($query)) {
        while ($array = mysqli_fetch_row($query)) {
          $linha = $array[1];
          $_SESSION['Horas'] = $array[9];
          $_SESSION['Minutos'] = $array[10];
          $_SESSION['prefixo'] = $array[0];
          $viai  = $array[3];
          $viav = $array[4];
          echo "<p><h6> Linha: {$prefixo} Hora:{$_SESSION['Horas']} Min.:{$_SESSION['Minutos']} | Itinerário: {$linha} <br><br>Ida Viagem: {$viai} | Volta Viagem: {$viav} <br><br>Ida: {$array[5]} | Volta: {$array[6]}</h6></p>";
        }
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $m_ = strftime(' %B de %Y', strtotime('today'));
        echo "<p><h6> Mês do ano: {$m_}</h6></p>";
        $_SESSION['prefixo'] = $prefixo;
      } else {
        echo "<script> alert('Registro não encontrado!')</script>";
        $_SESSION['prefixo'] = "";
      }
    }
  }

  function adicionar_horario($PREFIXO, $LINHA, $V_Mes, $V_I, $V_V, $I_H, $V_H, $OBS, $H_I, $M_I, $IDA, $VOLTA, $S_I, $T_I, $Q_I, $Qu_I, $Se_I, $Sa_I, $D_I, $S_V, $T_V, $Q_V, $Qu_V, $Se_V, $Sa_V, $D_V, $Ativa)
  {
    require("./conectar.php");
    $mysqli = "";
    if (empty($PREFIXO)) {
      echo "<script> alert('O campo prefixo é obrigatorio!')</script>";
    } else {
      $resultado = mysqli_query($conn, "SELECT * FROM `horario` WHERE `PREFIXO`='$PREFIXO'");
      if (mysqli_num_rows($resultado)) {
        //filtra numeros sem zero a esquerda
        $resultado = mysqli_query($conn, "UPDATE `horario` SET `I_H`='$I_H',`V_H`='$V_H',`V_I`='$V_I',`V_V`='$V_V',`V_Mes`='$V_Mes',`LINHA`='$LINHA',`OBS`='$OBS',H_I='$H_I',M_I='$M_I',IDA='$IDA',VOLTA='$VOLTA',S_I=$S_I,T_I=$T_I,Q_I=$Q_I,Qu_I=$Qu_I,Se_I=$Se_I,Sa_I=$Sa_I,D_I=$D_I,S_V=$S_V,T_V=$T_V,Q_V=$Q_V,Qu_V=$Qu_V,Se_V=$Se_V,Sa_V=$Sa_V,D_V=$D_V,Ativa=$Ativa WHERE `PREFIXO`='$PREFIXO'");
        echo "<script> alert('Registro alterado com sucesso!') </script>";
      } else {
        echo "<script> alert('Registro não encontrado!') </script>";
      }
    }
  }
  function novo_horario($PREFIXO)
  {
    require("./conectar.php");
    if (empty($PREFIXO)) {
      echo "<script> alert('O campo prefixo é obrigatorio!')</script>";
    } else {
      $resultado = mysqli_query($conn, "SELECT * FROM `horario` WHERE `PREFIXO`='$PREFIXO'");
      if (mysqli_num_rows($resultado)) {
        echo "<script> alert('Registro já existe') </script>";
      } else {
        $resultado = mysqli_query($conn, "INSERT INTO `horario`(`PREFIXO`) VALUES ('$PREFIXO')");
        echo "<script> alert('Registro criado com sucesso') </script>";
      }
    }
  }

  function del_horario($PREFIXO, $busque)
  {
    require("./conectar.php");
    if (empty($PREFIXO)) {
      echo "<script> alert('O campo prefixo é obrigatorio!')</script>";
    } else {
      $resultado = mysqli_query($conn, "SELECT * FROM `horario` WHERE `PREFIXO`='$PREFIXO'");
      if (mysqli_num_rows($resultado)) {
        $resultado = mysqli_query($conn, "DELETE FROM `horario` WHERE `PREFIXO`='$PREFIXO'");
        echo "<script> alert('Registro deletado!') </script>";
      } else {
        $resultado = mysqli_query($conn, "INSERT INTO `horario`(`PREFIXO`) VALUES ('$PREFIXO');");
        echo "<script> alert('Registro não encontrado!') </script>";
      }
    }
  }
  function list_linhas()
  {
    require("./conectar.php");
    $color ="";
    $cor =""
;      $query = mysqli_query($conn, "SELECT * FROM horario WHERE 1");
      if (mysqli_num_rows($query)) {
        $estilos[0] = "background-color: #ecb605;font-size:18px;color:black;font-style:bold;font-family:Arial;
        text-align: center; width: 100%;";
       
        echo "<table style=\"width: Auto\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tbody><tr>
          <td style=\"$estilos[0]\">Prefixo</td>
          <td style=\"$estilos[0]\">Linha</td>
          <td style=\"$estilos[0]\">Prog</td>
          <td style=\"$estilos[0]\">V_I</td>
          <td style=\"$estilos[0]\">V_I</td>
          <td style=\"$estilos[0]\">Ida</td>
          <td style=\"$estilos[0]\">Volta</td>
          <td style=\"$estilos[0]\">MÊS Ida</td>
          <td style=\"$estilos[0]\">MÊS Volta</td>
           </tr>";
        while ($array = mysqli_fetch_row($query)) {
          $cor = $array[7];
          if($cor == "TODOS"){$color = "Snow";}else{$color = "Yellow";}

          $estilos[1] = "background-color:{$color};font-size:16px;color:black;
          font-style:bold;font-family: Times New Roman, Times, serif;
          text-align: center; width: 100%;";
          echo "<tr>
              
          <td style=\"$estilos[1]\">$array[0]</td>
          <td style=\"$estilos[1]\">$array[1]</td>
          <td style=\"$estilos[1]\">$array[2]</td>
          <td style=\"$estilos[1]\">$array[3]</td>
          <td style=\"$estilos[1]\">$array[4]</td>
          <td style=\"$estilos[1]\">$array[5]</td>
          <td style=\"$estilos[1]\">$array[6]</td>
          <td style=\"$estilos[1]\">$array[7]</td>
          <td style=\"$estilos[1]\">$array[8]</td>
           </tr>";
        }
      } 
  }
  //login*************************************************************************************************
  function log($senha, $nome)
  {
    require("./conectar.php");
    $query = mysqli_query($conn, "SELECT * FROM `acesso` WHERE usuario='$nome'");
    if (mysqli_num_rows($query)) {
      while ($array = mysqli_fetch_row($query)) {
        $cript = $array[2];
        $sen = base64_decode($cript);
        if ($senha == $sen) {
          date_default_timezone_set('America/Sao_Paulo');
          $_SESSION['data'] = date('d/m/Y H:i');
          $_SESSION['acesso_pag'] = $array[6];
          $_SESSION['nome'] = $array[1];
          if ($_SESSION['acesso_pag'] <> 1) {
            $_SESSION['nivel'] = "Padrão";
          } else {
            $_SESSION['nivel'] = "Administrador";
          }
          $_SESSION['estilo'] = $array[7];
          header('Location: principal.php');
        } else {
          echo "<script>alert('Acesso negado tente novamente senha incorreta!')</script>";
        }
      }
      return $query;
    } else {
      echo "<script>alert('Acesso negado tente novamente nome incorreto!')</script>";
    }
  }
}
