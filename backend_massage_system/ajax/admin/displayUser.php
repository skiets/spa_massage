<?php

$db = new MysqliApp();




$sql = "SELECT 
            id,
            name,
            contact,
            user_type,
            username,
            DATE_FORMAT(added_on, '%b %d,%Y %h:%i%p') AS added_on
        FROM
            admin_tbl
        WHERE
            status = 'active'";
$query = $db -> fetchAll($sql);


if(!empty($query)){
    $return = $query;
}else{
    $return = [];
}


$data = array(
    "result" => $return
);

echo json_encode($data);