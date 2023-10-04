<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:./index.php');
}

$data = $_SESSION['data'];
if ($_SESSION['status'] == 1) {
    $status = '<b class="text-success"> Voted </b>';
} else {
    $status = '<b class="text-danger"> Not Voted </b>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP voting system</title>
    <!-- Bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-dark text-light">
    <div class="container my-5">
        <!-- <a href="./index.php"><button class="btn btn-secondary text-light px-3">Back</button></a> -->
        <a href="./logout.php"><button class="btn btn-secondary text-light px-3">Logout</button></a>
        <h1 class="my-3">Voting System</h1>
        <div class="row my-5">
            <div class="col md-7">
                <?php
                if (isset($_SESSION['groups'])) {
                    $groups = $_SESSION['groups'];
                    for ($i = 0; $i < count($groups); $i++) {
                        ?>
                        <!-- groups -->
                        <div class="row">
                            <div class="col md-4">
                                <img src="./uploads/<?php echo $groups[$i]['photo']; ?>" alt="Anime Image">
                            </div>
                            <div class="col md-8">
                                <strong class="text-secondary h5">Anime Name:</strong>
                                <?php echo $groups[$i]['username']; ?><br>
                                <strong class="text-secondary h5">Votes:</strong>
                                <?php echo $groups[$i]['votes']; ?><br>
                            </div>
                        </div>
                        <form action="./actions/voting.php" method="post">
                            <input type="hidden" name="groupVotes" value="<?php echo $groups[$i]['votes']; ?>">
                            <input type="hidden" name="groupId" value="<?php echo $groups[$i]['id']; ?>">

                            <?php
                            if ($_SESSION['status'] == 1) {
                                ?>
                                <button class="bg-success my-3 px-3 mx-4 text-white" disabled>voted</button>
                                <?php
                            } else {
                                ?>
                                <button class="bg-danger my-3 px-3 mx-4 text-white" type="submit">vote</button>
                                <?php
                            }
                            ?>
                        </form>
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <div class="container">
                        <p>no animes to display</p>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class=" col md-5">
                <!-- user profile -->
                <img src="./uploads/<?php echo $data['photo']; ?>" alt="User image"><br><br>
                <strong class="text-secondary h5">Name:</strong>
                <?php echo $data['username']; ?><br><br>
                <strong class="text-secondary h5">Mobile:</strong>
                <?php echo $data['mobile']; ?><br><br>
                <strong class="text-secondary h5">Status:</strong>
                <?php echo $status; ?><br><br>
            </div>

        </div>
    </div>
</body>

</html>