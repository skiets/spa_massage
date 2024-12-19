<?php

$db = new MysqliApp();




$sql = "SELECT 
            id,
            name,
            DATE_FORMAT(added_on, '%b %d,%Y %h:%i%p') AS added_on,
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