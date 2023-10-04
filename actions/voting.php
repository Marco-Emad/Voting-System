<?php
session_start();
include('connect.php');

$votes = $_POST['groupVotes'] + 1;
$gid = $_POST['groupId'];
$uid = $_SESSION['id'];

$updateVotes = mysqli_query($con, "update `user-data` set votes='$votes' where id = '$gid'");
$updateStatus = mysqli_query($con, "update `user-data` set status = 1 where id = '$uid'");

if ($updateVotes and $updateStatus) {
    $getGroups = mysqli_query($con, "Select username, photo, votes, id from `user-data` where standard = 'group'");
    $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
    $_SESSION['groups'] = $groups;
    $_SESSION['status'] = 1;

    echo '<script>
    alert("Voting Successful");
    window.location="../dashboard.php";
    </script>';

} else {
    echo '<script>
    alert("Technical error !!  Vote later");
    window.location="../dashboard.php";
    </script>';
}
?>