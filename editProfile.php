<?php
    include('dbConfig.php');
    $errors = ['email_or_phone'=>'', 'password'=>''];
    $allowTypes = array('jpg','png','jpeg','gif'); 

    $success = '';
    $error = "";
    if($_COOKIE['id']){
        $id = $_COOKIE['id'];
        $get_user_information_query = "SELECT username, password, bio, avatar FROM user_information";
        $result = mysqli_query($connection, $get_user_information_query);

        $user_information = mysqli_fetch_assoc($result);
       
        if(isset($_POST['submit-btn'])){
            !empty($_POST['new_username'])? $new_username = $_POST['new_username'] : $new_username = $user_information['username'];
            !empty($_POST['new_password'])? $new_password = $_POST['new_password'] : $new_password = $user_information['password'];
            !empty($_POST['new_bio'])? $new_bio = $_POST['new_bio'] : $new_bio = $user_information['bio'];
            if(!empty($_POST['new_avatar'])){
                $fileName = basename($_FILES["new_avatar"]["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    $image = $_FILES['new_avatar']['tmp_name']; 
                    $new_avatar = addslashes(file_get_contents($image));
                }
            }else{
                $new_avatar = addslashes($user_information['avatar']);
            }
            
            
            $update_query = "UPDATE user_information SET username = '$new_username', password = '$new_password', bio = '$new_bio', avatar = '$new_avatar' WHERE id='$id' ";

            if(mysqli_query($connection, $update_query)){
                $success = "Updated successfully";
                
            }else{
                $error = "There is an error occurred. Please try again later";
            }
        }
    }else{
        header("Location:login.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php include('header.php')?>
    <main>
        <div class="container w-25 mt-5">
            <form action="editProfile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <p class='text-danger'> <?php echo $error?></p>
                <p class='text-success'> <?php echo $success?></p>
            </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name='new_username' id="new_username" placeholder="Enter new username">
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name='current_password' id="current_password" placeholder="Current password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password must be 8-20 characters long.
                    </small>
                </div>
                <div class="form-group mb-3">
                    
                    <input type="password" class="form-control" name='new_password' id="new_password" placeholder="New password">
                </div>
               
                <div class="form-group mb-3">
                    <label for="new_avatar">Choose new avatar</label>
                    <input type="file" class="form-control-file" name="new_avatar" id="new_avatar">
                </div>
                <div class="form-group mb-3">
                    <textarea class="form-control" name='new_bio' id="new_bio" rows="3" placeholder="New Bio"></textarea>
                </div>
                <button type="submit" name='submit-btn' class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>