<?php
session_start();
include ("db.php");
if (!isset($_SESSION["user_id"])){
    header("location:login.php");
    exit;
}
$user_id = $_SESSION["user_id"];
$authornames = $_GET["authornames"];
if (isset($_POST['create'])){
    $filename = $_FILES["uploadfilepost"]["name"];
    $tempname = $_FILES["uploadfilepost"]["tmp_name"];
    $newFileName = time().$filename;
    $folder = "./postsimages/".$newFileName;
    $authorname = $_POST["authorname"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $SQL = "INSERT INTO posts (user_id,title,description,create_at,authornames,imagespost) VALUES ('$user_id','$title','$description',now(),'$authorname','$newFileName')
";
if (move_uploaded_file($tempname,$folder)){
    $result = mysqli_query($conn,$SQL);
//    header("location:login.php");
}
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <title>CREATE POST</title>
</head>
<body>
<div class="container" style="height: 100vh">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">MY BLOG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="viewMyPost.php">MY POSTS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="width: 100%;height: 70%; justify-content: center;display: flex; align-items: center">

        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="text-center">
                    CREATE POST
            </h1>
            <div class="input-group mb-3">
                <input class="form-control" type="file" name="uploadfilepost">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">POST TITLE</span>
                <input type="text" class="form-control" placeholder="POST TITLE" name="title" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <input type="hidden" name="authorname" value="<?=$_GET["authornames"]?>">
                <textarea class="form-control" placeholder="DESCRIPTION" id="floatingTextarea" name="description"></textarea>
            </div>
            <div class="input-group mb-3">
                <input type="submit" class="form-control btn btn-success" value="CREATE POST" name="create" >
            </div>
        </form>
    </div>
</div>
</body>
</html>
