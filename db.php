
<?php

class db{

    protected $con;

    function setconnection()
    {

    


            $con = mysqli_connect("localhost","root","sheru123#","library_management_system");

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
              }
         
             echo "Connection Done";

        
        
       

        }


    }
