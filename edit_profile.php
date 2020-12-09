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
                $Relationship_status =$row['Relationship'];
                $user_pass =$row['user_pass'];
                $user_email =$row['user_email'];
                $user_country =$row['user_country'];
                $user_gender =$row['user_gender'];
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
                    <p class='fa fa-group' ><a href ='my_messages.php?inbox&u_id=$user_id'>&nbsp;Messages($count_msg)</a></p>
                    <p class='fa fa-user-o' ><a href='my_post.php?u_id=$user_id'>&nbsp;My Posts ($posts)</a> </p>
                    <p  class='fa fa-paint-brush'><a href ='edit_profile.php?u_id=$user_id'>&nbsp;Edit My Account</a></p>
                    <p class='fa fa-mouse-pointer' ><a href='logout.php'>&nbsp;Logout</a> </p>
                    </div>
                    ";

                ?>
            </div>
        </div>
        <div id ="content_timeline">
           <form method="post" id="f" class="ff" enctype="multipart/form-data">
               <table>
                   <tr align="center">
                       <td colspan="6"><h2>Edit Your Profile</h2></td>
                   </tr>
                   <tr>
                       <td align="right">Name:</td>
                       <td>
                           <input type="text" name="u_name" required="required" value="<?php echo $user_name;?>"/>
                       </td>
                   </tr>
                   <tr>
                       <td align="right">Description:</td>
                       <td>
                           <input type="text" name="describe_user" required="required" value="<?php echo $describe_user;?>"/>
                       </td>
                   </tr>
                   <tr>
                       <td align="right">Relationship Status:</td>
                       <td>
                           <select name="Relationship">
                               <option><?php echo $Relationship_status; ?></option>
                               <option>Single</option>
                               <option>In a Relationship</option>
                               <option>Engaged</option>
                               <option>Married</option>
                               <option>Complicated</option>
                           </select>
                       </td>
                   </tr>
                   <tr>
                       <td align="right">
                           Password:
                       </td>
                       <td>
                           <input type="password" name="u_pass" id="mypass" required="required"
                           value="<?php echo $user_pass; ?>">
                           <input type="checkbox" onclick="show_password()">Show Password
                       </td>
                   </tr>

                   <tr>
                       <td align="right">
                           Email:
                       </td>
                       <td>
                           <input type="Email" name="u_email" required="required"
                                  value="<?php echo $user_email; ?>">
                       </td>
                   </tr>

                   <tr>
                       <td align="right">
                           Country:
                       </td>
                       <td>
                           <select name="u_country" required="required">
                               <option><?php echo $user_country; ?></option>
                               <option>Bangladesh</option>
                               <option>India</option>
                               <option>Pakistan</option>
                               <option>Chin</option>
                               <option>Nepal</option>
                               <option>USA</option>
                           </select>
                       </td>
                   </tr>

                   <tr>
                       <td align="right">
                           Gender:
                       </td>
                       <td>
                           <select name="u_gender" disabled="disabled">
                               <option><?php echo $user_gender; ?></option>
                               <option>Male</option>
                               <option>Female</option>
                           </select>
                       </td>
                   </tr>
                   <tr align="center">
                       <td colspan="6">
                           <input style="width: 100px"  type="submit" name="update" value="Update">
                       </td><br>
                   </tr>


               </table>
           </form>
            <?php if(isset($_POST['update'])){
                $u_name=$_POST['u_name'];
                $describe_user=$_POST['describe_user'];
                $Relationship_status=$_POST['Relationship'];
                $u_pass=$_POST['u_pass'];
                $u_email=$_POST['u_email'];

                $update = "update users set user_name='$u_name',describe_user='$describe_user',Relationship='$Relationship_status',
                 user_pass='$u_pass',user_email='$u_email' where user_id='$user_id'";

                $run =mysqli_query($con,$update);
                if ($run){
                    echo "<script>alert('Your Profile Update')</script>";
                    echo "<script>window.open('home.php','_self')</script>";
                }
            }
            ?>
        </div>

    </div>
</div>

</body>
</html>
<?php
}
?>
<script>
    function show_password() {
        var x = document.getElementById("mypass");
        if (x.type=="password"){
            x.type ="text";
        }
        else {
            x.type ="password";
        }
    }
</script>
