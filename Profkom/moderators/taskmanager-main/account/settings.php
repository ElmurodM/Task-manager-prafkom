<?php 
	session_start(); 
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD,DB_NAME);
        $ema = $_SESSION['email'];
        $sql = "SELECT * FROM moderators WHERE email='$ema'";
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
        	if (isset($_POST['update'])) {
		$firstname = mysqli_real_escape_string($conn, $_POST['first-name']);
		$lastname = mysqli_real_escape_string($conn, $_POST['last-name']);
		$otchestvo = mysqli_real_escape_string($conn, $_POST['lasts-name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$group = mysqli_real_escape_string($conn, $_POST['group']);
		$date = mysqli_real_escape_string($conn, $_POST['date']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
	    mysqli_query($conn,"UPDATE moderators SET firstname = '$firstname',   lastname = '$lastname',   otchestvo = '$otchestvo',   phone = '$phone',   email = '$email',groups = '$group', date = '$date' WHERE id = $id");
		header('location: https://it-sfera.uz/Profkom/moderators/taskmanager-main/account/overview.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head><base href="../">
		<title>Профиль</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="assets/css/custm.css">
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
					<div class="aside-menu flex-column-fluid">
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
										 <?php 
            
                //Connect Database
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                
                //Select Database
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                
                //Create SQL Query to Get DAta from Databse
                $sql = "SELECT * FROM tbl_lists";
                
                //Execute Query
                $res = mysqli_query($conn, $sql);
                
                //CHeck whether the query execueted o rnot
                if($res==true)
                {
                    //DIsplay the Tasks from DAtabase
                    //Dount the Tasks on Database first
                    $count_rows = mysqli_num_rows($res);
                    
                    //Create Serial Number Variable
                    $sn=1;
                    
                    //Check whether there is task on database or not
                    if($count_rows>0)
                    {
                        //Data is in Database
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $list_name = $row['list_name'];
                            $list_id = $row['list_id'];
                            ?>
                            
                            	<div class="menu-item">
                            	    <a  class="menu-link" href="https://it-sfera.uz/Profkom/moderators/taskmanager-main/list-task.php?list_id=<?php echo $list_id; ?>">
                               <span class="menu-title">   <?php echo $list_name; ?></span>
                               </a>
                               </div>
                            
                            <?php
                        }
                    }
                    else
                    {
                        //No data in Database
                        ?>
                        
                        <tr>
                            <td colspan="5">No Task Added Yet.</td>
                        </tr>
                        
                        <?php
                    }
                }
            
            ?>

									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<div id="kt_header" style="" class="header align-items-stretch">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
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
													<a href="account/overview.php" class="menu-link px-5">Профиль</a>
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
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-xxl">
								
								<div class="card mb-5 mb-xl-10">
									<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
										<div class="card-title m-0">
											<h3 class="fw-bolder m-0">Детальная информация</h3>
										</div>
									</div>
									<div id="kt_account_profile_details" class="collapse show">
										<form id="kt_account_profile_details_form" class="form" method="POST">
											<div class="card-body border-top p-9">
												<div class="row mb-6">
													<label class="col-lg-4 col-form-label fw-bold fs-6">Фотка</label>
													<div class="col-lg-8">
														<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(assets/media/avatars/blank.png)">
															<div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/150-26.jpg)"></div>
															<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
																<i class="bi bi-pencil-fill fs-7"></i>
																<input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
																<input type="hidden" name="avatar_remove" />
															</label>
															<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
																<i class="bi bi-x fs-2"></i>
															</span>
															<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
																<i class="bi bi-x fs-2"></i>
															</span>
														</div>
														<div class="form-text">Фармат должен быть типа: png, jpg, jpeg.</div>
													</div>
												</div>
												<div class="row mb-6">
													<label class="col-lg-4 col-form-label required fw-bold fs-6">Введите имя фамилию и отчество</label>
													<div class="col-lg-8">
														<div class="row">
															<div class="col-lg-6 fv-row">
																<input type="text" name="first-name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="<?php echo $first; ?>" />
															</div>
															<div class="col-lg-6 fv-row">
																<input type="text" name="last-name" class="form-control form-control-lg form-control-solid" value="<?php echo $last; ?>" />
															</div>
															<div class="col-lg-12 mt-4 fv-row">
																<input type="text" name="lasts-name" class="form-control form-control-lg form-control-solid" value="<?php echo $otchestvo; ?>" />
															</div>
														</div>
													</div>
												</div>
												<div class="row mb-6">
													<label class="col-lg-4 col-form-label required fw-bold fs-6">Номер телефона</label>
													<div class="col-lg-8 fv-row">
														<input type="text" name="phone" class="form-control form-control-lg form-control-solid" value="<?php echo $phone; ?>"/>
													</div>
												</div>
												<div class="row mb-6">
													<label class="col-lg-4 col-form-label fw-bold fs-6">
														<span class="required">Email</span>
													</label>
													<div class="col-lg-8 fv-row">
														<input type="email" name="email" class="form-control form-control-lg form-control-solid" value="<?php echo $_SESSION['email']; ?>"/>
													</div>
												</div>
												<div class="row mb-6">
													<label class="col-lg-4 col-form-label fw-bold fs-6">
														<span class="required">Группа</span>
													</label>
													<div class="col-lg-8 fv-row">
														<input type="text" name="group" class="form-control form-control-lg form-control-solid" value="<?php echo $group; ?>"/>
													</div>
												</div>
												<div class="row mb-6">
													<label class="col-lg-4 col-form-label fw-bold fs-6">
														<span class="required">Дата рождения</span>
													</label>
													<div class="col-lg-8 fv-row">
														<input type="date" name="date" class="form-control form-control-lg form-control-solid" value="<?php echo $birth; ?>"/>
													</div>
												</div>
											</div>
											<div class="card-footer d-flex justify-content-end py-6 px-9">
												<button type="submit" name="update" class="btn btn-primary" id="kt_account_profile_details_submit">Сохранить</button>
											</div>
										</form>
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
		<script>var hostUrl = "assets/";</script>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/modals/create-app.js"></script>
		<script src="assets/js/custom/modals/upgrade-plan.js"></script>
	</body>
</html>
