<?php

$db = new MysqliApp();




$sql = "SELECT 
            a.id,
            b.fullname,
            a.inv,
            b.client_type,
           a.price
        FROM
            invoice_tbl a
        LEFT JOIN
            client_tbl b ON b.id = a.client_id
      
        ORDER BY id DESC";
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