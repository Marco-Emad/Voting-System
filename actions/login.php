<?php
session_start();
include('connect.php');

$username = $_POST['username'];
$password = $_POST['password'];
$std = $_POST['std'];

$sql = "Select * from `user-data` where username = '$username' and password='$password' and standard='$std'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql = "Select id,username,photo,votes from `user-data` where standard='group'";
    $resultGroup = mysqli_query($con, $sql);

    if (mysqli_num_rows($resultGroup) > 0) {
        $groups = mysqli_fetch_all($resultGroup, MYSQLI_ASSOC);
        $_SESSION['groups'] = $groups;
    }

    $data = mysqli_fetch_array($result);
    $_SESSION['id'] = $data['id'];
    $_SESSION['status'] = $data['status'];
    $_SESSION['data'] = $data;

    echo '<script>     
    window.location = "../dashboard.php";
    </script>';
} else {
    echo '<script> 
    alert("Invalid credentials");
    window.location = "../index.php";
    </script>';
}


?>