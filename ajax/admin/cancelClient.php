<?php


$db = new MysqliApp();



$data = isset($_POST['data']) ? json_decode($_POST['data'],true) : null;



if($data != null){



    $sql = "UPDATE client_tbl SET status = 'cancelled' WHERE id = ?";
    $query = $db -> query($sql,[$data]);


    $return = true;

}else{
    $return = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);