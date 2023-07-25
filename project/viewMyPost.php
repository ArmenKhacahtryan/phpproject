<?php
session_start();
include ("db.php");
if (!isset($_SESSION["user_id"])){
    header("location:login.php");
    exit;
}
$i_user_id = $_SESSION["user_id"];
$user_sql = "SELECT * FROM posts WHERE user_id = '$i_user_id'";
$user_query = mysqli_query($conn,$user_sql);



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

    <title>VIEW MY POSTS</title>
</head>
<body>
<div class="container">
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
    <div class="hello">
        <?php
        if (isset($_SESSION["msg"]["successDeletedd"])){?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION["msg"]["successDeletedd"];
                unset($_SESSION["msg"]["successDeletedd"]);
                ?>
            </div>
        <?php   }elseif (isset($_SESSION["msg"]["errorDeletedd"])){ ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION["msg"]["errorDeletedd"];
                unset($_SESSION["msg"]["errorDeletedd"]);
                ?>
            </div>
        <?php } ?>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">TITLE</th>
            <th scope="col">DESCRIPTION</th>
            <th scope="col">CREATE_AT</th>
            <th scope="col">UPDATE_AT</th>
            <th scope="col">AUTHOR NAME</th>
            <th scope="col">ACTION</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $user_query->fetch_assoc()){  ?>

            <tr>
                <td>
                    <?=$row["id"]?>
                </td>
                <td>
                    <?=$row["title"]?>
                </td>
                <td>
                    <?=$row["description"]?>
                </td>
                <td>
                    <?=$row["create_at"]?>
                </td>
                <td>
                    <?=$row["update_at"]?>
                </td>
                <td>
                    <?=$row["authornames"]?>
                </td>
                <?php
                if ($_SESSION["user_id"]===$row["user_id"]){
                    ?>
                    <td>
                        <a class="btn btn-success" href="./updatePost.php?updated_id=<?=$row["id"]?>">UPDATE POST</a>
                        <a class="btn btn-danger" href="./deletePost.php?deletedd_id=<?=$row["id"]?>">DELETE POST</a>
                    </td>
                <?php   } ?>

            </tr>
        <?php   } ?>
        </tbody>
    </table>
</div>

</body>
</html>
