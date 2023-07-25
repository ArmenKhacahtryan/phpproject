<?php
session_start();
include ("db.php");
if (!isset($_SESSION["user_id"])){
    header("location:login.php");
    exit;
}
$i_user_id = $_SESSION["user_id"];
$user_sql = "SELECT * FROM users WHERE id = '$i_user_id'";
$user_query = mysqli_query($conn,$user_sql);
$user_row="";
//$SQL = "SELECT * FROM posts";
//$query = mysqli_query($conn,$SQL);
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
    <link rel="stylesheet" href="./css/style.css">
    <title>MY BLOG</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MY BLOG</a>
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
    <div class="card" style="width: 18rem; float: right">
        <?php
        if ($user_query->num_rows>0){
            $user_row = $user_query->fetch_assoc();
            ?>
            <img src="./usersimages/<?=$user_row['avatar']?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Name`<?=$user_row['username']?></h5>
            <h5>Address`<?=$user_row['address']?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Age`<?=$user_row['age']?></li>
            <li class="list-group-item">Gender`<?=$user_row['gender']?></li>
            <li class="list-group-item">Email`<?=$user_row['email']?></li>
        </ul>
        <div class="card-body">
            <a class="card-link" aria-current="page" href="./createPost.php?authornames=<?=$user_row["username"]?>">CREATE NEW POST</a>
            <a class="card-link"  href="./logout.php">LOG OUT</a>
        </div>
        <?php } ?>
    </div>
    <form action="" method="post">
        <div class="input-group mb-3">
            <button class="btn btn-success">SEARCH</button>
            <input type="text" class="form-control" placeholder="TITLE" name="search">
            <select class="form-select" name="select">
                <option value="title">TITLE</option>
                <option value="authornames">AUTHORNAMR</option>
            </select>
        </div>
    </form>
    <div class="parent_box" style="width: 100%;height:auto">
        <?php
        if (isset($_POST["search"])){
        $select = $_POST["select"];
        $search = $_POST["search"];
        $SQL = "SELECT * FROM posts WHERE $select LIKE '%$search%'";
        $result = mysqli_query($conn,$SQL);
        if ($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
        ?>
            <div class="cards" >
                <div class="img_parent">
                    <img src="./postsimages/<?=$row['imagespost']?>"   alt="" class="imgpost">
                </div>
                <div class="title">
                    <h1 class="titles">
                        TITLE`<?=$row["title"]?>
                    </h1>
                </div>
                <div class="text_parrent">
                    <p>
                        DESC`<?=$row["description"]?>
                    </p>
                </div>
                <div class="text_parrent">
                    <p>
                        CREATE AT<?=$row["create_at"]?>
                    </p>
                </div>
                <div class="text_parrent">
                    <p>
                        UPDATE AR`<?=$row["update_at"]?>
                    </p>
                </div>
                <div class="text_parrent">
                    <p>
                        AUTHOR NAME`<?=$row["authornames"]?>
                    </p>
                </div>
                <div class="text_parrent">
                    <?php
                    if ($_SESSION["user_id"]===$row["user_id"]){
                        ?>
                        <a class="btn btn-success" href="./updatePost.php?updated_id=<?=$row["id"]?>">UPDATE POST</a>
                        <a class="btn btn-danger" href="./deletePost.php?deleted_id=<?=$row["id"]?>">DELETE POST</a>
                    <?php   } ?>
                </div>
            </div>
        <?php            }
        }
        }  ?>
    </div>
    <div class="hello">
        <?php
        if (isset($_SESSION["msg"]["successDeleted"])){?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION["msg"]["successDeleted"];
                unset($_SESSION["msg"]["successDeleted"]);
                ?>
            </div>
        <?php   }elseif (isset($_SESSION["msg"]["errorDeleted"])){ ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION["msg"]["errorDeleted"];
                unset($_SESSION["msg"]["errorDeleted"]);
                ?>
            </div>
        <?php } ?>
    </div>
    <div class="hello">
        <?php
        if (isset($_SESSION["msg"]["successUpdated"])){?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION["msg"]["successUpdated"];
                unset($_SESSION["msg"]["successUpdated"]);
                ?>
            </div>
        <?php   }elseif (isset($_SESSION["msg"]["errorUpdated"])){ ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION["msg"]["errorUpdated"];
                unset($_SESSION["msg"]["errorUpdated"]);
                ?>
            </div>
        <?php } ?>
    </div>
</div>
<script src="./js/index.js">
</script>
</body>
</html>



