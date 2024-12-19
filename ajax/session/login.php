<?php
const keyCode  = 'spal@gin';

$db = new MysqliApp();
$encrypt = new apiKeys();

$data = isset($_POST['data']) ? json_decode($_POST['data'],true) : null;



if($data != null){
    $password =  $encrypt -> Encode($data['password'],keyCode);
    $sql = "SELECT * FROM admin_tbl WHERE username = ? and password = ? AND status = 'active' ";
    $params = [
        $data['username'],
        $password
    ];
    $query = $db -> fetchRow($sql,$params);
   
   if(!empty($query)){
           $_SESSION['spaMassage'] = [
        'username' => $data['username'],
        'user_id' => $query['id'],
        'logged_in' => true
    ];

  
    $return = true;
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