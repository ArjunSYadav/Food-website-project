<?php




    include "admin/config.php";
    include  "databasefile.php";
    $obj = new homeclass();

    // include "_db_pdo.php";


    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // $sql ="UPDATE user SET `first_name` ='{$fname}', `last_name` ='{$lname}', `username`='{$user}', `role` ='{$role}' WHERE `user_id` = {$userid}";
    $obj->update('user', ["email" => $email, "first_name" => $fname, "last_name" => $lname, "user_name" => $user], "`user_id` = {$userid} ");
    $result = $obj->getResult();
    if (!empty($result)) {
        header("Location:{$hostname}/user.php?userid=$userid");
    }
 else {
    echo "Some Problem";
}
