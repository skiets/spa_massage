<?php

const keyCode  = 'spal@gin';

$db = new MysqliApp();
$encrypt = new apiKeys();


$id = $_SESSION['spaMassage']['user_id'];

$data = isset($_POST['data']) ? json_decode($_POST['data'],true) : null;



if($data != null){



    $sql = "SELECT user_type FROM admin_tbl WHERE id = ? AND status = 'active'";
    $checker = $db -> fetchRow($sql,[$id]);
    
    
    if(!empty($checker)){
        if($checker['user_type'] == 'admin'){
           $sql = "INSERT INTO admin_tbl (name, username, password, contact, user_type) 
            VALUES (?, ?, ?, ?, ?);";
            
            $params = [
                $data['fullname'],
                $data['username'], 
                $encrypt -> Encode($data['password'],keyCode),
                $data['contact'],
                $data['userType'],
            ];
            $db -> query($sql,$params);

            $return = true;
        }else{
            $return = false;
        }
    }else{
        $return = false;
    }
   
 
 

}else{
    $result = false;
}



$data = array(
    "result" => $return
);

echo json_encode($data);