<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
    <style>
    .dashbord-tables {
        animation: transitionIn-Y-over 0.5s;
    }

    .filter-container {
        animation: transitionIn-Y-bottom 0.5s;
    }

    .sub-table,
    .anime {
        animation: transitionIn-Y-bottom 0.5s;
    }


    </style>

</head>

<body>
    <?php
    //learn from w3schools.com

    session_start();

    if (isset($_SESSION["user"])) {
        if ($_SESSION["user"] == "" or $_SESSION["usertype"] != "p") {
            header("location: ../login.php");
        } else {
            $useremail = $_SESSION["user"];
        }
    } else {
        header("location: ../login.php");
    }

    //import database
    include "../connection.php";
    $userrow = $database->query(
        "select * from patient where pemail='$useremail'"
    );
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];
    //echo "Error executing the query: " . $database->error;
    //echo  $useremail;
//echo $userid;
//echo $username;
?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr(
                                        $username,
                                        0,
                                        13
                                    ); ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr(
                                        $useremail,
                                        0,
                                        22
                                    ); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Home</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">All Doctors</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Scheduled Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Bookings</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>
    <!-- <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
                        <a href="settings.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Settings</p></a></div>
                    </td>
    </tr> -->

    </table>
    </div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td colspan="1" class="nav-bar">
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home</p>

                </td>
         
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set("Asia/Dhaka");

                        $today = date("Y-m-d");
                        echo $today;

                        $patientrow = $database->query(
                            "select  * from  patient;"
                        );
                        $doctorrow = $database->query(
                            "select  * from  doctor;"
                        );
                        $appointmentrow = $database->query(
                            "select  * from  appointment where appodate>='$today';"
                        );
                        $schedulerow = $database->query(
                            "select  * from  schedule where scheduledate='$today';"
                        );
                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4" class="">

                    <center>
                        <table class="filter-container doctor-header patient-header" border="0">
                            <tr>
                                <td>
                                    <h3>Welcome!</h3>
                                    <h1><?php echo $username; ?>.</h1>
                                    <h3>Search area-wise specialties</h3>
                                    <form action="" method="post" class="header-search" style="display: flex">

                                        <input type="search" name="search" class="input-text " placeholder="Search Area"
                                            list="doctors" style="width:45%;">&nbsp;&nbsp;
                                        <?php
                                        echo '<datalist id="doctors">';
                                        $list11 = $database->query(
                                            "select * from  doctor;"
                                        );

                                        for (
                                            $y = 0;
                                            $y < $list11->num_rows;
                                            $y++
                                        ) {
                                            $row00 = $list11->fetch_assoc();
                                            $d = $row00["docarea"];
                                            echo "<option value='$d'><br/>";
                                        }
                                        echo " </datalist>";
                                        ?>
                                        <input type="search" name="specialties" class="input-text "
                                            placeholder="Specialties" list="doctors1" style="width:45%;">&nbsp;&nbsp;
                                        <?php
                                        echo '<datalist id="doctors1">';
                                        $list11 = $database->query(
                                            "select * from  specialties;"
                                        );

                                        for (
                                            $y = 0;
                                            $y < $list11->num_rows;
                                            $y++
                                        ) {
                                            $row00 = $list11->fetch_assoc();
                                            $d = $row00["sname"];
                                            echo "<option value='$d'><br/>";
                                        }
                                        echo " </datalist>";
                                        ?>
                                        <input type="Submit" value="Search" class="login-btn btn-primary btn"
                                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        <br>
                                        <br>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </center>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table  width="100%">
                            <tr>
                                <td width=" 100%">

                        <center>
                            
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // Retrieve values from the form
                                        $searchArea = isset($_POST["search"]) ? $_POST["search"] : "";
                                        $specialties = isset($_POST["specialties"]) ? $_POST["specialties"] : "";
                                   // Assuming $database is a mysqli object

// Use double quotes to interpolate the $specialties variable
$sql = "SELECT id FROM specialties WHERE sname = '$specialties'";

// Execute the query
$result = $database->query($sql);

// Fetch the result as an associative array
$specialties_row = $result->fetch_assoc();

// Check if a result was found
if ($specialties_row) {
    // Access the id from the result
    $specialties_id = $specialties_row['id'];

    // Output or use the $specialties_id as needed
    // echo $specialties_id;
} else {
    // Handle the case where no result was found
    echo "Specialty not found";
}

$result = $database->query(
    "SELECT * FROM doctor WHERE docarea = '$searchArea' AND specialties = '$specialties_id'"
);
?>




<table style="width:100%">
<tr>

<?php
$colCount = 0;
while ($row = $result->fetch_assoc()) {
    // Display or process the retrieved data
    $result3 = $database->query(
        "SELECT * FROM specialties WHERE id = '" . $row["specialties"] . "'"
    );
    $row3 = $result3->fetch_assoc(); // Fetch only one row
    ?>
    <td style="">
        <div class="" style="border:1px solid #dee2e6;">
            <div class="card-body" style="padding:20px">
                <span><i class="fa-solid fa-user-doctor"></i>  
                
                <?php echo $row["docname"]. ' ' . (($row['is_active'] == 1) ? '<img src="../img/verified.png" style="margin-left: 5px;" title="verified">' : ""); ?></span> <br>

                <span><i class="fa-regular fa-envelope"></i>  <?php echo $row["docemail"]; ?></span><br>

                <span><i class="fa-solid fa-phone"></i>  <?php echo $row["doctel"]; ?></span><br>
                <?php
                 if ($row3) {
                    echo '<span><i class="fa-regular fa-star"></i> ' . $row3["sname"] . '</span><br>';
                 }
                ?>
                <span><i class="fa-solid fa-location-dot"></i> <?php echo $row["docarea"]; ?></span><br>
                <span><i class="fa-solid fa-house"></i> <?php echo $row["docclinic"]; ?></span><br>
                <span><i class="fa-solid fa-shield-halved"></i>  <?php echo $row["docactivity"]; ?></span><br>

                
                <span>
                    <div style="display:flex;justify-content: center;">
<div>
    <a href="?action=session&id=<?php echo $row["docid"]; ?>&name=<?php echo $row["docname"]; ?>" class="non-style-link">
        <button class="btn-primary-soft btn button-icon menu-icon-session-active" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
            <font class="tn-in-text">Sessions</font>
        </button>
    </a>
</div>
                </span>
                
                
            </div>
        </div>



    </td>


    <?php
    $colCount++;
    if ($colCount % 3 == 0) {
        // If the column count is a multiple of 4, close the current row and start a new one
        echo '</tr><tr>';
    }
}
}
if($_GET){
$action=$_GET["action"];
if($action=='session'){
$name=$_GET["name"];
echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Redirect to Doctors sessions?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            You want to view All sessions by <br>('.substr($name,0,40).').
                            
                        </div>
                        <form action="schedule.php" method="post" style="display: flex">

                                <input type="hidden" name="search" value="'.$name.'">

                                
                        <div style="display: flex;justify-content:center;margin-left:45%;margin-top:6%;;margin-bottom:6%;">
                        
                        <input type="submit"  value="Yes" class="btn-primary btn"   >
                        
                        
                        </div>
                    </center>
            </div>
            </div>
            ';}}
?>
</tr>
</table>
<?php
?>



                               
                        </center>
                </td>
                <td>
                </td>
            </tr>
        </table>
        </td>
        <tr>
            </table>
    </div>

</body>

</html>