<?php 
	session_start(); 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');
    if(isset($_GET['task_id'])){
        $task_id = $_GET['task_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "DELETE FROM tbl_task WHERE task_id=$task_id";
        $res = mysqli_query($conn, $sql);
        if($res==true){
            $_SESSION['delete'] = "Задача успешно удалена.";
            header('location:https://it-sfera.uz/Profkom/moderators/taskmanager-main/index.php');
        }else{
            $_SESSION['delete_fail'] = "Не удалось удалить задачу";
            header('location:https://it-sfera.uz/Profkom/moderators/taskmanager-main/index.php');
        }
    }else{
        header('location:https://it-sfera.uz/Profkom/moderators/taskmanager-main/index.php');
    }
?>