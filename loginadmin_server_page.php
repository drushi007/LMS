<?php

include("data_class.php");

$login_password=$_GET['login_password'];

$login_email=$_GET['login_email'];
//validations
if($login_email==null ||$login_password==null )
{

    $emailmsg="";
    $pasdmsg="";


    //Traverse between pages
   
    
    if($login_email==null)
    {
        $emailmsg="Email Empty";
    }
    if($login_password==null)
    {
        $pasdmsg="Password  Empty";
    }

    header("Location:index.php?ademailmsg=$emailmsg&adpasdmsg=$pasdmsg");

    
}

elseif($login_email!=null && $login_password!=null)
{


$obj=new data();

$obj-> setconnection();
$obj->adminLogin($login_email,$login_password);
}
?>