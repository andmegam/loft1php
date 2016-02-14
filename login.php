<?php
session_start();

// Уничтожение сессии
if (isset($_GET['destroy'])) {

  unset($_SESSION['login']);

  if (@$_SERVER['HTTP_REFERER'] != null) {
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }
}

if (isset($_POST['formdata'])) {

	parse_str($_POST['formdata'], $params);

	$login = strip_tags(htmlspecialchars(trim($params['login'])));
	$password = strip_tags(htmlspecialchars(trim($params['password'])));
}

if (!empty($login) && !empty($password)) {

    // Подключение к БД
    require_once("php/config_app.php");

    $sql = "SELECT role FROM user where login='".$login."' and password='".$password."' LIMIT 1;";
    $result = mysqli_query($mysqli,$sql) or die(mysqli_error()) ;
    $row = mysqli_fetch_array($result);
    $role_user = $row['role'];

    if ($role_user == 'biguser') {

      $_SESSION['login'] = $role_user;

      // Аутентификация прошла успешно
      $sever_mes = array( 'status' => 'server_ok', 'status_text' => 'Аутентификация прошла успешно');
      echo json_encode($sever_mes);
      return;

    }else {
      //если пользователя с введенным логином не существует
       $sever_mes = array( 'status' => 'server_error', 'status_text' => 'Логин и(или) пароль введен не верно');
       echo json_encode($sever_mes);
       return;
    }
}
?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width">

	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />

	<title>Машков Андрей | Обо мне</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<link rel="stylesheet" href="css/normalize.css" type="text/css"/>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<link rel="stylesheet" href="css/login.css" type="text/css"/>
	<link rel="stylesheet" href="css/form.css" type="text/css"/>

	<!--[if lt IE 9]>
	<script src="http://html5shiv-printshiv.googlecode.com/svn/trunk/html5shiv-printshiv.js"></script>
	<![endif]-->

</head>
<body class="body">
	<div class="wrapper">
		<section class="login">
			<div class="login_container">
				<h1 class="login_header">Авторизация</h1>

				<form id="login_form" class="login_form form" method="post" action="login.php" enctype="multipart/form-data">

					<div class="sever_mess">
						<div class="server_mess_title">response_server</div>
						<div class="server_mess_desc">text_server</div>
					</div>

					<div class="form__item">
						<label class="label_text" for="login">Логин</label>
						<input id="login" class="input_text" name="login" type="text" placeholder="Введите логин">
						<span class="tooltipstext posleft"></span>
					</div>

					<div class="form__item">
						<label class="label_text" for="password">Пароль</label>
						<input id="password" class="input_text" name="password" type="password" placeholder="Введите пароль">
						<span class="tooltipstext posleft"></span>
					</div>

					<div class="span_center">
						<button class="button button_add" type="submit" name="submit" value="submit">Войти</button>
					</div>
				</form>
			</div>
		</section>
		<div class="empty"></div>
	</div>

	<footer class="footerlog">
			<div class="copyright">
				&copy; 2016 Это мой сайт, пожалуйста, не копируйте и не воруйте его.
			</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.12.0.min.js"><\/script>');</script>
	<script src="js/jquery.placeholder.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
