<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Create Account</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");





if($_POST){

    $result= $database->query("select * from webuser");

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['personal']['address'];
    //$nid=$_SESSION['personal']['nid'];
    $dob=$_SESSION['personal']['dob'];
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    $clinic  = 'Popular';
    $area  = 'Dhaka';
    $activity  = 'Inactive';
    $specialties  = 1;
    if ($newpassword==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{

            // File upload handling for NID photo
            $nidPhotoFileName = $_FILES['nid_photo']['name'];
            $nidPhotoTmpName = $_FILES['nid_photo']['tmp_name'];
            $nidPhotoUploadPath = 'img/doctor/' . $nidPhotoFileName;

            move_uploaded_file($nidPhotoTmpName, $nidPhotoUploadPath);

            // File upload handling for Certificate
            $certificateFileName = $_FILES['certificate']['name'];
            $certificateTmpName = $_FILES['certificate']['tmp_name'];
            $certificateUploadPath = 'img/doctor/' . $certificateFileName;

            move_uploaded_file($certificateTmpName, $certificateUploadPath);

            // Insert doctor information into the database
            $database->query("INSERT INTO doctor (docemail, docname, docpassword, docarea, docclinic, docactivity, doctel, specialties, nid_photo, certificate) VALUES ('$email', '$name', '$newpassword', '$address', '$clinic', '$activity', '$tele', '$specialties', '$nidPhotoUploadPath', '$certificateUploadPath')");


//            $database->query("INSERT INTO doctor (docemail, docname, docpassword, docarea, docclinic, docactivity, doctel, specialties) VALUES ('$email', '$name', '$newpassword', '$address', '$clinic', '$activity', '$tele', '$specialties')");
            $database->query("insert into webuser values('$email','d')");

          //  print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$area','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="d";
            $_SESSION["username"]=$fname;

            header('Location: doctor/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }

    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }




}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>


    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Create Account</p>
                    <p class="sub-text">It's Okey, Now Create User Account.</p>
                </td>
            </tr>

            <tr>
                <form action="" method="POST" enctype="multipart/form-data">

            </tr>

            <tr id="doctor-fields">
                <td class="label-td" colspan="2">
                    <label for="certificate" class="form-label">Doctor Nid: </label>
                </td>
            </tr>
            <tr id="doctor-fields">
                <td class="label-td" colspan="2">
                    <input type="file" name="nid_photo" class="input-text" accept="image/*">
                </td>
            </tr>
            <tr id="doctor-fields">
                <td class="label-td" colspan="2">
                    <label for="certificate" class="form-label">Doctor Certificate: </label>
                </td>
            </tr>
            <tr id="doctor-fields">
                <td class="label-td" colspan="2">
                    <input type="file" name="certificate" class="input-text" accept="application/pdf">
                </td>
            </tr>

            <!-- new -->
            <!-- <tr id="doctor-fields">
                <td class="label-td" colspan="2">
                    <label for="specialties" class="form-label">Doctor Specialties: </label>
                </td>
            </tr>
            <tr id="doctor-fields">
                <td class="label-td" colspan="2">
                    <input type="file" name="specialties" class="input-text" accept="text">
                </td>
            </tr> -->


            
            <!-- new -->

            <tr>
                <td class="label-td" colspan="2">
                    <label for="newemail" class="form-label">Email: </label>
                </td>
                
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </td>

            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tele" class="form-label">Mobile Number: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="tel" name="tele" class="input-text"  placeholder="Mobile Number:">
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="newpassword" class="form-label">Create New Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="cpassword" class="form-label">Conform Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required>
                </td>
            </tr>
     
            <tr>
                
                <td colspan="2">
                    <?php echo $error ?>

                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
</body>
</html>