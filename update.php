<?php
require_once 'config.php';

$method = strtoupper($_SERVER['REQUEST_METHOD']);
if($method === 'PUT'){

    parse_str(file_get_contents('php://input'), $input);

    $id       = $input['id'] ?? null;
    $nome     = $input['nome'] ?? null;
    $usuario  = $input['usuario'] ?? null;
    $email    = $input['email'] ?? null;
    $senha    = $input['senha'] ?? null;
    $ativo    = $input['ativo'] ?? null;
    $bloquedo = $input['bloqueado'] ?? null;

    $id       = filter_var($id);
    $nome     = filter_var($nome);
    $usuario  = filter_var($usuario);
    $email    = filter_var($email);
    $senha    = filter_var($senha);
    $ativo    = filter_var($ativo);
    $bloquedo = filter_var($bloquedo);

    if($id && $nome && $usuario && $email && $senha && $ativo && $bloquedo) {

        $sql = $pdo->prepare("SELECT * FROM login_usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {

            $sql = $pdo->prepare("UPDATE login_usuarios SET nome = :nome, usuario = :usuario, email = :email, senha = MD5(:senha), ativo = :ativo, bloqueado = :bloqueado WHERE id = :id");
            $sql->bindValue('id', $id);
            $sql->bindValue('nome', $nome);
            $sql->bindValue('usuario', $usuario);    
            $sql->bindValue('email', $email);    
            $sql->bindValue('senha', $senha);
            $sql->bindValue('ativo', $ativo);
            $sql->bindValue('bloqueado', $bloquedo);
            $sql->execute();
            
            $array['result'] = [
                'id' => $id,
                'up' => 'ok'
            ];
            
        } else {
            $array['error'] = 'ID inexistente';
        }     
    } else {
        $array['error'] = 'Dados não enviados';
    }

}else{
    $array['error'] = 'Método não permitido (apenas PUT)';
}

require_once 'return.php';