<?php
include 'admindb_connect.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $passwords = $_POST['passwords'];

    $s = "SELECT * from adminreg WHERE aname = '$username' AND passwords = '$passwords'";
    $query_run = mysqli_query($con, $s);
    if (mysqli_num_rows($query_run) > 0) {
        $_SESSION['username'] = $username;
        header('location:index.php');
    } else {
        echo '<script type=text/javascript> alert("Invalid details") </script>';
    }
}
?>