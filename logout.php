<?php
include "admin/config.php";

session_start();

session_unset();

session_destroy();

header("Location:{$hostname}/index.php");

?>