<?php
require_once 'config.php';

$method = strtoupper($_SERVER['REQUEST_METHOD']);
$metodo_tipo = 'POST';

if($method === $metodo_tipo) {
    
    $nome = filter_input(INPUT_POST, 'nome');
    $usuario = filter_input(INPUT_POST, 'usuario');
    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'senha');
    $ativo = filter_input(INPUT_POST, 'ativo');
    $bloqueado = filter_input(INPUT_POST, 'bloqueado');
    
    if($nome && $usuario && $email && $senha && $ativo && $bloqueado) {
        //$sql = "INSERT INTO login_usuarios (nome, usuario, email, senha, ativo, bloqueado) VALUE (:nome, :usuario, :email, MD5(':senha'), :ativo, :bloqueado)";
        $sql = $pdo->prepare("INSERT INTO login_usuarios (nome, usuario, email, senha, ativo, bloqueado) VALUES (:nome, :usuario, :email, MD5(:senha), :ativo, :bloqueado)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->bindValue(':ativo', $ativo);
        $sql->bindValue(':bloqueado', $bloqueado);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => "$id",            
        ];
    
    }
    else {
        $array['error'] = 'Campos não enviados';
        exit;
    } 


} else {
    $array['error'] = "Método não permitido (apenas $metodo_tipo)";
    }

require_once 'return.php';