<?php

$db = new MysqliApp();




$sql = "SELECT 
            id,
            fullname,
            email,
            contact_number,
            client_type,
            DATE_FORMAT(sched_date, '%b %d,%Y') AS sched_date,
            sched_time,
            status,
            NULL as services
        FROM
            client_tbl
      
        ORDER BY id DESC";
$query = $db -> fetchAll($sql);

if(!empty($query)){

    foreach ($query as $querykey => $queryvalue) {
        $sql = "SELECT
                a.id,
                b.name,
                b.price
            FROM 
                client_service a
            LEFT JOIN
                services_tbl b ON b.id = a.service_id

            WHERE
                a.client_id = ?";
        $service = $db -> fetchAll($sql,[$queryvalue['id']]);

        if(!empty($service)){
            foreach ($service as $servicekey => $servicevalue) {
               $query[$querykey]['services'][$servicekey] = $servicevalue;
            }
        }
    }
    

    $return = $query;
}else{
    $return = [];
}


$data = array(
    "result" => $return
);

echo json_encode($data);