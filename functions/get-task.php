<?php 
	session_start(); 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');
  if(isset($_GET['email'])){
    $emai = $_GET['email'];
  }
   if(isset($_GET['task_id']))
    {
        $task_id = $_GET['task_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME);
        $sql = "SELECT * FROM tbl_task WHERE task_id=$task_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $start = $row['start'];
        $deadline = $row['deadline'];
        $sost = $row['sost'];
        
        $sql2 = "UPDATE tbl_task SET 
        sost = 'pros'
        WHERE 
        task_id = $task_id
        ";
        $res2 = mysqli_query($conn, $sql2);
        
        $sql3 = "INSERT INTO getlar SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            start = '$start',
            deadline = '$deadline',
            sost = '$sost',
            email = '$emai'
            
        ";
        $res3 = mysqli_query($conn, $sql3);
        
        header('location: https://it-sfera.uz/');
    }else{
        header('location: https://it-sfera.uz/');
    }

?>