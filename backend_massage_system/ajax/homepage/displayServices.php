<?php

$db = new MysqliApp();




$sql = "SELECT 
            id,
            name,
            price
        FROM
            services_tbl
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