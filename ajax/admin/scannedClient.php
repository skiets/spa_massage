<?php
const keyCode  = 'spa123';

$db = new MysqliApp();
$decode = new apiKeys();


$data = isset($_POST['decodeQrcode']) ? $_POST['decodeQrcode'] : null;



if($data != null){

    $rawCode = $decode -> Decode($data,keyCode);


    $parts = explode("~", $rawCode);


    $number = $parts[1];


    $sql = "SELECT id FROM client_tbl WHERE id = ? AND status = 'arrived'";
    $check = $db -> fetchRow($sql,[$number]);



    if(empty($check)){
        $sql = "UPDATE client_tbl SET status = 'arrived' WHERE id = ?";
        $query = $db -> query($sql,[$number]); 
        $return = true;
    }else{
        $return = false;
    }

}else{
    $return = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);