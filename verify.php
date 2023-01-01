<?php
$user = $_POST['item']['user'];
$pass = $_POST['item']['pass'];

$con = new mysqli('localhost:8111','root','','porseshname');
if($con->connect_error){
    die("connection Failed: ". $con->connect_error);
}
$sql = "SELECT * FROM students WHERE stu_ssn=$user and stu_code=$pass";
$result = $con->query($sql);

if($result->num_rows >= 1){
    while($row = $result->fetch_assoc()){
        if($row['stu_ssn'] === '4591111111'){
            echo '2';
            exit(0);
        }else{
            echo '1';
             exit(0);
        }
    }
    
}else{
    echo '0';
    exit(0);
}
$con->close();