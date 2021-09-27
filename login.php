<?php
   include('dbConfig.php');

    $errors = ['email_or_phone'=>'', 'password'=>''];
    $email_or_phone = '';
    $password = '';

    if(isset($_POST['login'])){
        !empty($_POST['email_or_phone']) ? $email_or_phone = mysqli_real_escape_string($connection,$_POST['email_or_phone']): $errors['email_or_phone'] = 'Please provide email or phone number';
        !empty($_POST['password'])?$password = mysqli_real_escape_string($connection, $_POST['password']):$errors['password'] = 'Password is required';

        if(!$errors['email_or_phone'] && !$errors['password']){
            $query = "SELECT * FROM `user_information` WHERE email_or_phone = '$email_or_phone' and password = '$password' ";
            $result = mysqli_query($connection, $query);
            
            $user_information = mysqli_fetch_assoc($result);
            if(empty($user_information)){
                $errors['email_or_phone'] = 'Email, phone number or password is wrong';
            }else{
                setcookie('id', $user_information['id'], time()+ 60*60, "/");
                header("Location:profile.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body >
    <div class="container h-100">
        <div class="row align-items-center h-100 justify-content-center">
            <div class=" mr-md-5 phone-container col-auto col-sm-auto col-md-6 col-lg-4 d-none d-sm-none d-md-block ">
                <img class='white-phone' src="./images/instagram_white_phone1.png" alt="instagram_phone"  >
                <div class="  phone-content-container">
                    
                </div>

            </div>
            <div class="col-auto col-sm-auto col-md-6 col-lg-4 border p-4 h-75">
                <div class="mb-4 text-center">
                    <img src="./images/instagram_logo.png" alt="instagram_logo">
                </div>
                <form action='login.php' method="POST">
                    <div class="error col-12 mb-3"> 
                        <?php echo $errors['email_or_phone']?>
                    </div> 
                    <div class="col-12 mb-3"> 
                        <input type="text" name='email_or_phone' class="form-control" placeholder="Email or phone number" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="error col-12 mb-3"> 
                        <?php echo $errors['password']?>
                    </div> 
                    
                    <div class="mb-3">
                        <input type="password" name='password' placeholder="Password" class="form-control" id="password">
                    </div>
                    
                    <button type="submit" name='login' class="btn btn-primary w-100">Login</button>
                </form>
                <hr style="color:black;">
                <div class="text-center my-2">
                    
                    <a href="#">Login with Facebook</a>
                </div>
                <div class="text-center my-2">
                    <a href="#">Forgot password</a>
                </div>
                <div class=""></div>

                <div class="text-center my-2">
                    Don't have an account?
                    <a href="/SocialMediaPlatform/register.php"> Sign up</a>
                </div>
            </div>
           
        </div>
    </div>

    <?php include('footer.php') ?>
</body>
<script src="./js/changePhoneContent.js"></script>
</html>