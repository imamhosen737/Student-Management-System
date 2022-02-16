<?php
require_once("dbcon.php");
session_start();
if(isset($_POST['registation'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $photo = explode('.', $_FILES['photo']['name']);
    $photo_extention = end($photo);
    $photo_name = $username. '.' .$photo_extention;
    move_uploaded_file($_FILES['photo']['tmp_name'],'./users_images/'.$photo_name);
    $status = $_POST['status'];


    // echo "<pre>";
    // print_r($_POST);
    // print_r($_FILES);
    $input_error= array();

    if(empty( $name)){
        $input_error['name'] = "The name field is required";  
    }
    if(empty($email)){
        $input_error['email'] = "The email field is required";  
    }
    if(empty($username)){
        $input_error['username'] = "The username field is required";  
    }
    if(empty($password)){
        $input_error['password'] = "The password field is required";  
    }
    if(empty($c_password)){
        $input_error['c_password'] = "The confirm password field is required";  
    }
    if(empty($photo)){
        $input_error['photo'] = "The photo field is required";  
    }
    // echo "<pre>";
    // print_r($input_error);


   if(count($input_error)==0){
      $email_chek = $con->query("SELECT * FROM `users` WHERE email = '$email'");
     if(mysqli_num_rows($email_chek)==0){
       
     }else{
         $email_error = "The email already exists";
     }
     $username_chek = $con->query("SELECT * FROM `users` WHERE username = '$username'");
     if(mysqli_num_rows($username_chek)==0){
        //  echo "Authantic Email Address";
         if(strlen($username)>7){

         }else{
            $username_l = "Username should be more than 7 character";
         }
         
         if(strlen($password)>7){
             if($password == $c_password){
                 //password md5
                 $password = ($password);

             }else{
                 $password_auth = "Confirm password dosen't match";
             }
                
        }else{
            $password_l = "Password should be more than 7 character";
        }

     }else{
         $username_error = "The username already exists";
     }  
   }

   $insert = $con->query("INSERT INTO `users` ( `name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name', '$email', '$username', '$password', '$photo_name', ' $status')");

   if($insert){
       $_SESSION["data_insert_success"] = "Registation has been successfully done!";
    //    move_uploaded_file($_FILES['photo']['tmp_name'],'./images/'.'photo_name'); ?>
       
       <script>
           window.location.assign('registation.php')
       </script>
       <?php
    //    header("Location:registation.php");
   }else{
       $_SESSION["data_insert_error"] = "Registation unsucessfull!";
   }

 } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User rgistation form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all";>
</head>
<body>



    <div class="container">
        <h1 class="text-center" id="u">User Registation Form</h1>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <tr>
                    <th>Name:</th>
                    <td>
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control" value="<?php if(isset($name)){ echo $name; } ?>"> 
                   <label for="error" class=error> <?php if(isset($input_error['name'])){ echo $input_error['name']; } ?></label>
                    </td>
                    <th>Email:</th>
                    <td>
                    <input type="email" name="email" id="email" placeholder="Enter Your Email" class="form-control" value="<?php if(isset($email)){ echo $email; } ?>"> 
                    <label for="error" class=error> <?php if(isset($input_error['email'])){ echo $input_error['email']; } ?></label>
                    <label for="error" class=error> <?php if(isset($email_error)){ echo $email_error; } ?></label>
                    </td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td>
                    <input type="text" name="username" id="username" placeholder="Enter Your Username" class="form-control" value="<?php if(isset($username)){ echo $username; } ?>">
                    <label for="error" class=error> <?php if(isset($input_error['username'])){ echo $input_error['username']; } ?></label>
                    <label for="error" class=error> <?php if(isset($username_error)){ echo $username_error; } ?></label>
                    <label for="error" class=error> <?php if(isset($username_l)){ echo $username_l; } ?></label>
                    </td>

                    <th>Password:</th>
                    <td>
                    <input type="password" name="password" id="password" placeholder="Enter Your Password" class="form-control" value="<?php if(isset($password)){ echo $password; } ?>">
                    <label for="error" class=error> <?php if(isset($input_error['password'])){ echo $input_error['password']; } ?></label>
                    <label for="error" class=error> <?php if(isset($password_l)){ echo $password_l; } ?></label>
                    </td>

                </tr>
                <tr>
                    <th>Confirm Password:</th>
                    <td>
                    <input type="password" name="c_password" id="c_password" placeholder="Confirm Your Password" class="form-control" value="<?php if(isset($c_password)){ echo $c_password; } ?>"> 
                    <label for="error" class=error> <?php if(isset($input_error['c_password'])){ echo $input_error['c_password']; } ?></label> 
                    <label for="error" class=error> <?php if(isset($password_auth)){ echo $password_auth; } ?></label>
                    </td>
                    <th>Photo</th>
                    <td>
                    <input type="file" name="photo" id="photo">
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                    <input type="radio" name="status" value="active" checked><span>Active</span> |
                     <input type="radio" name="status" value="inactive"><span>Inactive</span>
                    </td>
                    <td colspan="4">
                    <input type="submit" name="registation" id="registation" value="Registation" class="btn btn-success btn-block">  
                    </td>
                </tr>
            </table>
        </form>

        <p>If you have an account? then please <a href="login.php">Login</a> </p>
        <hr>
        
    </div>
    <div class="container">
    <footer>
            <p>Copyright @copy 2020-2022 <?php date('Y'); ?> All Rights Reseved</p>
        </footer>
    </div>
</body>
</html>