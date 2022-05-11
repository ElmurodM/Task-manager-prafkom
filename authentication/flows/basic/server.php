<?php 
	session_start();
	$errors = array(); 
	$_SESSION['success'] = "";

    $servername='localhost';
    $username='register';
    $password='aT2lO8sN2w';
    $dbname = "register";
    $db=mysqli_connect($servername,$username,$password,"$dbname");


	if (isset($_POST['reg_user'])) {
		$firstname = mysqli_real_escape_string($db, $_POST['first-name']);
		$lastname = mysqli_real_escape_string($db, $_POST['last-name']);
		$otchestvo = mysqli_real_escape_string($db, $_POST['lasts-name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$nap = mysqli_real_escape_string($db, $_POST['nap']);
		$confirmpassword = mysqli_real_escape_string($db, $_POST['confirm-password']);

		if (empty($firstname)) { array_push($errors, "Имя пользователя требуется"); }
		if (empty($lastname)) { array_push($errors, "Фамилия пользователя требуется"); }
		if (empty($email)) { array_push($errors, "Email пользователя требуется"); }
		if (empty($password)) { array_push($errors, "Пароль пользователя требуется"); }

		if ($password != $confirmpassword) {
			array_push($errors, "Два пароля не совпадают");
		}
		$query = "SELECT * FROM users WHERE email = '$email'";
        $result=mysqli_query($db,$query);
      if($result){
          if( mysqli_num_rows($result) > 0){
              array_push($errors, "Этот email уже использован");
          }}
		if (count($errors) == 0) {
			$query = "INSERT INTO users (firstname,lastname,otchestvo,phone,email,password,nap) 
					  VALUES('$firstname', '$lastname', '$otchestvo','$phone', '$email', '$password','$nap')";
			mysqli_query($db, $query);
			$_SESSION['first-name'] = $firstname;
			$_SESSION['last-name'] = $lastname;
			$_SESSION['email'] = $email;
			$_SESSION['otchestvo'] = $otchestvo;
			$_SESSION['phone'] = $phone;
			$_SESSION['nap'] = $nap;
			$_SESSION['success'] = "Вы вошли в систему";
			header('location: https://it-sfera.uz/index.php');
		}

	}

	// ... 

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
			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);
			$result = mysqli_query($db,"SELECT * FROM users WHERE email='$email'"); 
            $rew = mysqli_fetch_assoc($result); 
            $firstname = $rew['firstname']; 
            $lastname = $rew['lastname']; 
            $otchestvo = $rew['otchestvo'];
            $phone = $rew['phone']; 
            $nap = $rew['nap']; 
            $id = $rew['id'];
			if (mysqli_num_rows($results) == 1) {
			$_SESSION['first-name'] = $firstname;
			$_SESSION['last-name'] = $lastname;
			$_SESSION['email'] = $email;
			$_SESSION['otchestvo'] = $otchestvo;
			$_SESSION['phone'] = $phone;
			$_SESSION['nap'] = $nap;
			$_SESSION['success'] = "Вы вошли в систему";
				header('location: https://it-sfera.uz/index.php');
			}else {
				array_push($errors, "Неверный email или пароль");
			}
		}
	}

?>