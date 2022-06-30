<?php

session_start();
include("db.php");

class data extends db{

    private $bookpic;
    private $bookname;
    private $bookdetail;
    private $bookaudor;
    private $bookauthor;
    private $bookpub;
    private $branch;
    private $bookprice;
    private $bookquantity;
    private $type;

    private $book;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;
    private $name;
    private $email;
    private $password;
    private $type_user;
    


    function __construct()
    {

        echo "working";
    }


    function adminLogin($t1,$t2){

        $con = mysqli_connect("localhost","root","sheru123#","library_management_system");



        $q="SELECT * FROM admin where email='$t1' and password='$t2'";

        $recordSet = mysqli_query($con, $q);
        
         $result=mysqli_num_rows($recordSet);

       

         

        if($result>0)
        {

            foreach($recordSet->fetch_all() as $row)
            {

                $logid= $row[0];
                $_SESSION["adminId"]=$logid;
               
                header("Location:admin_service_dashboard.php");
            }
           
        }
        else if($result<=0){

            
            header("Location:index.php?msg=Invalid Credentials");
        }

        }



        function userLogin($t1, $t2) {

            $con = mysqli_connect("localhost","root","sheru123#","library_management_system");

            $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";

            $recordSet = mysqli_query($con, $q);



        
            $result=mysqli_num_rows($recordSet);
            
            if ($result > 0) {
    
                foreach($recordSet->fetch_all() as $row) {
                    $logid=$row[0];

                    header("location: otheruser_dashboard.php?userlogid=$logid");
                }
            }
    
            else {
            
                header("location: index.php?msg=Invalid Credentials");
            }
    
        }



        function addnewuser($name,$password,$email,$type_user)

        {

            $con = new mysqli("localhost","root","sheru123#","library_management_system");

            if ($con->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
           
            $this->$name=$name;
            
            $this->$password=$password;
            $this->$email=$email;
            $this->$type_user=$type_user;
           
        
    

            $stmt = $con->prepare("INSERT INTO userdata(name, email, pass,type)VALUES('$name','$email','$password','$type_user')");


           
            $result = $stmt->get_result();


            if( $stmt->execute()) // you are executing connection here
            {
                header("Location:admin_service_dashboard.php?msg=New Add done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=Register Fail");
            }
    
            


        }


        function addbook($bookpic,$bookname,$bookdetail,$bookaudor,$bookpub,$branch,$bookprice,$bookquantity) {
            $this->$bookpic=$bookpic;
            $this->$bookname=$bookname;
            $this->$bookdetail=$bookdetail;
            $this->$bookaudor=$bookaudor;
            $this->$bookpub=$bookpub;
            $this->$branch=$branch;
            $this->$bookprice=$bookprice;
            $this->$bookquantity=$bookquantity;




         

            {



                $con = new mysqli("localhost","root","sheru123#","library_management_system");

           
    
         

           $stmt = $con->prepare("INSERT INTO book (bookpic,bookname, bookdetail, bookauthor, bookpub, branch, bookprice,bookquantity,bookava,bookrent)
           VALUES('$bookpic', '$bookname', '$bookdetail', '$bookaudor', '$bookpub', '$branch', '$bookprice', '$bookquantity','$bookquantity',0)");




if( $stmt->execute()) // you are executing connection here
{
    header("Location:admin_service_dashboard.php?msg=New Book Added");
}

else {
    header("Location:admin_service_dashboard.php?msg=Failed to add book");
}

            }
           

         
         
      
           

        }
       

        function userdata()
        {
            
            $con = mysqli_connect("localhost","root","sheru123#","library_management_system");

            $q="SELECT * FROM userdata";

            $recordSet = mysqli_query($con, $q);
            
             return $recordSet;
        }






          // issue book
    function issuebook($book,$userselect,$days,$getdate,$returnDate){
        $this->$book= $book;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;

        $con = mysqli_connect("localhost","root","sheru123#","library_management_system");



        $q="SELECT * FROM book where bookname='$book'";
        $recordSetss=mysqli_query($con, $q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=mysqli_query($con, $q);
        $result=mysqli_num_rows($recordSet);

        if ($result > 0) {

            foreach($recordSet->fetch_all() as $row) {
                $issueid=$row[0];
                $issuetype=$row[4];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetch_all() as $row) {
                $bookid=$row[0];
                $bookname=$row[2];

                    $newbookava=$row[9]-1;
                     $newbookrent=$row[10]+1;
            }

        
            $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";

            $stmt = $con->prepare($q);
            if($stmt->execute()){

            $q="INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES($issueid,'$userselect','$book','$issuetype','$days','$getdate','$returnDate','0')";

            $stmt = $con->prepare($q);
            if($stmt->execute()) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                
                echo $stmt->error;
                
            }
            }

            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }


        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
            
        }


    }



    function delteuserdata($id){
        


        $con = mysqli_connect("localhost","root","sheru123#","library_management_system");

        $q="DELETE from userdata where id='$id'";

        $stmt = $con->prepare($q);

        if($stmt->execute()){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }



    function deletebook($id){
      

        $con = mysqli_connect("localhost","root","sheru123#","library_management_system");



        $q="DELETE from book where id='$id'";
        
        

        $stmt = $con->prepare($q);
        
        if($stmt->execute()){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }


    // issue issuebookapprove
    function issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$redid){
        $this->$book= $book;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
    
        $this->$returnDate=$returnDate;

           $con = mysqli_connect("localhost","root","sheru123#","library_management_system");

           $q="SELECT * FROM book where bookname='$book'";

        $recordSetss = mysqli_query($con, $q);
      


       
       

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=mysqli_query($con, $q);
        $result=mysqli_num_rows($recordSet);

        if ($result > 0) {

            foreach($recordSet->fetch_all() as $row) {
                $issueid=$row[0];
                $issuetype=$row[4];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetch_all() as $row) {
                $bookid=$row[0];
                $bookname=$row[2];

                    $newbookava=$row[9]-1;
                     $newbookrent=$row[10]+1;
            }

        
            $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";

            $stmt = $con->prepare($q);
            if($stmt->execute()){

            $q="INSERT INTO issuebook (userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$book','$issuetype','$days','$getdate','$returnDate','0')";

            $stmt = $con->prepare($q);
            if($stmt->execute()) {

                $q="DELETE from requestbook where id='$redid'";

                $recordSet=mysqli_query($con, $q);
               
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }




        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
    













    // get issue book

    function getissuebook($userloginid) {

        $newfine="";
        $issuereturn="";


        
        $con = mysqli_connect("localhost","root","sheru123#","library_management_system");

       

   

        $q="SELECT * FROM issuebook where userid='$userloginid'";
        $recordSetss = mysqli_query($con, $q);


        foreach($recordSetss->fetch_all() as $row) {
            $issuereturn=$row['issuereturn'];
            $fine=$row['fine'];
            $newfine= $fine;

            
                //  $newbookrent=$row['bookrent']+1;
        }


        $getdate= date("d/m/Y");
        
        if($issuereturn<$getdate){
            $q="UPDATE issuebook SET fine='$newfine' where userid='$userloginid'";

            $stmt = $con->prepare($q);
            

            if($stmt->execute()) {
                $q="SELECT * FROM issuebook where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;
            }
            else{
               
            
                $q="SELECT * FROM issuebook where userid='$userloginid'";
                $recordSetss = mysqli_query($con, $q);
                return $recordSetss;  
            }

        }
        else{
            $q="SELECT * FROM issuebook where userid='$userloginid'";
            $recordSetss = mysqli_query($con, $q);
            return $recordSetss;

        }






    }





    //request book

    function requestbook($userid,$bookid){

        $con = mysqli_connect("localhost","root","sheru123#","library_management_system");



    


        $q="SELECT * FROM book where id='$bookid'";
        $recordSetss=mysqli_query($con, $q);

        $q="SELECT * FROM userdata where id='$userid'";
        $recordSet=mysqli_query($con, $q);

        foreach($recordSet->fetch_all() as $row) {
            $username=$row[1];
            $usertype=$row[4];
        }

        foreach($recordSetss->fetch_all() as $row) {
            $bookname=$row[2];
        }

        if($usertype=="student"){
            $days=7;
        }
        if($usertype=="teacher"){
            $days=21;
        }


        $q="INSERT INTO requestbook (userid,bookid,username,usertype,bookname,issuedays)VALUES('$userid', '$bookid', '$username', '$usertype', '$bookname', '$days')";

        $stmt = $con->prepare($q);

        if($stmt->execute()) {
            header("Location:otheruser_dashboard.php?userlogid=$userid");
        }

        else {
            header("Location:otheruser_dashboard.php?msg=fail");
        }

    }



       

    
}