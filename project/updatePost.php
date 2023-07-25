<?php
include ("db.php");
session_start();
if (!isset($_SESSION["user_id"])){
    header("location:login.php");
    exit;
}
if (isset($_GET["updated_id"])){
    $updated_id = $_GET["updated_id"];
    $SQL = "SELECT * FROM posts WHERE  id = '$updated_id'";
    $query = mysqli_query($conn,$SQL);
    if ($query->num_rows>0){
        while ($row = $query->fetch_assoc()){
            $title = $row["title"];
            $description = $row["description"];
            $id = $row["id"];
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
            <title>UPDATE POST</title>
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
                <form action="" method="post">
                    <h1 class="text-center">
                        UPDATE POST
                    </h1>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">POST TITLE</span>
                        <input type="text" value="<?=$title?>" class="form-control" placeholder="POST TITLE" name="title" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="hidden" name="updated_id_hidden" value="<?=$id?>">
                        <input class="form-control" value="<?=$description?>"  name="description">
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" class="form-control btn btn-success" value="UPDATE POST" name="update" >
                    </div>
                </form>
            </div>
        </div>
        </body>
        </html>


<?php
}
}
if (isset($_POST["update"])){
    $post_id = $_POST["updated_id_hidden"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $SQL = "UPDATE posts SET  `title`='$title',`description`='$description',`update_at`=now() WHERE `id` = '$post_id'";
    $query = mysqli_query($conn,$SQL);
    if ($query==true){
        $_SESSION["msg"]=[
            "successUpdated"=>"ROW SUCCSESSFLY UPDATED"
        ];
        header("location:index.php");
    }else{
        $_SESSION["msg"]=[
            "errorUpdated"=>"ROW NOT UPDATED"
        ];
        header("location:index.php");
    }
}
?>