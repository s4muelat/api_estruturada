<?php 

require('config.php');

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){
    $sql = $pdo->query("SELECT * FROM login_usuarios");
    if($sql->rowCount() <> 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item){
            $array['result'][] = [
                'id' => $item['id'],
                'email' => $item['email'],
                'senha' => $item['senha']
            ];
        }
    } 
} else {
    $array['error'] = 'Metodo não permetido(apenas get)';
}

require('return.php');
