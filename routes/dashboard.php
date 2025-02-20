
<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red;"> Not Voted</b>';
    }else{
        $status = '<b style="color:green;"> Voted</b>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Student Council Election System - Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

    <div id="mainSection">

        <center>
            <div id="headerSection">
                <h1>Online Student Council Election System</h1>
                <a id="logoutbtn" href="logout.php">Logout <i style="color:blue" class='bx bx-user-circle'></i></a>
                
            </div>
        </center>
        
        <div id="mainpanel">
            <div id="Profile">
                <center><img id="userImage" src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100" ></center><br><br>
                <b id="userDetail">Name:</b> <?php echo $userdata['name']?> <br> <br>
                <b id="userDetail">Mobile:</b> <?php echo $userdata['mobile']?> <br> <br>
                <b id="userDetail">Address:</b> <?php echo $userdata['address']?> <br> <br>
                <b id="userDetail">Status:</b> <?php echo $status ?> <br> <br>
            </div>
            <div id="Group">
                <?php
                    if($_SESSION['groupsdata']){
                        for($i=0; $i<count($groupsdata); $i++){
                            ?>
                            <div class="candidateProfile">
                                <h3><?php echo $i+1?></h3>
                                <img id="candidateImage" style="float: left" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height= "100" width="100" ><br><br>
                                <div class="groupDetails">
                                    <b>Group Name:</b> <?php echo $groupsdata[$i]['name']?> <br> <br>
                                    <b>Votes:</b> <?php echo $groupsdata[$i]['votes']?> <br> <br>
                                </div>

                                <form action="../api/vote.php" method="POST">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                    <?php
                                        if($_SESSION['userdata']['status']==0){
                                            ?>
                                            <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                            <?php
                                        }else{
                                            ?>
                                            <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                            <?php
                                        }
                                        ?>
                                </form>
                            </div>
                            <?php
                        }
                    }else{

                    }
                ?>
            </div>
        </div>
    </div>    
    
</body>
</html>