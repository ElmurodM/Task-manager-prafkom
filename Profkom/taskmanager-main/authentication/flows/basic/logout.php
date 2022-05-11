<?php
ob_start();
session_start();
if(isset($_SESSION['user_login_id'])) {
session_destroy();
unset($_SESSION['lastname']);
unset($_SESSION['first_name']);
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['phone']);
header("Location: sign-in.php");
} else {
header("Location: sign-in.php");
}
?>