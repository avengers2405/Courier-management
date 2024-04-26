<!-- admin logIn page and login logic -->

<?php

require_once "../dbconnection.php";
require_once "../session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $ademail = $_POST['uname'];
    $password = $_POST['pass'];
    $qry = "SELECT * FROM `adlogin` WHERE `email`='$ademail' AND `password`='$password'";
    $run = mysqli_query($dbcon, $qry);
    $row = mysqli_num_rows($run);
    if ($row < 1) {
        echo "no records";
        ?>
        <script>
            alert("Only admin can login..");
            window.open('adminlogin.php', '_self');
        </script><?php
    }
    else {
        echo "here";
        $data = mysqli_fetch_assoc($run);
        $id = $data['a_id'];
        $_SESSION['uid'] = $id;  //now we can use it until session destroy
        $_SESSION['emm'] = $email;
        $_SESSION['user_type'] = "reciever";
        header('location:../home/trackMenu.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('images/10.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <h1 align='center' style="margin: 15px; color:seagreen;font-weight: bold;font-family:'Times New Roman', Times, serif">STORMBREAKER COURIER SERVICE</h1>
    <hr />
    <P align='center' style="font-weight: bold;color:orange;font-family:'Times New Roman', Times, serif">The Fastest Courier Service Ever</P>
    <div>
        <h5><a href="./../index.php" style="float: right; margin-right:40px; color:blue; margin-top:0px">Counter Login</a></h5>
    </div>
    <div class="container" style="border-radius:5px;border:1px solid;border-color:lightblue;border-collapse:collapse;background-color:lightblue;margin-top: 60px; width:50%;max-width:500px">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h2 style="color: #273c75;"><center>Login (Delivery Service)<center></h2>
                <br>
                <!-- <?php echo $error; ?> -->
                <form action="" method="post">
                    <div class="form-group">
                        <table width='90%' style="border-radius:10px;overflow:hidden;border-collapse:collapse;margin-top:30px;margin-bottom:30px;margin-left:auto;margin-right:auto;">
                            <tr>
                                <td>Email Address</td>
                                <td><input type="email" name="uname" class="form-control" placeholder="Enter username/emailId" required /></td>
                            </tr>
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="pass" class="form-control" placeholder="Enter your password" required></td>
                            </tr>
                        </table>
                    <!-- </div> -->
                    <!-- <br><br> -->
                    <!-- <div class="form-group"> -->
                        <center>
                        <input type="submit" name="login" class="btn btn-primary" value="SignIn" />
                        <button onclick="window.location.href='../resetpswd.php'" class="btn btn-danger" style="cursor:pointer">Reset Password</button>
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
