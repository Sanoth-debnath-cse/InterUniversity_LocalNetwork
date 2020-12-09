<?php
$con = mysqli_connect("localhost","root","","social_network") or die("Connection is not established");

function insertPost(){
    if(isset($_POST['sub'])){
        global $con;
        global $user_id;
        global $run_update;
        $content =addslashes($_POST['content']);

        if($content==''){
            echo"<h2>Please Enter your Post</h2>";
            exit();
        }
        else{
            $insert ="insert into posts (user_id,post_content,post_date) value ('$user_id','$content',NOW())";
            $run = mysqli_query($con,$insert);
            if($run){
                echo"<script>alert('Your Post Have Been Updated Successfully.')</script>";
                $update ="update users set posts='yes' where user_id='$user_id'";
                $run_update = mysqli_query($con,$update);


            }
        }
    }
}
function get_posts(){
    global $con;
    $per_page=3;
    if(isset($_GET['page'])){
        $page =$_GET['page'];
    }
    else{
        $page =1;
    }
    $start_from = ($page-1) * $per_page;
    $get_posts ="select * from posts ORDER by 1 DESC LIMIT $start_from,$per_page";
    $run_posts = mysqli_query($con,$get_posts);
    while ($row_posts=mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id =$row_posts['user_id'];
        $content =substr($row_posts['post_content'],0,70);
        $post_date =$row_posts['post_date'];

        $user = "select * from users where user_id='$user_id' AND posts='yes'";
        $run_user = mysqli_query($con,$user);
        $row_user =mysqli_fetch_array($run_user);

        $user_name =$row_user['user_name'];
        $user_image =$row_user['user_image'];

        echo"<div id ='posts'>
        <p><img src='users/$user_image'width='100' height='100'></p>
        <h3><a href='user_profile.php?u_id=$user_id'>$user_name</a>&nbsp<small style='color: black;'>      
        Updated a post on $post_date</small></h3>
        <p style='color: white;'>$content</p>
        <a href='single.php?post_id=$post_id' style='float: right;'><button class='fa fa-comment'>&nbsp;comment</button></a>
        </div><br><br>    
        ";
    }
    include ("pagination.php");
}
function single_post(){
    if(isset($_GET['post_id'])){
        global $con;
        global $get_id;
        global $post_id;
        global $user_com_name;
        global $user_com_id;
        $get_id = $_GET['post_id'];
        $get_posts ="select * from posts where post_id='$get_id'";
        $run_posts =mysqli_query($con,$get_posts);

        $row_posts = mysqli_fetch_array($run_posts);
        $post_id =$row_posts['post_id'];
        $user_id =$row_posts['user_id'];
        $content = $row_posts['post_content'];
        $post_date =$row_posts['post_date'];

        $user ="select * from users where user_id='$user_id'AND posts='yes'";
        $run_user=mysqli_query($con,$user);
        $row_user =mysqli_fetch_array($run_user);
        $user_name =$row_user['user_name'];
        $user_image =$row_user['user_image'];

        $user_com =$_SESSION['user_email'];

        $get_com ="select * from users WHERE user_email='$user_com'";
        $run_com =mysqli_query($con,$get_com);
        $row_com =mysqli_fetch_array($run_com);
        $user_com_id =$row_com['user_id'];
        $user_com_name =$row_com['user_name'];
        echo "
        <div id='posts'>
        <p><img src='users/$user_image' width='80' height='80'> </p>
        <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a> </h3>
        <p>Posted On :$post_date</p>
        <p>$content</p>
        </div>
        ";
        include ("comments.php");
        echo "<br>
        <form method='post' id='reply'>
            <textarea cols='40' rows='5' name='comment' placeholder='Leave a Comment....'></textarea><br>
            <input type='submit' name='reply' value='Comment'>
        </form>
            ";
        if (isset($_POST['reply'])){
            $comment =$_POST['comment'];
            $insert =" insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";
            $run = mysqli_query($con,$insert);
            echo "<script>alert('Your Reply is Added')</script>";
            echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
        }

    }
}
    function find_people(){
    global $con;
    $user ="select * from users";
    $run_user =mysqli_query($con,$user);
    while ($row_user=mysqli_fetch_array($run_user)){
        $user_id =$row_user['user_id'];
        $user_name =$row_user['user_name'];
        $user_image = $row_user['user_image'];
        $user_email =$row_user['user_email'];
        if ($_SESSION['user_email']==$user_email){
        echo "
        <span>
        <a href='user_profile.php?u_id=$user_id'><hr>
        <strong><h2>$user_name</h2></strong>
        <img src='users/$user_image' width='150px' height='140px' title='$user_name' style='float: left; margin: 1px;'/>
        <br><br><br><br><br><br><br><br><br><br>
        </a>
        </span>
        ";}
        else{
            echo "
        <span>
        <a href='user_profile.php?u_id=$user_id'><hr>
        <strong><h2>$user_name</h2></strong>
        <img src='users/$user_image' width='150px' height='140px' title='$user_name' style='float: left; margin: 1px;'/>
        <br><br><br><br><br><br><br><br><br><br>
        </a>
        </span>
        <a href='members.php?sender=".$_SESSION['user_id']."&receiver=".$user_id."'><button style=\"width: 100px;height: 40px;padding-bottom: 5px; background: #228822; border-radius: 5px;border: 0.5px solid #7FFF00; color: white;\" id='btn1'name='send_request'>Send Friend Request</button> </a>
        ";}

        }
    }

    function user_posts(){
    global $con;
    if(isset($_GET['u_id'])){
        $u_id =$_GET['u_id'];
    }
    $get_posts ="select * from posts where user_id='$u_id' order by 1 DESC LIMIT 5";
    $run_posts =mysqli_query($con,$get_posts);

    while ($row_posts =mysqli_fetch_array($run_posts)){

        $post_id =$row_posts['post_id'];
        $user_id =$row_posts['user_id'];
        $content =$row_posts['post_content'];
        $post_date =$row_posts['post_date'];

        $user ="select * from users where user_id='$user_id' and posts='yes'";

        $run_user=mysqli_query($con,$user);
        $row_user =mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $user_image = $row_user['user_image'];

        echo"<div id='posts'>
            <p><img src='users/$user_image' width='85' height='85'> </p>
            <h3><a href ='user_profile.php?user_id=$user_id'>$user_name</a></h3>
            <p>$post_date</p>
            <p>$content</p>
            <a href='edit_post.php?post_id=$post_id' style='float: right;'><button class='fa'>&nbspEdit</button>
            <a href='functions/delete_post.php?post_id=$post_id' style='float: right;'><button class='fa'>&nbspDelete</button></a>
        </div><br>
        ";
        include ("delete_post.php");
    }
    }
    function user_profile(){
    if (isset($_GET['u_id'])){
        global $con;

        $user_id =$_GET['u_id'];
        $select = "select * from users where user_id='$user_id'";
        $run =mysqli_query($con,$select);
        $row = mysqli_fetch_array($run);

        $id = $row['user_id'];
        $name = $row['user_name'];
        $describe_user = $row['describe_user'];
        $country = $row['user_country'];
        $image = $row['user_image'];
        $register_date = $row['user_reg_date'];
        $gender = $row['user_gender'];
        if ($gender=='Male'){
            $msg='Send him a message';
        }
        else{
            $msg ='Send her a message';
        }
        echo "
            <div id='user_profile'>
            <img src='users/$image' width='150' height='150'/>
            <br/>
            <p><strong>Name : </strong>$name</p><br/>
            <p><strong>Gender : </strong>$gender</p><br/>
            <p><strong>Country : </strong>$country</p><br/>
            <p><strong>Status : </strong>$describe_user</p><br/>
            <p><strong>Member Since : </strong>$register_date</p><br/>
            <a href='messages.php?u_id=$id'><button>$msg</button></a><hr>
            
            </div>
        ";

    }
    }

    function checkRequest($sender_id,$receiver_id){
    global $con;
        $user ="select * from request where (sender_id='$sender_id' and receiver_id = '$receiver_id') or (sender_id='$receiver_id' and receiver_id = '$sender_id')";

        $run_user=mysqli_query($con,$user);

        if(mysqli_num_rows($run_user) > 0){
            $show = mysqli_fetch_assoc($run_user);
            if($show['count'] === 'yes'){
                return 1;
            }
            else if($show['count'] === 'no'){
                return 2;
            }
        }
        return 0;
    }
function request_list(){
    global $con;
    $current_id = $_SESSION['user_id'];
    $user ="select request.id,request.sender_id,request.receiver_id, request.count, users.user_id,users.user_name,users.user_image,users.user_email from request inner join users on request.sender_id = users.user_id where (request.receiver_id = '$current_id' and request.count = 'no'); ";
    $run_user =mysqli_query($con,$user);
    while ($row_user=mysqli_fetch_array($run_user)){
        $sender_id = $row_user['sender_id'];
        $count = $row_user['count'];
        $user_id =$row_user['user_id'];
        $user_name =$row_user['user_name'];
        $user_image = $row_user['user_image'];
        $user_email =$row_user['user_email'];

            echo "
        <span>
        <a href='user_profile.php?u_id=$user_id'><hr>
        <strong><h2>$user_name</h2></strong>
        <img src='users/$user_image' width='150px' height='140px' title='$user_name' style='float: left; margin: 1px;'/>
        <br><br><br><br><br><br><br><br><br><br>
        </a>
        </span>
        <a href='request.php?sender=".$sender_id."&receiver=".$current_id."' ><button >Accept</button></a>&nbsp;&nbsp;<a href='request.php?sender_rej=".$sender_id."&receiver_rej=".$current_id."' ><button >Reject</button></a>
        ";}



}
?>