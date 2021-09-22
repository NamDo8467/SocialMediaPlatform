<?php
    include('dbConfig.php');
    $errors = ['username'=>'','email'=>'', 'password'=>''];
    
    if(isset($_POST['submit'])){
        if (!empty($_POST['username'])) {
            $username =  mysqli_real_escape_string($connection, $_POST['username']);
        }else{
            $errors['username'] = 'Please enter a username';
        }
        
        if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            
        }else{
            $errors['email'] = 'Please enter a valid email';
            
        }
        if(!empty($_POST['password']) && strlen($_POST['password']) >= 8){
            $password =  mysqli_real_escape_string($connection, $_POST['password']);
            
        }
        else{
            $errors['password'] = 'Your password must be at least 8 characters';
            
        }
        if(!$errors['email'] && !$errors['password']){
            $query = "INSERT INTO user_information(email_or_phone, password, username, followers, following, posts) VALUES('$email', '$password', '$username', 0,0,0)";

            if(mysqli_query($connection, $query)){
                header('Location: login.php');
            }else{
                echo "Error happen: ".mysqli_error($connection);
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
    <title>Document</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body >
    <div class="container h-100">
        <div class="row align-items-center h-100 justify-content-center">
            <div class="col-auto col-sm-auto col-md-6 col-lg-4 d-none d-sm-none d-md-block">
                <img  src="./images/instagram_phone.png" alt="instagram_phone">
            </div>
            <div class="col-auto col-sm-auto col-md-6 col-lg-4 border p-4 h-75">
                <div class="mb-4 text-center">
                    <img src="./images/instagram_logo.png" alt="instagram_logo">
                </div>
                <form action='register.php' method="POST">
                <div class="error col-12 mb-3"> 
                        <?php echo $errors['username']?>
                    </div> 
                    <div class="col-12 mb-3"> 
                        <input type="text" name='username' class="form-control" placeholder="Username" id="email" aria-describedby="emailHelp">
                    </div> 
                    <div class="error col-12 mb-3"> 
                        <?php echo $errors['email']?>
                    </div>
                    <div class="col-12 mb-3"> 
                        <input type="text" name='email' class="form-control" placeholder="Email or phone number" id="email" aria-describedby="emailHelp">
                    </div>
                    
                    <div class="error col-12 mb-3"> 
                        <?php echo $errors['password']?>
                    </div>
                    <div class="mb-3">
                        <input type="password" name='password' placeholder="Password"class="form-control" id="password">
                    </div>
                    
                    <button type="submit" name='submit' class="btn btn-primary w-100">Register</button>
                </form>
                <hr style="color:black;">
                <div class="text-center my-2">
                    
                    <a href="#">Sign up with Facebook</a>
                </div>
                
                <div class=""></div>

                <div class="text-center my-2">
                    Already have an account?
                    <a href="/SocialMediaPlatform/login.php"> Login</a>
                </div>
            </div>
           
        </div>
    </div>

    <?php include('footer.php') ?>
</body>
</html>