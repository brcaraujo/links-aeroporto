<?php
header("Content-type: application/json; charset=utf-8");

$dados = file_get_contents('php://input');
$dadosArray = json_decode($dados, true);


// var_dump($dadosArray);
// exit;


$pdo = new PDO("mysql:host=localhost;dbname=links_aeroporto", "root", "root", array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));

$slq = "INSERT INTO `links_aeroporto` (`codAeroporto`, `titulo`, `descricao`, `link`, `icone`)
                                        VALUES (:codAeroporto, :titulo, :descricao, :link, :icone)";
$stmt = $pdo->prepare($slq);

$stmt->bindValue(':codAeroporto', $dadosArray['codAeroporto']);
$stmt->bindValue(':titulo', $dadosArray['tituloLink']);
$stmt->bindValue(':descricao', $dadosArray['descricaoLink']);
$stmt->bindValue(':link', $dadosArray['link']);
$stmt->bindValue(':icone', "icone.png");

if ($stmt->execute()) {
    $msg = array('sucesso', 'Link Cadastrado.');
    echo (json_encode($msg, true));
} else {
    $msg = array('erro', '');
    echo (json_encode($msg, true));
}
