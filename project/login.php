<?php
include ("db.php");
session_start();
if (isset($_SESSION["user_id"])){
    header("location:index.php");
    exit;
}
if (isset($_POST["password"])){
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $SQL = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$SQL);
    $user = $result->fetch_assoc();
    if ($user && md5($password,$user["password"])){
        $_SESSION["user_id"] = $user["id"];
        header("location:index.php");
        exit;
    }else{
        $_SESSION["msg"] = [
            "errorlogin"=>"INVALID EMAIL OR PASSWORD"
        ];
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
    <title>LOGIN</title>
</head>
<body>
<div class="container" style="height: 100vh">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./register.php">REGISTER</a>
        </div>
    </nav>
    <div style="width: 100%;height: 70%; justify-content: center;display: flex; align-items: center">

        <form action="" method="post">
            <br>
            <h1 class="text-center">
                LOGIN
            </h1>
            <br>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email</span>
                <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" class="form-control" placeholder="Password"name="password" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <a href="./register.php">Create Account?</a>
            <br>
            <br>
            <div  id="msgBox" style="width: 100%;margin: 0 auto; text-align: center">
                <div class="hello">
                    <?php
                        if (isset($_SESSION["msg"]["errorlogin"])){?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                    echo $_SESSION["msg"]["errorlogin"];
                                    unset($_SESSION["msg"]["errorlogin"]);
                                ?>
                            </div>
                          <?php   } ?>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="submit" class="form-control btn btn-success" value="REGISTRE" name="register" >
            </div>

        </form>
    </div>
</div>
<script>
    let msgBox = document.getElementById("msgBox");
    setTimeout(()=>{
        msgBox.innerHTML = "";
    },5000)
</script>
</body>
</html>
