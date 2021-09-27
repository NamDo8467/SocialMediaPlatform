<?php 
    include('dbConfig.php');
    $allowTypes = array('jpg','png','jpeg'); 
    $error = '';
    $success = '';
    if($_COOKIE['id']){
        $id = $_COOKIE['id'];
        if(isset($_POST['upload'])){
            $caption = mysqli_real_escape_string($connection, $_POST['caption']);
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                $image = $_FILES['image']['tmp_name']; 
                $imageContent = addslashes(file_get_contents($image));
    
                $sql = "INSERT INTO posts (user_id, images, caption, likes) VALUES( $id, '$imageContent', '$caption', 0)";
    
                if(mysqli_query($connection, $sql)){
                    $success =  "Successfully uploaded";
                }else{
                    $error  ="query error: " . mysqli_error($connection);
                }
                
            }else{
                $error = "Only accepted .jpg, .png, .jpeg";
            }
        }
        
    }else{
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Add Post</title>
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <div class="container">
            <form action="addPost.php" method='POST' enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Write something to your post</label>
                    <textarea class="form-control" name='caption' id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose image to upload</label>
                    <input class="form-control" type="file" name='image' id="formFile" accept="image/*">
                </div>
                <p class='text-danger'><?php echo $error?></p>
                <p class='text-success'><?php echo $success?></p>
                <button type="submit" name='upload' class="btn btn-primary">Upload</button>
                <button class="btn btn-dark"><a class='text-white' href="profile.php">Go back</a></button>
            </form>
        </div>
    </main>

</body>
</html>