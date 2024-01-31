<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>BD Doctor Aid</title>

    <style>
        table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .doctor-img {
            -webkit-filter: drop-shadow(5px 5px 5px red);
            filter: drop-shadow(3px 3px 3px white);
            position: absolute;
            bottom: 80px;
            height: 400px;
        }

        .animate-charcter {
            text-transform: uppercase;
            background-image: linear-gradient(-225deg,
                    #231557 0%,
                    #44107a 29%,
                    #ff1361 67%,
                    #fff800 100%);
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;
            font-size: 190px;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }
    </style>

    <?php
    include("./connection.php");
    $doctorQuery = "SELECT COUNT(*) as doctorCount FROM doctor";
    $doctorResult = $database->query($doctorQuery);
    $doctorCount = $doctorResult->fetch_assoc()['doctorCount'];

    $patientQuery = "SELECT COUNT(*) as patientCount FROM patient";
    $patientResult = $database->query($patientQuery);
    $patientCount = $patientResult->fetch_assoc()['patientCount'];

    $specializes = "SELECT COUNT(*) as speCount FROM specialties";
    $specialResult = $database->query($specializes);
    $specializesCount = $specialResult->fetch_assoc()['speCount'];

    ?>

</head>

<body>

    <div class="full-height">
        <center>
            <table border="0">
                <tr>
                    <td width="80%">
                        <font class="edoc-logo animate-charcter1">BD Doctor Aid</font>
                    </td>
                    <td width="10%">
                        <a href="login.php" class="non-style-link">
                            <p class="nav-item">LOGIN</p>
                        </a>
                    </td>
                    <td width="10%">
                        <a href="signup.php" class="non-style-link">
                            <p class="nav-item" style="padding-right: 10px;">REGISTER</p>
                        </a>
                    </td>
                </tr>


                <tr>
                    <td colspan="3">
                        <p class="heading-text">Avoid Hassles & Delays</p>

                    </td>
                </tr>

                <tr>

                    <td colspan="3">
                        <center>
                            <a href="login.php">
                                <input type="button" value="Make Appointment go to website"
                                    class="login-btn btn-primary btn"
                                    style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            </a>
                        </center>
                    </td>

                </tr>


                <tr>
                    <td colspan="3">

                    </td>
                </tr>
            </table>
        </center>

        <center>
            <div class="container">
                
                <div class="row">
                    <!-- <div class="col-sm-2">
                        <img class="doctor-img"
                            src="https://cdn.pixabay.com/animation/2022/08/15/08/47/08-47-44-137_512.gif" alt="">

                    </div> -->
                    <!-- <img class="doctor-img" width="10% height" src="https://cdn.pixabay.com/animation/2022/08/15/08/47/08-47-44-137_512.gif" alt=""> -->


                    <!-- <div class="col-md-4 offset-1"> -->
                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <div class="card card-shadow" style="border:3px solid green">
                                    <div class="card-body">
                                        <i class="fa-solid fa-user-doctor"></i>
                                        <?php echo "Total Doctor " . $doctorCount . "+"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-shadow" style="border:3px solid green">
                                    <div class="card-body">
                                        <i class="fa-solid fa-bed"></i>
                                        <?php echo "Total Patient " . $patientCount . "+"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-shadow" style="border:3px solid green">
                                    <div class="card-body">
                                        <i class="fa-regular fa-star"></i>
                                        <?php echo "Total Specializes " . $specializesCount . "+"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>

        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>