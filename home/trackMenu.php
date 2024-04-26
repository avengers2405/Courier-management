<!-- when track menu is clicked it will show all courier placed by that User-->
<?php
session_start();
if(isset($_SESSION['uid'])){
    echo "";
    }else{
    header('location: ../login.php');
    }
?>
<?php include('header.php'); ?>
<link rel="stylesheet" href="./../css/style.css" type="text/css">
<!-- 
<style>
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: DodgerBlue;
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}

.defaultopt {
    background-color: dodgerblue;
    border: 1px solid transparent;
    border-color: #fff transparent transparent transparent;
}

</style> -->

<form action="trackMenu.php" method="POST" enctype="multipart/form-data">
<table width='70%' style="border-radius:10px;overflow:hidden;border-collapse:collapse;margin-top:30px;margin-bottom:30px;margin-left:auto;margin-right:auto;">
    <tr style="border:1px solid;background-color:#0074D9;color:white;border:none;text-align:center;">
        <td colspan="2" style="padding:10px;font-size:20px;"> Enter Tracking Details </td>
    </tr>
    <tr>
        <!-- <td>
            <div class="dropdown">
            <button class="dropbtn">Sender:</button>
            <div class="dropdown-content">
                <input type="button" value="Reciever">
                <input type="button" value="Sender">
            </div>
            </div>
        </td> -->
        <td style="padding-left:30px;padding-right:30px;">
            Sender:
        </td>
        <td style ="padding-left:30px;padding-right:30px;padding-top:10px;padding-bottom:10px;">
            <input type="text" name="smail" placeholder="Sender Email Address"></td>
        </td>
    </tr>
    <tr>
        <td style="padding-left:30px;padding-right:30px;">
            Reciever:
        </td>
        <td style ="padding-left:30px;padding-right:30px;padding-top:10px;padding-bottom:10px;">
            <input type="text" name="rmail" placeholder="Reciever Email Address"></td>
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="padding-left:30px;padding-right:50%">
            <input type="submit" name="submit" value="Track">
        </td>
    </tr>
</table>
</form>

<?php
if (isset($_POST['submit'])) {
    // echo "here BOSS";
    include('../dbconnection.php');
    $smail = htmlspecialchars(strip_tags(trim($_POST["smail"])));
    $rmail = htmlspecialchars(strip_tags(trim($_POST["rmail"])));
    
    if ($smail == $rmail) {
        echo "<br><center><h3>Please Enter Valid Tracking Details.</h3></center>";
    } else {
        if ($smail=='') {
            $qry = "SELECT * FROM `courier` WHERE `remail`='$rmail'";
        } else if ($rmail=='') {
            $qry = "SELECT * FROM `courier` WHERE `semail`='$smail'";
        } else {
            $qry = "SELECT * FROM `courier` WHERE `semail`='$smail' AND `remail`='$rmail'";
        }
        // echo $smail.'<br>';
        // echo $rmail.'<br>';
        // echo "complete echoing";
        $run = mysqli_query($dbcon, $qry);
        
        if(mysqli_num_rows($run)<1){
            echo "<tr><td colspan='6'>No record found..</td></tr>";
        } else {
            ?>
            <div style="overflow-x:auto;">
                <table width='80%' style="border:1px solid black;border-color:#000000;border-radius:5px;overflow:hidden;margin-bottom:60px;margin-top:30px;margin-left:auto ;margin-right:auto ;font-weight:bold;border-collapse:collapse;">
                    <tr style="background-color: green;font-size:30px; text-align:center;">
                        <th>No.</th>
                        <th>Item's Image</th>
                        <th>Sender Name</th>
                        <th>Receiver Name</th>
                        <th>Receiver Email</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    $count=0;
                    while($data=mysqli_fetch_assoc($run))
                    {
                        $count++;
                    ?>
                    <tr align="center">
                        <td><?php echo $count; ?></td>
                        <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" style="max-width: 100px;"/> </td>
                        <td><?php echo $data['sname']; ?></td>
                        <td><?php echo $data['rname']; ?></td>
                        <td><?php echo $data['remail']; ?></td>
                        <td>
                            <?php if ($_SESSION["user_type"]=="reciever") {
                                ?>
                                <a href="deletecourier.php?bb=<?php echo $data['billno']; ?>">Recieved</a>
                                <?php
                            } else {
                                ?>
                                <a href="updationtable.php?sid=<?php echo $data['c_id']; ?>">Edit</a>
                                <!-- || <a href="status.php?sidd=<?php //echo $data['c_id']; ?>">CheckStatus</a> -->
                                <?php
                            } ?>
                        </td>
                    </tr>
                    <?php 
                    } 
                    ?>
                </table>
            </div><?php
        }
    }
}
?>