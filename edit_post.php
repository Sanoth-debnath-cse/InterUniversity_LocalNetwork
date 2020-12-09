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
</head>
<body>
<div class="container">
    <div id="head_wrap">
        <div id="header">
            <ul id="menu">
                <li><a href="profile.php">&nbsp;Profile</a></li>
                <li><a href="home.php">&nbsp;Home</a></li>
                <li><a href="members.php">&nbsp;Find People</a></li>
                <li><a href="my_messages.php?inbox">&nbsp;Inbox</a></li>
                <li><a href="my_messages.php?sent">&nbsp;Sent Messages</a></li>
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
                    <p><a href ='my_messages.php?inbox&u_id=$user_id'>Messages($count_msg)</a></p>
                    <p><a href='my_post.php?u_id=$user_id'>My Posts ($posts)</a> </p>
                    <p><a href ='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
                    <p><a href='logout.php'>Logout</a> </p>
                    </div>
                    ";

                ?>
            </div>
        </div>
        <div id ="content_timeline">
            <?php
            if (isset($_GET['post_id'])){

                $get_id =$_GET['post_id'];
                $get_post="select * from posts where post_id='$get_id'";
                $run_post =mysqli_query($con,$get_post);
                $row =mysqli_fetch_array($run_post);

                $post_con = $row['post_content'];

            }
            ?>
            <form action="" method="post" id="f">
                <center><h2>Edit Your Post</h2></center>
                <textarea cols="83" rows="3" name="content"><?php echo $post_con; ?></textarea>

                <input type="submit" name="update" value="Update Post">
            </form>
            <?php
            if (isset($_POST['update'])){
                $content = $_POST['content'];

                $update_post ="update posts set post_content='$content' where post_id='$get_id'";
                $run_update =mysqli_query($con,$update_post);

                if($run_update){

                    echo "<script>alert('Post has been Updated')</script>";
                    echo "<script>window.open('home.php','_self')</script>";

                }
            }
            ?>
        </div>

    </div>
</div>

</body>

<?php
}
?>