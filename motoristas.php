<!-- PHP VARIAVEIS E CLASSES-->
<?php
//session_start();
require("./class/class.site.php");
require("./conectar.php");
$_SESSION['confirmado'] = 0;
$cad = new site;

$selecionado = "";
$data = date('dmY');
$confirma = "0";
$estilo_fundo = 0
?>
<!doctype html>
<html lang="pt-br">
<head>
    <title> Cadastro de motoristas </title>
    <meta charset="uft-8">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS - FOLHA DE ESTILO-->
    <?php
    if ($estilo_fundo == 0) {
        echo "<link href=css/styles.css rel=stylesheet type=text/css>";
    }
    if ($estilo_fundo == 1) {
        echo "<link href=css/styles1.css rel=stylesheet type=text/css>";
    }
    ?>
    <script src="js/catedral.js"></script>
</head>
<body onblur=""> 
    <form action="" method="POST" name="form1" id="form1">
        <?php
        if (isset($_POST['pesq2'])) {
            $PREFIXO = $_POST['id'];
            $resultado = mysqli_query($conn, "SELECT * FROM `horario` WHERE PREFIXO='$PREFIXO' ");
            if (mysqli_num_rows($resultado)) {
                while ($array = mysqli_fetch_row($resultado)) {
                    $PREFIXO = $array[0];
                    $linha  = $array[1];
                    $V_Mes = $array[2];
                    $V_I = $array[3];
                    $V_V = $array[4];
                    $I_H = $array[5];
                    $V_H = $array[6];
                    $IDA = $array[7];
                    $VOLTA = $array[8];
                    $H_I = $array[9];
                    $M_I = $array[10];
                    //SEMANA IDA
                    $S_I = $array[11];
                    $T_I = $array[12];
                    $Q_I = $array[13];
                    $Qu_I = $array[14];
                    $Se_I = $array[15];
                    $Sa_I = $array[16];
                    $D_I = $array[17];
                    //SEMANA VOLTA
                    $S_V = $array[18];
                    $T_V = $array[19];
                    $Q_V = $array[20];
                    $Qu_V = $array[21];
                    $Se_V = $array[22];
                    $Sa_V = $array[23];
                    $D_V = $array[24];
                    $OBS = $array[25];
                    $Ativa = $array[26];
                }
                $_POST['prefixo'] =  $PREFIXO;
                $_POST['linha'] = $linha;
                $_POST['infor'] = $OBS;
            } else {
                echo "<script> alert('Não existe o prefixo informado') </script>";
            }
        }

        ?>
        <script>
            function del() {
                alert('teste')
            }
        </script>
        <header class="container">
            <h1>Dias e Horários das viagens</h1>
        </header>
        <div class="container">
            <button type="button" onclick="pagehome()" name="Voltar" id="Voltar" class="btn btn-secondary btn-sm">Voltar</button>
            <input type="submit" name="pesq2" id="pesq2" class="btn btn-secondary btn-sm" value="Localizar por prefixo" />
            <input type="text" name="id" id="id" size="25" value="" placeholder="Digite o prefixo">
            <?php
            if ($Ativa == 1) {
                $selecionado = "checked";
            } else {
                $selecionado = "";
            }
            ?>
            <br>
            <h6>Situação ativa:</h6> <input type="checkbox" name="ativ" id="ativ" value="1" <?php echo $selecionado; ?>>
            <h6>Prefixo</h6>
            <input type="text" name="prefixo" id="prefixo" size="10" maxlength="10" value="<?php echo $PREFIXO; ?>" placeholder="">
            <input type="submit" name="novo" id="novo" class="btn btn-secondary btn-sm" value="Criar um novo prefixo" onblur="" onfocus="" onclick="" />
            <input type="submit" name="alterar" id="alterar" class="btn btn-secondary btn-sm" value="Alterar registro" onblur="" onfocus="" onclick="" />
            <input type="submit" name="del" id="del" class="btn btn-secondary btn-sm" value="Deletar registro" onblur="" onfocus="" onclick="" />
            <h6>Linha</h6>
            <input type="text" name="linha" id="linha" size="50" maxlength="50" value="<?php echo $linha; ?>">
            <h6>Viagem programadas</h6>
            <input type="text" name="via_p" id="via_p" size="3" maxlength="3" value="<?php echo $V_Mes; ?>">
            <h6>Viagem Ida do dia</h6>
            <input type="text" name="via_i" id="via_i" size="3" maxlength="3" value="<?php echo $V_I; ?>">
            <h6>Viagem Volta do dia</h6>
            <input type="text" name="via_v" id="via_v" size="3" maxlength="3" value="<?php echo $V_V; ?>">
            <h6>Horas de viagem</h6>
            <h6>Horas: </h6><input type="text" name="hor_i" id="hor_i" size="3" maxlength="3" value="<?php echo $H_I; ?>">
            <h6>Minutos: </h6><input type="text" name="min_i" id="min_i" size="2" maxlength="2" value="<?php echo $M_I; ?>">
            <h6>Meses do ano(Ida)</h6>
            <input type="text" name="mes_i" id="mes_i" size="30" maxlength="30" value="<?php echo $IDA; ?>">
            <h6>Meses do ano(Volta)</h6>
            <input type="text" name="mes_v" id="mes_v" size="30" maxlength="30" value="<?php echo $VOLTA; ?>">
            <fieldset>
                <br>
                <div>
                    <table>
                        <tr>
                            <td>
                                <h6>Viagem: Ida Hora: <input type="text" name="ida" id="ida" value="<?php echo $I_H; ?>" size="5" maxlength="5">hs<br><br>
                                <?php

                                if ($S_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Segunda: <input type="checkbox" name="se_i" id="se_i" value="1" <?php echo $selecionado; ?>>
                                <?php

                                if ($T_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Terça:<input type="checkbox" name="te_i" id="te_i" value="1" <?php echo $selecionado; ?>>
                                <?php

                                if ($Q_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Quarta<input type="checkbox" name="qua_i" id="qua_i" value="1" <?php echo $selecionado; ?>>
                                <?php

                                if ($Qu_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Quinta:<input type="checkbox" name="qui_i" id="qui_i" value="1" <?php echo $selecionado; ?>>
                                <?php

                                if ($Se_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Sexta:<input type="checkbox" name="sex_i" id="sex_i" value="1" <?php echo $selecionado; ?>>
                                <?php

                                if ($Sa_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Sábado:<input type="checkbox" name="sab_i" id="sab_i" value="1" <?php echo $selecionado; ?>>
                                <?php

                                if ($D_I == 1) {
                                    $selecionado = "checked";
                                } else {
                                    $selecionado = "";
                                }
                                ?>
                                Domingo:<input type="checkbox" name="dom_i" id="dom_i" value="1" <?php echo $selecionado; ?>>
                            </td>
                        </tr>
                        </h6>
                </div>
                <div>
                    <tr>
                        <td> <br>
                            <h6>Viagem: Volta Hora: <input type="text" name="volta" id="volta" value="<?php echo $V_H; ?>" size="5" maxlength="5">hs<br><br>
                            <?php
                            if ($S_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Segunda: <input type="checkbox" name="se_v" id="se_v" value="1" <?php echo $selecionado; ?>>
                            <?php

                            if ($T_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Terça:<input type="checkbox" name="te_v" id="te_v" value="1" <?php echo $selecionado; ?>>
                            <?php

                            if ($Q_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Quarta<input type="checkbox" name="qua_v" id="qua_v" value="1" <?php echo $selecionado; ?>>
                            <?php

                            if ($Qu_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Quinta:<input type="checkbox" name="qui_v" id="qui_v" value="1" <?php echo $selecionado; ?>>
                            <?php

                            if ($Se_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Sexta:<input type="checkbox" name="sex_v" id="sex_v" value="1" <?php echo $selecionado; ?>>
                            <?php

                            if ($Sa_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Sábado:<input type="checkbox" name="sab_v" id="sab_v" value="1" <?php echo $selecionado; ?>>
                            <?php

                            if ($D_V == 1) {
                                $selecionado = "checked";
                            } else {
                                $selecionado = "";
                            }
                            ?>
                            Domingo:<input type="checkbox" name="dom_v" id="dom_i" value="1" <?php echo $selecionado; ?>>
                        </td>
                    </tr>
                    </table>
                    </h6>
                </div>
            </fieldset>

            <br>
            <h6>Viagens Extras</h6>
            <textarea type="text" id="infor" name="infor" rows="5" maxlength="500" cols="50" value="" placeholder=""><?php echo $OBS; ?></textarea>
            <br>
        </div>
        <div class="container">
            <?php
            if (isset($_POST['novo'])) {
                if ($_SESSION['admin'] == 1) {
                    $PREFIXO = $_POST['prefixo'];
                    $S_I = (isset($_POST['se_i']) ? $_POST['se_i'] : 0);
                    $T_I = (isset($_POST['te_i']) ? $_POST['te_i'] : 0);
                    $Q_I = (isset($_POST['qua_i']) ? $_POST['qua_i'] : 0);
                    $Qu_I = (isset($_POST['qui_i']) ? $_POST['qui_i'] : 0);
                    $Se_I = (isset($_POST['sex_i']) ? $_POST['sex_i'] : 0);
                    $Sa_I = (isset($_POST['sab_i']) ? $_POST['sab_i'] : 0);
                    $D_I = (isset($_POST['dom_i']) ? $_POST['dom_i'] : 0);
                    //__________________________________________________
                    $S_V = (isset($_POST['se_v']) ? $_POST['se_v'] : 0);
                    $T_V = (isset($_POST['te_v']) ? $_POST['te_v'] : 0);
                    $Q_V = (isset($_POST['qua_v']) ? $_POST['qua_v'] : 0);
                    $Qu_V = (isset($_POST['qui_v']) ? $_POST['qui_v'] : 0);
                    $Se_V = (isset($_POST['sex_v']) ? $_POST['sex_v'] : 0);
                    $Sa_V = (isset($_POST['sab_v']) ? $_POST['sab_v'] : 0);
                    $D_V = (isset($_POST['dom_v']) ? $_POST['dom_v'] : 0);
                    //____________________________________________________
                    $Ativa = (isset($_POST['ativ']) ? $_POST['ativ'] : 0);
                    $linha  = $_POST['linha'];
                    $V_Mes = $_POST['via_p'];
                    $V_I = $_POST['via_i'];
                    $V_V = $_POST['via_v'];

                    $IDA = $_POST['mes_i'];
                    $VOLTA = $_POST['mes_v'];
                    $H_I = $_POST['hor_i'];
                    $M_I = $_POST['min_i'];

                    $I_H = $_POST['ida'];
                    $V_H = $_POST['volta'];
                    $OBS = $_POST['infor'];

                    $funcao01 = $cad->novo_horario($PREFIXO, $linha, $V_Mes, $V_I, $V_V, $I_H, $V_H, $OBS, $H_I, $M_I, $IDA, $VOLTA, $S_I, $T_I, $Q_I, $Qu_I, $Se_I, $Sa_I, $D_I, $S_V, $T_V, $Q_V, $Qu_V, $Se_V, $Sa_V, $D_V, $Ativa);
                } else {
                    echo "<script> alert('Você não tem permissão de criar registros')</script>";
                }
            }
            if (isset($_POST['alterar'])) {
                if ($_SESSION['admin'] == 0) {
                    $PREFIXO = $_POST['prefixo'];
                    $S_I = (isset($_POST['se_i']) ? $_POST['se_i'] : 0);
                    $T_I = (isset($_POST['te_i']) ? $_POST['te_i'] : 0);
                    $Q_I = (isset($_POST['qua_i']) ? $_POST['qua_i'] : 0);
                    $Qu_I = (isset($_POST['qui_i']) ? $_POST['qui_i'] : 0);
                    $Se_I = (isset($_POST['sex_i']) ? $_POST['sex_i'] : 0);
                    $Sa_I = (isset($_POST['sab_i']) ? $_POST['sab_i'] : 0);
                    $D_I = (isset($_POST['dom_i']) ? $_POST['dom_i'] : 0);
                    //__________________________________________________
                    $S_V = (isset($_POST['se_v']) ? $_POST['se_v'] : 0);
                    $T_V = (isset($_POST['te_v']) ? $_POST['te_v'] : 0);
                    $Q_V = (isset($_POST['qua_v']) ? $_POST['qua_v'] : 0);
                    $Qu_V = (isset($_POST['qui_v']) ? $_POST['qui_v'] : 0);
                    $Se_V = (isset($_POST['sex_v']) ? $_POST['sex_v'] : 0);
                    $Sa_V = (isset($_POST['sab_v']) ? $_POST['sab_v'] : 0);
                    $D_V = (isset($_POST['dom_v']) ? $_POST['dom_v'] : 0);
                    //____________________________________________________
                    $Ativa = (isset($_POST['ativ']) ? $_POST['ativ'] : 0);
                    $linha  = $_POST['linha'];
                    $V_Mes = $_POST['via_p'];
                    $V_I = $_POST['via_i'];
                    $V_V = $_POST['via_v'];

                    $IDA = $_POST['mes_i'];
                    $VOLTA = $_POST['mes_v'];
                    $H_I = $_POST['hor_i'];
                    $M_I = $_POST['min_i'];

                    $I_H = $_POST['ida'];
                    $V_H = $_POST['volta'];
                    $OBS = $_POST['infor'];

                    $funcao01 = $cad->adicionar_horario($PREFIXO, $linha, $V_Mes, $V_I, $V_V, $I_H, $V_H, $OBS, $H_I, $M_I, $IDA, $VOLTA, $S_I, $T_I, $Q_I, $Qu_I, $Se_I, $Sa_I, $D_I, $S_V, $T_V, $Q_V, $Qu_V, $Se_V, $Sa_V, $D_V, $Ativa);
                } else {
                    echo "<script> alert('Você não tem permissão de alterar registros')</script>";
                }
            }
            if (isset($_POST['del'])) {
                if ($_SESSION['admin'] == 1) {
                    $PREFIXO = $_POST['prefixo'];
                    $result =  $cad->del_horario($PREFIXO, $busque);
                } else {
                    echo "<script> alert('Você não tem permissão de deletar registros')</script>";
                }
            }
            ?>
            <BR>
            <h3>Versão 2.0.0</h3>
        </div>
    </form>
    <!-- javascript-->
    <script>
        var x = document.getElementById("form1")
        x.addEventListener("focus", myFocusFunction, true)
        x.addEventListener("blur", myBlurFunction, true)

        function pagehome() {
            alert ('pagina em desenvolvimento')
            window.location.href = "principal.php";
        }

        function myFocusFunction() {


        }

        function myBlurFunction() {


        }
    </script>
</body>

</html>