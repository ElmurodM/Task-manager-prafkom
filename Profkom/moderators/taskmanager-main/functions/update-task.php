


<?php 
	session_start(); 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');
if(isset($_GET['task_id']))
    {
        $task_id = $_GET['task_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        $sql = "SELECT * FROM tbl_task WHERE task_id=$task_id";
        $res = mysqli_query($conn, $sql);
        if($res==true){
            $row = mysqli_fetch_assoc($res);
            $task_name = $row['task_name'];
            $task_description = $row['task_description'];
            $list_id = $row['list_id'];
            $start = $row['start'];
            $deadline = $row['deadline'];
        }
    }else{
        header('location: https://it-sfera.uz/Profkom/moderators/taskmanager-main/');
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>Tasks</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/custm.css" rel="stylesheet" type="text/css" />
	
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
                <div style = "top : 30px;" class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
						<form action="" method="POST" >
						    <button class="btn btn-success py-2"><a style = "color:white"href="../index.php">Назад</a></button>
						    <p>
            <?php 
                if(isset($_SESSION['add_fail']))
                {
                    echo $_SESSION['add_fail'];
                    unset($_SESSION['add_fail']);
                }
            ?>
        </p>
							<div>
								<label for="">Название задачи</label>
								<input type="text" name="task_name" value="<?php echo $task_name; ?>" class="form-control mt-4">
							</div>
							<div class="mt-4">
								<label for="">Описание</label>
								<textarea name="task_description" class="form-control mt-4" id="" cols="30" rows="4"><?php echo $task_description; ?></textarea>
							</div>
							<div class="mt-4">
								<label for="">Направление</label>
								<select name="list_id">
                             <?php 
                                $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
                                $sql2 = "SELECT * FROM tbl_lists";
                                $res2 = mysqli_query($conn2, $sql2);
                                if($res2==true){
                                    $count_rows2 = mysqli_num_rows($res2);
                                    if($count_rows2>0)
                                    {
                                        while($row2=mysqli_fetch_assoc($res2)){
                                            $list_id_db = $row2['list_id'];
                                            $list_name = $row2['list_name'];
                                            ?>
                                            <option <?php if($list_id_db==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <option <?php if($list_id=0){echo "selected='selected'";} ?> value="0">Нет направление</option>p
                                        <?php
                                    }
                                }
                            ?>
                        </select>
							</div>
							<div class="row mt-4">
								<div class="col-6">
									<div>
										<label for="">С какого </label>
										<input type="date" name="start" value="<?php echo $start; ?>  class="form-control mt-4">
									</div>
								</div>
								<div class="col-6">
									<div>
										<label for="">До какого </label>
									<input type="date" name="deadline" value="<?php echo $deadline; ?> class="form-control mt-4">
								</div>
							</div>
						</div>
						<div class="d-flex mt-4">
							<button class="btn btn-success" type="submit" name="submit">Сохранить</button>
						</div>
					</form>
				</div>
	</body>
</html>
<?php 
	session_start(); 
	session_start();
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');


if(isset($_POST['submit'])){
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $start = $_POST['start'];
        $deadline = $_POST['deadline'];
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());
        $sql3 = "UPDATE tbl_task SET 
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = '$list_id',
        start = '$start',
        deadline = '$deadline'
        WHERE 
        task_id = $task_id
        ";
        $res3 = mysqli_query($conn3, $sql3);
        if($res3==true)
        {
            $_SESSION['update'] = "Задача успешно обновлена.";
            header('location:../index.php');
        }else{
            $_SESSION['update_fail'] = "Не удалось обновить задачу";
            header('location:update-task.php?task_id='.$task_id);
        }
    }
?>