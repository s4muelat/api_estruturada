<?php
require_once 'config.php';

$method = strtoupper($_SERVER['REQUEST_METHOD']);
if($method === 'DELETE'){

    parse_str(file_get_contents('php://input'), $input);
    $id = filter_var($input['id'] ?? null);

    if($id) {

        $sql = $pdo->prepare("SELECT * FROM login_usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {

            $sql = $pdo->prepare("DELETE FROM login_usuarios WHERE id = $id");
            $sql->bindValue('id', $id);
            $sql->execute();
            
            $array['result'] = [
                'id' => $id,
                'delete' => 'ok'
            ];
            
        } else {
            $array['error'] = 'ID inexistente';
        }     
    } else {
        $array['error'] = 'ID não enviado';
    }

}else{
    $array['error'] = 'Método não permitido (apenas DELETE)';
}

require_once 'return.php';