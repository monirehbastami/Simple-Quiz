<?php 
global $sports;
global $provinces;
global $cities;

$con = new mysqli('localhost:8111','root','','porseshname');
if($con->connect_error){
    die("connection Failed: ". $con->connect_error);
}
$con->set_charset('utf8');

$sql = "SELECT * FROM sports ORDER BY spr_id";
$result = $con->query($sql);
if($result->num_rows >= 1){
    while($row = $result->fetch_assoc()){
        $sports[$row['spr_id']] = $row['spr_name'];
    }
}

$sql = "SELECT * FROM province ORDER BY prv_id";
$result = $con->query($sql);
if($result->num_rows >= 1){
    while($row = $result->fetch_assoc()){
        $provinces[$row['prv_id']] = $row['prv_name'];
    }
}

$sql = "SELECT * FROM city ORDER BY cit_id";
$result = $con->query($sql);
if($result->num_rows >= 1){
    $index=0;
    while($row = $result->fetch_assoc()){
        $cities[$index] = $row;
        $index++;
    }
}
