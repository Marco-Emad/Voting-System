<?php
$con = mysqli_connect("localhost", "root", "", "voting-system");
if (!$con) {
    die(mysqli_error($con));
}
?>