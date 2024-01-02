<?php
header("Content-type: application/json; charset=utf-8");

    $pdo = new PDO("mysql:host=localhost;dbname=links_aeroporto", "root", "root", array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));

    if (empty($filtro)) {
        $sql = "SELECT * FROM `links_aeroporto` LIMIT 12";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $resposta = array('sucesso', $result);
        echo(json_encode($resposta, true));
    }

