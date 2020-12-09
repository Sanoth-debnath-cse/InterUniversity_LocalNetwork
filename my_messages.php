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
        <div id="content_timeline">
            <?php
            if (isset($_GET['sent'])){
                echo ",<h2 style='color: white'><center>Sent Messages</center></center></h2>";
                include ("sent.php");
            }
            ?>
            <?php
            if (isset($_GET['inbox'])){ ?>
            <h2 style="color: white"><center>Inbox</center></h2>
            <table align="center" width="700">
                <tr>
                    <th>Sender: </th>
                    <th>Subject: </th>
                    <th>Message: </th>
                    <th>Reply: </th>
                </tr>
                <?php
                $sel_msg="select * from messages where receiver='$user_id' ORDER by 1 DESC ";
                $run_msg=mysqli_query($con,$sel_msg);
                $count_msg=mysqli_num_rows($run_msg);
                while ($row_msg=mysqli_fetch_array($run_msg)){

                    $msg_id=$row_msg['msg_id'];
                    $msg_receiver =$row_msg['receiver'];
                    $msg_sender =$row_msg['sender'];
                    $msg_sub =$row_msg['msg_sub'];
                    $msg_topic=$row_msg['msg_topic'];
                    $msg_date=$row_msg['msg_date'];

                    $get_sender ="select * from users where user_id='$msg_sender'";
                    $run_sender =mysqli_query($con,$get_sender);

                    $row =mysqli_fetch_array($run_sender);

                    $sender_name =$row['user_name'];

                ?>
                <tr align="center">
                <td>
                    <a href="user_profile.php?u_id=<?php echo $msg_sender; ?>" target="_blank">
                    <?php
                        echo $sender_name;
                    ?>
                    </a>
                </td>
                    <td>
                    <a href="my_messages.php?inbox&msg_id=<?php echo $msg_id;?>">
                    <?php echo $msg_sub; ?>
                    </a>
                </td>
                <td>
                <?php echo $msg_topic;?>
                </td>
                <td>
                <a href="my_messages.php?inbox&msg_id=<?php echo $msg_id; ?>">Reply</a>
                </td>
                </tr>
                <?php } ?>

            </table>
                <?php
                if (isset($_GET['msg_id'])){
                    $get_id =$_GET['msg_id'];
                    $sel_message ="select * from messages where msg_id='$get_id'";
                    $run_message =mysqli_query($con,$sel_message);
                    $row_message =mysqli_fetch_array($run_message);

                    $msg_subject = $row_message['msg_sub'];
                    $msg_topic = $row_message['msg_topic'];
                    $reply_content =$row_message['reply'];

                    $update_unread= "update messages set status='read' where msg_id='$get_id'";
                    $run_unread =mysqli_query($con,$update_unread);

                    echo "<center><br><hr>
                    <h2>$msg_subject</h2>
                    <p><b>Message : </b>$msg_topic</p>
                    <p><b>My Reply : </b>$reply_content</p>
                    
                    <form action='' method='post'>
                    <textarea cols='30' rows='5' name='reply'></textarea><br>
                    <input type='submit' name='msg_reply' value='Reply'>
                    </form>
                    </center>
                    ";
                }
                if (isset($_POST['msg_reply'])){
                    $user_reply =$_POST['reply'];
                    if ($reply_content!='no_reply'){
                        echo "<script>alert('Message was already replied')</script>";
                        exit();

                    }else{
                        $update_msg =" update messages set reply='$user_reply'where msg_id='$get_id' and reply='no_reply'";

                        $run_update=mysqli_query($con,$update_msg);
                        echo "<script>alert('Message was already replied')</script>";
                    }

                }
                }

            ?>
        </div>
    </div>

</body>

<?php
}
?>