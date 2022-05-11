<?php 
	session_start();
	$errors = array(); 
	$_SESSION['success'] = "";

    $servername='localhost';
    $username='register';
    $password='aT2lO8sN2w';
    $dbname = "register";
    $db=mysqli_connect($servername,$username,$password,"$dbname");

 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email требуется");
		}
		if (empty($password)) {
			array_push($errors, "Пароль требуется");
		}

		if (count($errors) == 0) {
			$query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);
			$result = mysqli_query($db,"SELECT * FROM admin WHERE email='$email'"); 
            $rew = mysqli_fetch_assoc($result); 
			if (mysqli_num_rows($results) == 1) {
			$_SESSION['email'] = $email;
				$_SESSION['success'] = "Вы вошли в систему";
				header('location: https://it-sfera.uz/Profkom/taskmanager-main/index.php');
			}else {
				array_push($errors, "Неверный email или пароль");
			}
		}
	}

?>