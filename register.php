<?php 
$con=mysqli_connect("localhost","root","","data");
if(isset($_POST['register'])){
    $sname=$_POST['sname'];
    $username=$_POST['username'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $dou=$_POST['dou'];
    $password=$_POST['password'];
    $c_pass=$_POST['c_pass'];
    $input_error=array();
    if(empty($sname)){
        $input_error['sname']="wrong";
    }
    if(empty($username)){
        $input_error['username']="wrong";
    }
    if(empty($number)){
        $input_error['number']="wrong";
    }
    if(empty($email)){
        $input_error['email']="wrong";
    }
    if(empty($dou)){
        $input_error['dou']="wrong";
    }
    if(empty($password)){
        $input_error['password']="wrong";
    }
    if(empty($c_pass)){
        $input_error['c_pass']="wrong";
    }
    if(count($input_error)==0){
        $user_unique=mysqli_query($con, "SELECT * FROM `form` WHERE `username`='$username'");
        if(mysqli_num_rows($user_unique)== 0){
         $email_unique=mysqli_query($con,"SELECT * FROM `form` WHERE `email`='$email'");
         if(mysqli_num_rows($email_unique)==0){
         if($password==$c_pass){
          $password_32bit=md5($password);
          $query=mysqli_query($con,"INSERT INTO `form`( `sname`, `username`, `number`, `email`, `dou`, `password`) VALUES ('$sname','$username','$number','$email','$dou','$password_32bit')");
          if($query){
            echo"
            <script>
            alert('Wellcome Sir Your information is Successfully Registed');
            window.location.href='data_table.php';
            </script>";
          }else{
            echo"
            <script>
            alert('sorry Some Error Please Try Again!');
            window.location.href='register.php';
            </script>";
          }
         }else{
            $input_error['match']="<script>
            alert('Sorry Your confirm Password is not Match!');
            window.location.href='register.php';
            </script>";
         }
         }else{
            $input_error['email_unique']="<script>
            alert('The Email Adderass Alraday Exist!');
            window.location.href='register.php';
            </script>";
         }
        }else{
            $input_error['user']="<script>
            alert('The Username Alraday Exist!');
            window.location.href='register.php';
            </script>";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <div class="container">
        <div class="logo">Register</div>
        <form action="#"  method="POST" >
            <div class="inbox">
                <input type="text" name="sname"  placeholder="Full Name" class="form_info <?php if(isset($input_error['sname'])){echo $input_error['sname'];}  ?> " >
            </div>
            <div class="inbox">
                <input type="text" name="username"  placeholder=" Username" class="form_info <?php if(isset($input_error['username'])){echo $input_error['username'];} ?> " >
                <span><?php if(isset($inout_error['user'])){echo $inout_error['user'];} ?></span>
            </div>
            <div class="inbox">
                <input type="number" name="number" pattern="+001"  placeholder="Phon Number" class="form_info <?php if(isset($input_error['number'])){echo $input_error['number'];} ?> " >
            </div>
            <div class="inbox">
                <input type="email" name="email"  placeholder="Email Adderass" class="form_info <?php if(isset($input_error['email'])){echo $input_error['email'];} ?> " >
                <span><?php if(isset($inout_error['email_unique'])){echo $inout_error['email_unique'];} ?></span>
            </div>
            <div class="inbox">
                <input type="date" name="dou" class="form_info <?php  if(isset($input_error['dou'])){echo $input_error['dou'];} ?> " >
            </div>
            <div class="inbox">
                <input type="password" name="password"  placeholder="Creat Password" class="form_info <?php if(isset($input_error['password'])){echo $input_error['password'];} ?> " >
            </div>
            <div class="inbox">
                <input type="password" name="c_pass"  placeholder="Confirm your password" class="form_info <?php if(isset($input_error['c_pass'])){echo $input_error['c_pass'];} ?> " >
                <span><?php if(isset($inout_error['match'])){echo $inout_error['match'];} ?></span>
            </div>
            <div class="form_btn">
                <input type="submit" name="register" class="re_btn" value="Register"  >
            </div>
            <div class="form_link">
                Have a Account? <a class="log_link" href="login.php">Login</a>
            </div>
        </form>
    </div>
    
</body>
</html>
