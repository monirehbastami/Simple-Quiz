<?php 
//'item[birthdate]':birthdate.value,'item[province]':selectedProvince,'item[city]':selectedCity,'item[phone]':phone.value,'item[email]':email.value,'item[level]':selectedR,'item[desc]':desc.value,'item[sports]':sports
$birthdate = $_POST['item']['birthdate'];
$province = $_POST['item']['province'];
$city = $_POST['item']['city'];
$phone = $_POST['item']['phone'];
$email = $_POST['item']['email'];
$desc = $_POST['item']['desc'];
$sports = $_POST['item']['sports'];
$level = $_POST['item']['level'];

$con = new mysqli('localhost:8111','root','','porseshname');
if($con->connect_error){
    die("connection Failed: ". $con->connect_error);
}
$birthdate +=0;
$birthdate /=1000;
$sql = "INSERT INTO users (`usr_birthdate`,`usr_provinceid`,`usr_cityid`,`usr_email`,`usr_phone`) VALUES ('$birthdate',$province,$city,'$email','$phone')";
$result = $con->query($sql);



$user_id = 0;
$sql = "SELECT `usr_id` FROM users ORDER BY usr_id DESC LIMIT 0,1";
$result = $con->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $user_id = $row['usr_id'];
    }
}


$sql = "INSERT INTO answers (`ans_userid`,`ans_qus1`,`ans_qus2`,`ans_qus3`) VALUES ($user_id,$level,1,'$desc')";
$result = $con->query($sql);


foreach($sports as $key => $value){
    $sql = "INSERT INTO answers_qus2 (`anq_userid`,`anq_sportid`) VALUES ($user_id,$value)";
    $result = $con->query($sql);
}


if($result === true){
    echo '1';
}else{
    echo 'sql'.$sql;
}

$con->close();
