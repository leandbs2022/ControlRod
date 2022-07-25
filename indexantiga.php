<?php
session_start();
session_unset();
session_destroy();
require("./class/class.site.php");
//variaveis
$site = new site;
$array = "";
$data = "";
$nome = "";
$senha = "";
$nivel = "";
$comemoracao = "";
$pararLoop = 0;
$fundo = "img\fundo.jpg";
$ususrio = "";
$deletar = 0;
$criar = 0;
$alterar = 0;
$criar = 0;
$alterar = 0;
$acesso_pag = 0;
$estilo = 0;

session_start();
$_SESSION['usuario'] = 0;
$_SESSION['senha'] = 0;
$_SESSION['deletar'] = 0;
$_SESSION['criar'] = 0;
$_SESSION['alterar'] = 0;
$_SESSION['acesso_pag'] = 0;
$_SESSION['estilo'] = 0;
$_SESSION['Horas'] = 0;
$_SESSION['Minutos'] = 0;
$_SESSION['prefixo'] = 0;
$_SESSION['valor'] = 0;
$_SESSION['mesp'] = 0;
$_SESSION['estilo'] = 0;
$_SESSION['admin'] = 0;
$_SESSION['nome'] = "";
$_SESSION['data'] = "";
$_SESSION['nivel'] = "";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <link rel="shortcut icon" href="img/icons/elite/ICO/My Network.ico" type="img/icons/elite/ICO">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <link href="css/styles_login.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/icons/elite/ICO/My Network.ico" type="img/icons/elite/ICO">
    <title img>Login</title>
    <script src="js/catedral.js"></script>
</head>

<body>
    <form id="form1" name="form1" method="post" action="">
        <div class="container">
            <div class=" ">
                <br>
                <br>
                <h2>CONTROLE DE ACESSO</h2>
            </div>
            <section id="primaria">
                <h6>
                <p>Usuários:
                    <input name="nome" type="text" id="nome" tabindex="2" size="10">
                    Senha:
                    <input name="senha" type="password" id="senha" tabindex="2" size="10">
                    <input type="submit" name="login" id="login" value="Entrar" tabindex="3">
                    <br>
                </p>
                <p>
                    <?php
                    if (isset($_POST['login'])) {
                        require("./conectar.php");
                        $senha = $_POST['senha'];
                        $nome = $_POST['nome'];
                        if (empty($senha)) {
                            echo "<script>alert('Digite uma senha para entrar!')</script>";
                        } else {
                            $query = mysqli_query($conn, "SELECT * FROM acesso WHERE 1");
                            if (mysqli_num_rows($query)) {
                                $resposta = $site->log($senha, $nome);
                                echo "Login: {$_SESSION['nome']} || {$_SESSION['data']} ||  {$_SESSION['nivel']}";
                            } else {
                                $nome = "Administrador";
                                $senha = "123admin";
                                $cript = base64_encode($senha);
                                $deletar = 1;
                                $alterar = 1;
                                $criar = 1;
                                $acesso_pag = 1;
                                $estilo = 0;
                                $query = mysqli_query($conn,"INSERT INTO acesso(usuario, senha, deletar,criar,alterar,acesso_pag,estilo) VALUES ('$nome','$cript','$deletar','$criar', '$alterar','$acesso_pag','$estilo')");
                                echo "<script>alert('Esse e seu primeiro acesso. O usuario administrador foi criando a e senha 123admin. Apos o acesso favor mudar a senha para sua seguranca')</script>";
                            }
                        }
                    }
                    ?>
                </p>
            </section>
        </div>
        </h6>
        </from>
</body>

</html>