<?php
//create connection to database
$conn =mysqli_connect("localhost","root","","hotel_booking");

//check connection
if(mysqli_connect_error()){
    //connect fail
    echo 'Falied to connect ro Mysqli';
}else{
    echo 'Connection succesful';
}

?>