<?php

$db = new MysqliApp();



$data = isset($_POST['data']) ? json_decode($_POST['data'],true) : null;



if($data != null){

 
    $sql = "INSERT INTO services_tbl (name, price) 
            VALUES (?, ?);";
            
    $params = [
        $data['name'],
        $data['price']
    ];
    $db -> query($sql,$params);

    $return = true;

}else{
    $result = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);