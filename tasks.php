<?php 
	session_start(); 
	session_start();
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');
$connect = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME);
$nas = $_SESSION['nap'];
$result = mysqli_query($connect,"SELECT * FROM tbl_lists WHERE list_id = $nas"); 
$rew = mysqli_fetch_assoc($result); 
$napr = $rew['list_name']; 
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME);
        $ema = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email='$ema'";
        $res = mysqli_query($conn, $sql);
        if($res==true){
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
            $first = $row['firstname'];
            $last = $row['lastname'];
            $otchestvo = $row['otchestvo'];
            $phone = $row['phone'];
            $otchestvo = $row['otchestvo'];
            $phone = $row['phone'];
            $group = $row['groups'];
            $birth = $row['date'];
        }

	if (!isset($_SESSION['email'])) {
		$_SESSION['msg'] = "Вы должны сначала войти в систему";
		header('location: authentication/flows/basic/sign-in.php');
	}



	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['email']);
		header("location: authentication/flows/basic/sign-in.php");
	}
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
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<a href="index.php">
							<img alt="Logo" src="assets/media/logos/logo-1-dark.svg" class="logo" style="height: 45px;" />
						</a>
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
								</svg>
							</span>
						</div>
					</div>
				</div>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<div id="kt_header" style="" class="header align-items-stretch">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
								</div>
							</div>
							<div class="d-flex align-items-stretch justify-content-end flex-lg-grow-1">
								<div class="d-flex align-items-stretch flex-shrink-0">
									<div class="d-flex align-items-stretch flex-shrink-0">
										
										<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
											<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
												<img src="assets/media/avatars/150-26.jpg" alt="user" />
											</div>
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
												<div class="menu-item px-3">
													<div class="menu-content d-flex align-items-center px-3">
														<div class="symbol symbol-50px me-5">
															<img alt="Logo" src="assets/media/avatars/150-26.jpg" />
														</div>
															<div class="d-flex flex-column">
															<div class="fw-bolder d-flex align-items-center fs-5"><?php echo $first?> <?php echo $last?>
															    </div>
															<a href="#" class="fw-bold text-muted text-hover-primary fs-7"><?php echo $_SESSION['email']?></a>
														</div>
													</div>
												</div>
												<div class="separator my-2"></div>
												<div class="menu-item px-5">
													<a href="account/overview.php" class="menu-link px-5">Профиль </a>
												</div>
												
												<div class="separator my-2"></div>
												<div class="menu-item px-5">
													<a href="tasks.php" class="menu-link px-5">Задачи </a>
												</div>
												<div class="separator my-2"></div>
												
												<div class="menu-item px-5">
													<a href="authentication/flows/basic/logout.php" class="menu-link px-5">выйти</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container-fluid" id="index">
							<div class="d-flex justify-content-between align-items-center mb-7">
								<h1>Задачи которые вы взяли</h1>
								<p>
            <?php 
                if(isset($_SESSION['add_fail']))
                {
                    echo $_SESSION['add_fail'];
                    unset($_SESSION['add_fail']);
                }
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                } 
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                 if(isset($_SESSION['delete_fail']))
                {
                    echo $_SESSION['delete_fail'];
                    unset($_SESSION['delete_fail']);
                }
                 if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                 if(isset($_SESSION['update_fail']))
                {
                    echo $_SESSION['update_fail'];
                    unset($_SESSION['update_fail']);
                }
            ?>
        </p>
							</div>
							<div class="row">
								<div class="col-4">
									<div>
										<h2>Задачи</h2>
										<?php 
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                $ema = $_SESSION['email'];
                $sql = "SELECT * FROM getlar WHERE email = '$ema' ";
                $res = mysqli_query($conn, $sql);
                if($res==true)
                {
                    $count_rows = mysqli_num_rows($res);
                    $sn=1;
                    if($count_rows>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $task_id = $row['task_id'];
                            $task_name = $row['task_name'];
                            $desc = $row['task_description'];
                            $priority = $row['start'];
                            $deadline = $row['deadline'];
                            $sost = $row['sost'];
                            ?>
                            										<div class="card-body mt-5 p-9 bg-white">
											<div class="fs-2hx fw-bolder"><a href=""><?php echo $task_name; ?></a></div>
											<div class="fs-4 fw-bold text-gray-400 mb-4"><?php echo $desc; ?></div>
											<small>от <span><?php echo $priority; ?></span> до <span><?php echo $deadline; ?></span></small>
											<div class="d-flex justify-content-between">
											</div>
										</div>
                                </td></tr><?php }}else{?><tr><td colspan="5">Нет задании</td></tr><?php }}?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-center">
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted fw-bold me-1">2021©</span>
								<a href="https://www.profstankin.ru/" target="_blank" class="text-gray-800 text-hover-primary">Профком СТАНКИН</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
		</div>
		<div class="modal fade" id="modalAddTask" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header pb-0 border-0 justify-content-end">
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" aria-label="Close">
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
								</svg>
							</span>
						</div>
					</div>
					<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
						<form action="" method="POST">
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
								<button class="btn btn-success" name="submit">Добавить</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/modals/create-app.js"></script>
		<script src="assets/js/custom/modals/upgrade-plan.js"></script>
	</body>
</html>
<?php 
    if(isset($_POST['submit']))
    {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $start = $_POST['start'];
        $deadline = $_POST['deadline'];
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());
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
            $_SESSION['add'] = "Task Added Successfully.";
            header('location:index.php');
        }
        else
        {
            $_SESSION['add_fail'] = "Failed to Add Task";
            header('location: index.php');
        }
    }
    ?>