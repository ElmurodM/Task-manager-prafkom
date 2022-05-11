<?php 
include('server.php');
session_start();
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'register');
define('DB_PASSWORD', 'aT2lO8sN2w');
define('DB_NAME', 'register');?>
<!DOCTYPE html>
<html lang="en">
	<head><base href="../../../">
		<title>Регистрация</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/custm.css" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background: #1e1e2d">
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<a href="index.php" class="mb-12">
						<img alt="Logo" src="assets/media/logos/logo-1-dark.svg" style="height: 100px;"/>
					</a>
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<form method="post" class="form w-100" novalidate="novalidate" id="kt_sign_up_form" action="authentication/flows/basic/sign-up.php">
							<div class="mb-10 text-center">
								<h1 class="text-dark mb-3">Создать аккаунт</h1>
								<div class="text-gray-400 fw-bold fs-4">У вас есть аккаунт?
								<a href="authentication/flows/basic/sign-in.php" class="link-primary fw-bolder">Войдите</a></div>
								<p><?php include('errors.php'); ?></p>
							</div>
							<div class="row fv-row mb-7">
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Имя</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="first-name" />
								</div>
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Фамилия</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="last-name" />
								</div>
								<div class="col-12">
									<label class="form-label fw-bolder text-dark fs-6">Отчество</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="lasts-name" />
								</div>
							</div>
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" />
							</div>
														<div class="mt-4">

							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Направление</label>
								<select class="form-control form-control-lg form-control-solid form-select dropdown-toggle"  name="nap" id="">
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
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Номер телефона</label>
								<input class="form-control form-control-lg form-control-solid" type="tel" placeholder="" name="phone" />
							</div>
							<div class="mb-10 fv-row" data-kt-password-meter="true">
								<div class="mb-1">
									<label class="form-label fw-bolder text-dark fs-6">Пароль</label>
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" />
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
									</div>
									<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
									</div>
								</div>
								<div class="text-muted">Должно быть не меньше 8 символов</div>
							</div>
							<div class="fv-row mb-5">
								<label class="form-label fw-bolder text-dark fs-6">Повторите пароль</label>
								<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" />
							</div>
							<div class="fv-row mb-10">
								<label class="form-check form-check-custom form-check-solid form-check-inline">
									<input class="form-check-input" type="checkbox" name="toc" value="1" />
									<span class="form-check-label fw-bold text-gray-700 fs-6">Я согласен на обработку моих персональных данных.</span>
								</label>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-lg btn-primary" name="reg_user">
									<span class="indicator-label">Отправить</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></scrip