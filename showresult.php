<?php
$sports = [];
$users = [];

$con = new mysqli('localhost:8111','root','','porseshname');
if($con->connect_error){
    die("connection Failed: ". $con->connect_error);
}
$con->set_charset('utf8');
$sql = "SELECT count(`anq_userid`) as `count_users`, anq_sportid FROM answers_qus2 GROUP BY `anq_sportid`";
$result = $con->query($sql);


if($result->num_rows > 0){
    $index = 0 ;
    while($row = $result->fetch_assoc()){
        $users[$index] = $row['count_users'];
        $spr_id = $row['anq_sportid'];
        //echo $spr_id;
        $sql2 = "SELECT * FROM sports WHERE `spr_id`=$spr_id";
        $result2 = $con->query($sql2);
        $row2 = $result2->fetch_assoc();
        $sports[$index] = $row2['spr_name'];
        $index++;
    }
    $json_data = array("sports"=>$sports,"users"=>$users);

    echo json_encode($json_data); 
}
