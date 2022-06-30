<?php
//addserver_page.php
include("data_class.php");





$bookname=$_POST['bookname'];
$bookdetail=$_POST['bookdetail'];
$bookpub=$_POST['bookpub'];
$branch=$_POST['branch'];
$bookprice=$_POST['bookprice'];
$bookquantity=$_POST['bookquantity'];
$bookaudor=$_POST['bookaudor'];

$c=0;

if($bookname!=null )
 $c=1;
 if($bookdetail!=null )
 $c=2;
 if($bookpub!=null )
 $c=3;
 if($branch!=null )
 $c=4;
 if($bookprice!=null )
 $c=5;
 if($bookquantity!=null )
 $c=6;
 if($bookaudor!=null )
 $c=7;






if (move_uploaded_file($_FILES["bookphoto"]["tmp_name"],"uploads/" . $_FILES["bookphoto"]["name"]) && c==7) {

    $bookpic=$_FILES["bookphoto"]["name"];

$obj=new data();
$con = new mysqli("localhost","root","sheru123#","library_management_system");
$obj->addbook($bookpic,$bookname,$bookdetail,$bookaudor,$bookpub,$branch,$bookprice,$bookquantity);
  } 
  else {


     echo "File not uploaded and some details were missing";
  }