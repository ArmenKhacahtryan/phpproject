<?php
include ("db.php");
session_start();
if (!isset($_SESSION["user_id"])){
    header("location:login.php");
    exit;
}
if (isset($_GET["deleted_id"])){
    $deleted_id = $_GET["deleted_id"];
    $SQL = "DELETE FROM posts WHERE `id` = '$deleted_id'";
    $query = mysqli_query($conn,$SQL);
    if ($query==true){
        $_SESSION["msg"]=[
          "successDeleted"=>"ROW SUCCSESSFLY DELETED"
        ];
        header("location:index.php");
    }else{
        $_SESSION["msg"]=[
            "errorDeleted"=>"ROW NOT DELETED"
        ];
        header("location:index.php");
    }

}

if (isset($_GET["deletedd_id"])){
    $deleted_id = $_GET["deletedd_id"];
    $SQL = "DELETE FROM posts WHERE `id` = '$deleted_id'";
    $query = mysqli_query($conn,$SQL);
    if ($query==true){
        $_SESSION["msg"]=[
            "successDeletedd"=>"ROW SUCCSESSFLY DELETED"
        ];
        header("location:viewMyPost.php");
    }else{
        $_SESSION["msg"]=[
            "errorDeletedd"=>"ROW NOT DELETED"
        ];
        header("location:viewMyPost.php");
    }

}