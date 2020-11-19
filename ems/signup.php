<?php
//datbase connection file
include('includes/config.php');

  // require_once(mycontroller . "api.cntrl.php");
 include("conf/conf.php");
error_reporting(1);
// Signup Process
if(isset($_POST['signup']))
{

// Getting Post values
$companyname=$_POST['name'];
$uname=$_POST['username'];
$address=$_POST['address'];
$contact_person=$_POST['contact_person']; 
$emailid=$_POST['email'];   
$pnumber=$_POST['phone_no']; 
$password=md5($_POST['pass']);  
$cpassword=md5($_POST['confirm_pass']);  

if($password==$cpassword)
{
  $flds = array(
        "name",
        "username",
        "address",
        "email",
        "phono_no",
        "contact_person",
        "password",
        "status",
        "created_at",
    );


    $vls = array($companyname,
        $uname,
        $address,
        $emailid,
        $pnumber,
        $contact_person,
        $password,
        "1",
        date('Y-m-d')
      
    );


$status=1;
// query for data insertion
// $sql="INSERT INTO tblusers(FullName,UserName,Emailid,PhoneNumber,UserGender,UserPassword,IsActive) VALUES(:fname,:uname,:emailid,:pnumber,:gender,:password,:status)";
// //preparing the query
// $query = $dbh->prepare($sql);
// //Binding the values
// $query->bindParam(':fname',$fname,PDO::PARAM_STR);
// $query->bindParam(':uname',$uname,PDO::PARAM_STR);
// $query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
// $query->bindParam(':pnumber',$pnumber,PDO::PARAM_STR);
// $query->bindParam(':gender',$gender,PDO::PARAM_STR);
// $query->bindParam(':password',$password,PDO::PARAM_STR);
// $query->bindParam(':status',$status,PDO::PARAM_STR);
// //Execute the query
// $query->execute();

            $row_check = $wcntr->check_exist("tblcompany", "username", $uname);

if (isset($row_check['id'])) {
                $msg = "User Name is Already in use!";
                echo "<script>alert('Error : ".$msg."');</script>";   
            } else {
                $txtabtsave = $wcntr->insert_data("tblcompany", $flds, $vls);
               echo "<script>alert('Success : User signup successfull. Now you can signin');</script>";
                echo "<script>window.location.href='signin.php'</script>";
            }


//Check that the insertion really worked
//$lastInsertId = $dbh->lastInsertId();
// if($lastInsertId)
// {
// echo "<script>alert('Success : User signup successfull. Now you can signin');</script>";
// echo "<script>window.location.href='signin.php'</script>";	
// }
// else 
// {
// echo "<script>alert('Error : Something went wrong. Please try again');</script>";	
// }

}
else
{
     echo "<script>alert('Error : Mismatch Confirm Password!');</script>";
                echo "<script>window.location.href='signup.php'</script>";
}
}
    ?>

<!doctype html>
<html class="no-js" lang="en">
    <head>

        <title>Event Management System | user signup </title>
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- icofont css -->
        <link rel="stylesheet" href="css/icofont.css">
		<!-- Nivo css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
		<!-- animaton text css -->
        <link rel="stylesheet" href="css/animate-text.css">
		<!-- Metrial iconic fonts css -->
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- color css -->
		<link href="css/color/skin-default.css" rel="stylesheet">
        
		<!-- modernizr css -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
<script>
    function checkpassword(){
        $pwd=$('#pass').val();
        $cfrmpwd=$('#confirm_pwd').val();
        if($pwd!=$cfrmpwd)
        {
            $("#userpwd-status").html('Mismatch Confirm Password!');

        }
    }
function checkusernameAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:{'uname':$("#username").val(),'type':'COMPANY' },
type: "POST",
success:function(data){
$("#username-availabilty-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

    </head>
    <body>
        <!--body-wraper-are-start-->
         <div class="wrapper single-blog">
         
           <!--slider header area are start-->
           <div id="home" class="header-slider-area">
                <!--header start-->
                   <?php include_once('includes/header.php');?>
                <!-- header End-->
            </div>
           <!--slider header area are end-->
            
            <!--  breadcumb-area start-->
            <div class="breadcumb-area bg-overlay">
                <div class="container">
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Signup</li>
                    </ol>
                </div>
            </div> 
            <!--  breadcumb-area end-->    

            <!-- main blog area start-->
            <div class="single-blog-area ptb100 fix">
               <div class="container">
                   <div class="row">
                       <div class="col-md-8 col-sm-7">
                           <div class="single-blog-body">


                        
                                <div class="Leave-your-thought mt50">
                                    <h3 class="aside-title uppercase">User Signup</h3>
                                    <div class="row">
                                        <form name="signup" method="post">
                                            <div class="col-md-12 col-sm-6 col-xs-12 lyt-left">
                                                <div class="input-box leave-ib">
<input type="text" placeholder="Company Name" class="info" name="name" required="true">

<input type="text" placeholder="Username" class="info" name="username" id="username" required="true" onBlur="checkusernameAvailability()">
<span id="username-availabilty-status" style="font-size:14px;"></span> 
<textarea placeholder="Address" class="info"   name="address" required="true"></textarea>
<input type="email" placeholder="Email Id" class="info" name="email" required="true">
<input type="text" placeholder="Contact Person" class="info" name="contact_person" id="contact_person" required="true" >

<input type="tel" placeholder="Phone Number" pattern="[0-9]{10}" title="10 numeric characters only" class="info" name="phone_no" maxlength="10" required="true">

<input type="password" name="pass" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info" required /> 
<span style="font-size:11px; color:red">Password atleast one number and one uppercase and lowercase letter, and at least 6 or more characters</span>

<input type="password" name="confirm_pass" id="confirm_pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Confirm Password" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="info" required onblur="checkpassword();" /> 

<span id="userpwd-status" style="font-size:14px;"></span>
</div>
                                            </div>
                                       
                                            <div class="col-xs-12">
                                                <div class="input-box post-comment">
                                                    <input type="submit" value="Submit" id="signup" name="signup" class="submit uppercase"> 
                                                </div>
                                            </div>
 <div class="col-xs-12 mt30">
 <div class="input-box post-comment" style="color:blue;"> 
 	Already Registered  <a href="signin.php"> Signin here</a>
</div>
</div>


                                        </form>
                                    </div>
                                </div>
                           </div>
                       </div>
                        <!--sidebar-->
                       
                      <?php include_once('includes/sidebar.php');?>
               </div>
           </div></div>
            <!--main blog area start-->

            <!--information area are start-->
                 <?php include_once('includes/footer.php');?>
            <!--footer area are start-->
         </div>   
        <!--body-wraper-are-end-->
		
		<!--==== all js here====-->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-3.1.1.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- Nivo js -->
        <script src="js/nivo-slider/jquery.nivo.slider.pack.js"></script>
        <script src="js/nivo-slider/nivo-active.js"></script>
		<!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- Youtube Background JS -->
        <script src="js/jquery.mb.YTPlayer.min.js"></script>
		<!-- datepicker js -->
        <script src="js/bootstrap-datepicker.js"></script>
		<!-- waypoint js -->
        <script src="js/waypoints.min.js"></script>
		<!-- onepage nav js -->
        <script src="js/jquery.nav.js"></script>
        <!-- animate text JS -->
        <script src="js/animate-text.js"></script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
        <!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
