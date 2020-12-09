<!DOCTYPE html>
<?php
session_start();
include("includes/connection.php");
include("functions/function.php");
?>
<?php
if(!isset($_SESSION['user_email'])){
    header("location: index.php");
}
else {
?>
<?php

    if(isset($_GET['sender']) && isset($_GET['receiver'])) {
        $sender = $_GET['sender'];
        $receiver = $_GET['receiver'];
        $value = checkRequest($sender, $receiver);
        if ($value == 1) {
            echo "<script>alert('Already Friend')</script>";
            echo "<script>window.open('members.php','_self')</script>";

        }
       else if ($value == 2) {
            echo "<script>alert('Already Sent Friend Request!')</script>";
            echo "<script>window.open('members.php','_self')</script>";
        } else {
            $user_request = "insert into request (sender_id,receiver_id, `count`) values('$sender','$receiver','no')";
            $run_posts = mysqli_query($con, $user_request);
            if ($run_posts) {
                echo "<script>alert(' Friend Request Sent!')</script>";
                echo "<script>window.open('members.php','_self')</script>";
            }

        }
    }
?>

<html>
<head>
    <title>Welcome Users!</title>

        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/home_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>

</head>
<body>
<div class="container">
    <div id="head_wrap">
        <div id="header">
            <ul id="menu">
                <li><a class="fa fa-user" href="profile.php">&nbsp;Profile</a></li>
                <li><a class="fa fa-home" href="home.php">&nbsp;Home</a></li>
                <li><a class="fa fa-group" href="members.php">&nbsp;Find People</a></li>
                <li><a class="fa fa-envelope" href="my_messages.php?inbox">&nbsp;Inbox</a></li>
                <li><a class="fa fa-paper-plane" href="my_messages.php?sent">&nbsp;Sent Messages</a></li>
                <li><a class="fa fa-envelope" href="request.php">&nbsp;See Requests</a></li>
            </ul>
            <form method="post" action="results.php" id="form1">
                <input type="text" name="user_query" placeholder="Search">
                <input type="submit" name="search" value="Search">
            </form>
        </div>
    </div>
    <div class="content">
        <div id="user_timeline">
            <div id="user_details">
                <?php
                $user = $_SESSION['user_email'];
                $get_user = "select * from  users where user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $describe_user = $row['describe_user'];
                $user_image = $row['user_image'];

                $user_posts = "select * from posts where user_id ='$user_id'";
                $run_posts =mysqli_query($con,$user_posts);
                $posts =mysqli_num_rows($run_posts);

                $sel_msg = "select * from messages where receiver ='$user_id' AND status='unread' ORDER by 1 DESC";
                $run_msg = mysqli_query($con,$sel_msg);
                $count_msg =mysqli_num_rows($run_msg);
                echo "
                    <center>
                    <img src='users/$user_image' width='200px' height='200px'/>
                    </center> 
                    <div id ='user_mention'>
                    <p><center><h2>$user_name</h2></center>
                    <center><strong>$describe_user</strong></center></p>
                    <p class='fa fa-group'><a href ='my_messages.php?inbox&u_id=$user_id'>&nbsp;Messages($count_msg)</a></p>
                    <p class='fa fa-user-o'><a href='my_post.php?u_id=$user_id'>&nbsp;My Posts ($posts)</a> </p>
                    <p class='fa fa-paint-brush'><a href ='edit_profile.php?u_id=$user_id'>&nbsp;Edit My Account</a></p>
                    <p class='fa fa-mouse-pointer'><a href='logout.php'>&nbsp;Logout</a> </p>
                    </div>
                    ";

                ?>
            </div>
        </div>
        <div id ="content_timeline">
           <center><h2>Find New People</h2></center><br><br>
            <?php find_people() ?>
        </div>

    </div>
</div>

</body>

<?php
}
?>