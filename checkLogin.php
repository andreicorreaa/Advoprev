<?php
	require_once("model/entidades.php"); //necessario para acessar os getters e setters da session objeto
    session_start();
    if(isset($_SESSION['login'])){ //checa se existe uma session iniciada
        $data = unserialize($_SESSION['login']); // monta o objeto na variavel $data (o serialize é necessário para transformar o objeto
    }else{
        header('location: index.php');
    }
?>