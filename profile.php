<?php

    include('dbConfig.php');
    function decodeImageContent($image){
        $decodedContent = "data:image/jpg;charset=utf8;base64,". base64_encode($image);
        $renderedImage = "src='$decodedContent'";
        return $renderedImage;
    };
    $username = $posts = $followers = $following = $bio = $avatar = '';
    if($_COOKIE['id']){
        $id = mysqli_real_escape_string($connection, $_COOKIE['id']) ;
        $query = "SELECT * FROM user_information WHERE id = $id";
        $result = mysqli_query($connection, $query);

        $user_information = mysqli_fetch_assoc($result);
        
        $username = $user_information['username'];
        $followers = $user_information['followers'];
        $following = $user_information['following'];
        
        $bio = $user_information['bio'];
        $avatar = $user_information['avatar'];
        $avatarContent = '';
        if($avatar!= NULL){
            $avatarContent = decodeImageContent($avatar);
        }else{
            $avatarContent = "images/temporary_avatar.jpg";
        }

        $get_posts_query = "SELECT images FROM posts WHERE user_id = $id";
        $data = mysqli_query($connection,$get_posts_query);
        $posts_details = mysqli_fetch_all($data, MYSQLI_ASSOC);

        if(count($posts_details)==0){
            $post_number = 0;
        }else{              
            $post_number = count($posts_details);
            
            $posts = array_reverse($posts_details);
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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php include('./header.php')?>
    <main style='height:100vh;'>
        <div class="container h-100">
            <div class="first-section row my-5 gx-5 h-25">
                <div class="avatar h-100 col-5  d-flex justify-content-end">
                    <img class="rounded-circle" <?php echo $avatarContent?> alt="avatar" >
                </div>

                <div class="information-container col-7">
                    <div class="username-container row align-items-center mb-3">
                        <div class="col-12 col-md-3">
                            <p class='my-auto fs-4'><?php echo htmlspecialchars($username)?></p>
                        </div>
                        <button class="btn btn-light border col-12 col-md-2"><a href="editProfile.php">Edit Profile</a></button>
                    </div>

                    <div class="follow-information-container row justify-content-between mb-3">
                        <div class="posts col col-md-2">
                            <?php echo $post_number.' '.'posts'?>
                        </div>
                        <div class=" follower col col-md-3 ">
                            <?php echo htmlspecialchars($following),' '.'followers'?> 
                        </div>
                        <div class="following col col-md-7">
                            <?php echo htmlspecialchars($followers).' '. 'following'?> 
                        </div>
                    </div>

                    <div class="row bio-container">
                        <div class="bio-information col-12 col-md-9">
                            <?php echo $bio?>
                        </div>
                    </div>
                </div>
            </div>
    
            <hr class='w-75 mx-auto my-0 text-center'>
            <div class="second-section row mt-5 gx-5 h-100 justify-content-center">
                <?php if($post_number == 0):?>
                    <?php echo "<div class='col-12 text-center fs-3 h-25'>
                                No Post Yet
                                <br>
                                <a class='fs-5' href='addPost.php'>Add post</a>
                    </div>"?>
                    
                    <?php else:?>
                            <div class="row justify-content-between w-75">
                                <?php foreach($posts as $post):?>
                                    <?php echo "<div class=col-4 ><img class='mb-4' width=250px height=300px alt='post' ".decodeImageContent($post['images']). "></div>"?>
                                <?php endforeach?>
                            </div>
                <?php endif;?>
            </div>
            
        </div>
    </main>

    <script src="js/responsiveWidthHeight.js"></script>
</body>
</html>