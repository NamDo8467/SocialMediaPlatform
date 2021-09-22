<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body >
    <div class="container h-100">
        <div class="row align-items-center h-100 justify-content-center">
            <div class="phone-container col-auto col-sm-auto col-md-6 col-lg-4 d-none d-sm-none d-md-block">
                <img class='white-phone' src="./images/instagram_white_phone.png" alt="instagram_phone">
                <div class="phone-content-container">
                    
                </div>

            </div>
            <div class="col-auto col-sm-auto col-md-6 col-lg-4 border p-4 h-75">
                <div class="mb-4 text-center">
                    <img src="./images/instagram_logo.png" alt="instagram_logo">
                </div>
                <form action='register.php' method="POST">
                    <div class="col-12 mb-3"> 
                        <input type="text" name='email' class="form-control" placeholder="Email or phone number" id="email" aria-describedby="emailHelp">
                    </div>
                    
                    <div class="mb-3">
                        <input type="password" name='password' placeholder="Password"class="form-control" id="password">
                    </div>
                    
                    <button type="submit" name='submit' class="btn btn-primary w-100">Register</button>
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