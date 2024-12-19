<?php

$db = new MysqliApp();




$sql = "SELECT 
            id as value,
            name as label
        FROM
            admin_tbl
        WHERE
            status = 'active'
        AND
            user_type = 'staff'";
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