<?php
$connection = mysqli_connect("localhost","root","","medhealth");

//check connection
if (mysqli_connect_errno()) {
    echo "fail to connect to database: " .mysqli_connect_error();
    exit();
}else{
   // echo 'database connection successfully';
}
