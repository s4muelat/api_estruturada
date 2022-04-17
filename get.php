<?php
require_once 'config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);
if($method === 'get'){
  $id = filter_input(INPUT_GET, 'id');

  if($id){
    $sql = $pdo->prepare("SELECT * FROM login_usuarios WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowcount() > 0){
      $data = $sql->fetch(PDO::FETCH_ASSOC);
     
       $array['result'] = [
            "id" => $data['id'],
            'nome' => $data['nome'],
            'usuario' => $data['usuario'],
            "email" => $data['email'],
            'senha' => $data['senha'],
            'ativo' => $data['ativo'],
            'bloqueado' => $data['bloqueado'],
            "cadastro" => $data['cadastro']
          ];
        } else {
          $array['error'] = 'ID inexistente';
      }
    }else{
        $array['error'] = 'ID não enviado';
      }
   
   }else{
    $array['error'] = 'Método não permitido apenas GET';
}

require_once 'return.php';