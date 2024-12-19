<?php


$db = new MysqliApp();


$data = isset($_POST['data']) ? json_decode($_POST['data'],true) : null;


if($data != null){

    $sql = "INSERT INTO invoice_tbl(client_id, inv,price) VALUES (?,?,?)";
    $params = [
        $data['id'],
        $data['invNo'],
        $data['price']
    ];
    $query = $db -> query($sql,$params);




    $sql = "UPDATE client_tbl SET status = 'completed' WHERE id = ?";
    $query = $db -> query($sql,[$data['id']]);


    $return = true;

}else{
    $return = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);