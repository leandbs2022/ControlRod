<?php

class DB {
	function conectar ($host, $port, $user, $password, $database) {
		@ $link = mysqli_connect($server.":".$port, $user, $password);
		if (!$link) {
			die("Não foi possível conectar-se ao SGDB mysqlii, por favor contate o Administrador do Sistema: ".mysqlii_error());
		}
		@ $selectdb = mysqli_select_db($database, $link);
		if (!$selectdb) {
			die("Não foi possível selecionar o Banco de Dados. <br /><br /> ".mysqlii_error());
		}
	}
}

?>