<?php


$db = new MysqliApp();



$data = isset($_POST['data']) ? json_decode($_POST['data'],true) : null;



if($data != null){



    $sql = "UPDATE services_tbl SET status = 'deactive' WHERE id = ?";
    $query = $db -> query($sql,[$data]);


    $return = true;

}else{
    $result = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);