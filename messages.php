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
<html>
<head>
    <title>Welcome Users!</title>
    <link rel="stylesheet" type="text/css" href="styles/home_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <div id="head_wrap">
        <div id="header">
            <ul id="menu">
                <li><a class="fa fa-user" href="profile.php">&nbspProfile</a></li>
                <li><a class="fa fa-home" href="home.php">&nbspHome</a></li>
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
                    <p class='fa fa-group'>&nbsp;<a href ='my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
                    <p class='fa fa-user-o'>&nbsp;<a href='my_post.php?u_id=$user_id'>My Posts ($posts)</a> </p>
                    <p class='fa fa-paint-brush'>&nbsp;<a href ='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
                    <p class='fa fa-mouse-pointer'>&nbsp;<a href='logout.php'>Logout</a> </p>
                    </div>
                    ";

                ?>
            </div>
        </div>
        <div id ="content_timeline">
            <?php
            if (isset($_GET['u_id'])){
                $u_id =$_GET['u_id'];

                $sel ="select * from users where user_id='$u_id'";
                $run =mysqli_query($con,$sel);
                $row =mysqli_fetch_array($run);
                $user_name =$row['user_name'];
                $user_image=$row['user_image'];
                $reg_date =$row['user_reg_date'];
            }
            ?>
            <h2 style="text-align: center">Send A Message to <span style="color: midnightblue;"><?php echo $user_name;?> </span> </h2>
            <form action="messages.php?u_id=<?php echo $u_id;?>" method="post" id="f">
                <br>
                <div style="background-color: lightsteelblue;padding: 20px;">
                    <center>
                        <h2>Subject</h2><br>
                        <input type="text" name="msg_title" placeholder="Hints about your topic..." size="49"/>
                    </center>
                    <br><hr>
                </div>
                <div style="background-color: lightslategrey;padding: 20px;">
                    <center>
                        <h2>Message</h2><br>
                        <textarea name="msg" cols="50" rows="5" placeholder="Leave Your Message Here..."></textarea><br>
                        <input type="submit" name="message" value="Send Message">
                    </center>
                </div>
            </form><br>
            <div style="background-color: darkslategray;padding: 20px;">
                <center>
                    <h2 style="color: black">Information About  <?php echo  $user_name;?></h2><br>
                    <img style="border: 1px solid blue; border-radius: 5px;" src="users/<?php echo $user_image;?>" width="100" height="100">
                    <p><strong><?php echo $user_name; ?></strong> is member of this site since : <?php echo $reg_date; ?></p>
                </center>
            </div>

        </div>
        <?php
        if (isset($_POST['message'])){
            $msg_title =$_POST['msg_title'];
            $msg = $_POST['msg'];

            $insert ="insert into messages(sender,receiver,msg_sub,msg_topic,reply,status,msg_date
                    ) values ('$user_id','$u_id','$msg_title','$msg','no_reply','unread',NOW())";
            $run_insert = mysqli_query($con,$insert);

            if ($run_insert){
                echo "<script>alert('Message was sent to ".$user_name."Successfully')</script>";

            }
            else{
                echo "<script>alert('Message was not sent...!')</script>";
            }
        }
        ?>

    </div>
</div>

</body>

<?php
}
?>