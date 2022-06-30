<?php
include("data_class.php");

$addname=$_POST['addname'];
$addpass=$_POST['addpass'];
$addemail=$_POST['addemail'];
$type_user=$_POST['type'];

$obj=new data();
$con = mysqli_connect("localhost","root","sheru123#","library_management_system");
$obj->addnewuser($addname,$addpass,$addemail,$type_user);
?>