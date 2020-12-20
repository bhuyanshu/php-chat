<!DOCTYPE html>
<?php 
session_start();
include("include/connection.php");

if(!isset($_SESSION['user_email'])){
    header("location: sigin.php");
}
else{
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT application -Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <!-- <h2>Welcome Home </h2> -->
    <div class = "container main-section">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left sidebar">
                <div class="input-group searchbox">
                    <div class="input-group-btn">
                        <!-- <center><a href="include/find_freinds.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add New User</a></button></center> -->
                    </div>
                </div>
                <div class="left-chat">
                    <ul>
                        <?php
                            include("include/get_users_data.php");
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                <div class="row">
                    <!--  getting the user information who is logged in  -->
                    <?php
                        $user =$_SESSION['user_email'];
                        $get_user = "select * from users where user_email='$user'";
                        $run_user =mysqli_query($con,$get_user);
                        $row = mysqli_fetch_array($run_user);
                        //  (mysqli_num_rows($row) == 1) 
                            $user_id =$row['user_id'];
                            $user_name = $row['user_name'];
                            echo "User_name :'$user_name'";
                          
                    ?>
                     <!--  getting the user information which user click --->
                    <?php
                        if(isset($_GET['user_name'])){
                            global $con;
                            $get_username = $_GET['user_name'];
                            $get_user ="select * from users where user_name='$get_username'";

                            $run_user = mysqli_query($con,$get_user);
                            $row_user = mysqli_fetch_array($run_user);

                            $username = $row_user['user_name'];
                            echo "sender_username:'$username'";
                            $user_profile_image = $row_user['user_profile'];                       
                        }

                        $total_messages ="select * from users_chat where (sender_username = '$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                        $run_messages = mysqli_query($con,$total_messages);
                        $total = mysqli_num_rows($run_messages);
                    ?>
                    <div class = "col-md-12 right-header">
                        <div class="right-header-img">
                            <img src = <?php echo "$user_profile_image"?>>
                            <div class="right-header-detail">
                                <form method="post">
                                    <p><?php echo"$username" ?></p>
                                    <span><?php echo $total; ?>messages</span>&nbsp &nbsp
                                    <button name="logout" class="btn btn-danger">Logout</button>
                                </form>
                                <?php
                                    if(isset($_POST['logout'])){
                                        $update_msg =mysqli_query($con,"UPDATE users SET log_in='offline' where user_name = '$user_name'");
                                        header("Location:logout.php");
                                        exit();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id = "Scrolling_to_bottom" class="col-lg-12 right-header-contentChat" >
                            <?php
                                $update_msg = mysqli_query($con,"UPDATE users_chat SET msg_status = 'read' WHERE sender_username='$username' AND receiver_username='$user_name'");
                               
                                $sel_msg = "select * from users_chat where (sender_username ='$user_name' AND receiver_username = '$username') OR (receiver_username ='$user_name' AND sender_username = '$username')  ORDER by 1 ASC";
                                $run_msg = mysqli_query($con , $sel_msg);

                                while($row = mysqli_fetch_array($run_msg)){

                                    $sender_username = $row['sender_username'];
                                    $receiver_username = $row['receiver_username'];
                                    $msg_content = $row['msg_content'];
                                    $msg_date = $row['msg_date'];  
                                    
                            ?>
                            <ul>
                                    <?php 
                                        if($user_name == $sender_username AND $username == $receiver_username){
                                            echo"
                                                <li>
                                                    <div class = 'rightside-right-chat'>
                                                        <span>$username <small>$msg_date</small></span><br><br>
                                                        <p>$msg_content</p>
                                                </li>

                                            ";
                                        }

                                        else if($user_name == $receiver_username AND $username == $sender_username){
                                            echo"
                                                <li>
                                                    <div class = 'rightside-left-chat'>
                                                        <span>$username <small>$msg_date</small></span><br><br>
                                                        <p>$msg_content</p>
                                                </li>

                                            ";
                                        }

                                    ?>
                            </ul>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="col-md-12 right-chat-textbox">
                           <form method="post">
                                <input autocomplete="off" type="text" name="msg_content" placeholder="Write Your Message ..... ">
                                <button class="btn" name="submit" ><i class="fa fa-telegram" aria-hidden="true"></i></button>
                           </form>
                        </div>
                    </div>
                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
      if(isset($_POST['submit'])){
        
        $msg = ($_POST['msg_content']);

        if($msg == ""){
            echo"
                <div class='alert alert-danger'>
                    <strong><center>Message was unable to send </center></strong>
                </div>
            ";
        }
        else if (strlen($msg) > 100){
            echo"
                <div class='alert alert-danger'>
                    <strong><center>Message is too long. Use Only 100 Characters </center></strong>
                </div>
            ";
        }
        else{
            $insert ="insert into users_chat(sender_username,receiver_username,msg_content,msg_status,msg_date) values('$user_name','$username','$msg','unread',NOW())";
            $run_insert = mysqli_query($con,$insert);
        }
      }  
    ?>
    <script>
        $('#scrolling_to_bottom').animate({
            scrolltop:$('#scrolling_to_bottom').get(0).scrollHeight},1000);
    </script>
    <script>
    $(document).ready(function(){
        var height =$(window).height();
        $('.left-chat').css('height',(height-92)+'px');
        $('.right-header-contentChat').css('height',(height - 163)+ 'px');
    });
    </script>
</body>
</html>
<?php }?>