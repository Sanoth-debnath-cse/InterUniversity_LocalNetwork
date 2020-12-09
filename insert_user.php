<?php
include ("includes/connection.php");
if(isset($_POST['sign_up']))
{
    $name =mysqli_real_escape_string($con,$_POST['u_name']);
    $pass =mysqli_real_escape_string($con,$_POST['u_pass']);
    $email =mysqli_real_escape_string($con,$_POST['u_email']);
    $country =mysqli_real_escape_string($con,$_POST['u_country']);
    $gender =mysqli_real_escape_string($con,$_POST['u_gender']);
    $birthday =mysqli_real_escape_string($con,$_POST['u_birthday']);
    $status ="verified";
    $posts ="no";
    $ver_code =mt_rand();
    if(strlen($pass)<8){
        echo "<script>alert('Password should be minimum 8 characters!')</script>";
        exit();
    }
    $check_email="select * from users where user_email='$email'";
    $run_email =mysqli_query($con,$check_email);
    $check =mysqli_num_rows($run_email);
    if($check==1)
    {
        echo "<script>alert('Email already exist try another')</script>";
        echo "<script>window.open('index.php','_self')</script>";
        exit();
    }
    $insert="insert into users(user_name,describe_user,relationship,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_reg_date,status,ver_code,posts) 
values('$name','is my name.I am a student of PSTU.','.......','$pass','$email','$country','$gender','$birthday','default.png',NOW(),'$status','$ver_code','$posts')";

    $query =mysqli_query($con,$insert);
    if($query){
        echo "<script>alert('Congratulation $name, your account has been created successfully.')</script>";
    }
    else{
        "<script>alert('Registration failed,try again!')</script>";
    }
}
?>