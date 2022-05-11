<?php 
	session_start(); 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');
?>
<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>Tasks</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/custm.css" rel="stylesheet" type="text/css" />
	
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
                <div style = "top : 30px;" class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
						<form action="" method="POST" >
						    <button class="btn btn-success py-2"><a style = "color:white"href="index.php">Назад</a></button>
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
								<input type="text" name="task_name" class="form-control mt-4">
							</div>
							<div class="mt-4">
								<label for="">Описание</label>
								<textarea name="task_description" class="form-control mt-4" id="" cols="30" rows="4"></textarea>
							</div>
							<div class="mt-4">
								<label for="">Направление</label>
								<select name="list_id">
                            <?php 
                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                $sql = "SELECT * FROM tbl_lists";
                                $res = mysqli_query($conn, $sql);
                                if($res==true)
                                {
                                    $count_rows = mysqli_num_rows($res);
                                    if($count_rows>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $list_id = $row['list_id'];
                                            $list_name = $row['list_name'];
                                            ?>
                                            <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">Нету ничего</option>p
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
										<input type="date" name="start"  class="form-control mt-4">
									</div>
								</div>
								<div class="col-6">
									<div>
										<label for="">До какого </label>
									<input type="date" name="deadline" class="form-control mt-4">
								</div>
							</div>
						</div>
						<div class="d-flex mt-4">
							<button class="btn btn-secondary me-4" type="reset">Очистить</button>
							<button class="btn btn-success" type="submit" name="submit">Добавить</button>
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


	if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $start = $_POST['start'];
        $deadline = $_POST['deadline'];
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $sql2 = "INSERT INTO tbl_task SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            start = '$start',
            deadline = '$deadline',
            sost = 'bez'
        ";
        $res2 = mysqli_query($conn2, $sql2);
        if($res2==true)
        {
            $_SESSION['add'] = "Задача успешно добавлена.";
            header('location: index.php');
        }
        else
        {
            $_SESSION['add_fail'] = "Ошибка доб заданий";
            header('location: add-task.php');
        }
    }


?>