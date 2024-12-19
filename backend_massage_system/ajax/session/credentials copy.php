<?php

if (isset($_SESSION['spaMassage']) && !empty($_SESSION['spaMassage'])) {
  

    $return = true;
    
}else{
    $result = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);