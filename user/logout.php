<?php
session_start();
unset($_SESSION["student_ID"]);
header("Location:../");
?>