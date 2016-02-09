<?php
session_start();

?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=1230, initial-scale=1" />

	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />

	<title>Машков Андрей | Обо мне</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<link rel="stylesheet" href="css/normalize.css" type="text/css"/>
	<link rel="stylesheet" href="css/style.css" type="text/css"/>
	<link rel="stylesheet" href="css/contact.css" type="text/css"/>
	<link rel="stylesheet" href="css/form.css" type="text/css"/>

	<!--[if lt IE 9]>
	<script src="http://html5shiv-printshiv.googlecode.com/svn/trunk/html5shiv-printshiv.js"></script>
	<![endif]-->

</head>
<body class="body">
	<div class="wrapper">
		<?php require_once("php/html_header.php");?>

		<main class="container clearfix">
			<?php require_once("php/html_sitebar.php");?>

			<section class="content">
				<article class="mycontact">
					<h1 class="mycontact_header">У вас интересный проект? Напишите мне</h1>

					<form class="contact_form form" method="post" action="php/form_contacts.php" enctype="multipart/form-data">

						<div class="sever_mess">
							<div class="server_mess_title">response_server</div>
							<div class="server_mess_desc">text_server</div>
						</div>

						<div class="row_top clearfix">
							<div class="form__item leadname">
								<label class="label_text" for="leadname">Имя</label>
								<input id="leadname" class="input_text" name="leadname" type="text" placeholder="Как к вам обращаться">
								<span class="tooltipstext posleft"></span>
							</div>

							<div class="form__item leademail">
								<label class="label_text" for="leademail">Email</label>
								<input id="leademail" class="input_text" name="leademail" type="text" placeholder="Куда мне писать">
								<span class="tooltipstext posright"></span>
							</div>
						</div>

						<div class="form__item leadmessage">
							<label class="label_text" for="leadmessage">Сообщение</label>
							<textarea id="leadmessage" class="textarea_text" name="leadmessage" placeholder="Кратко в чем суть"></textarea>
							<span class="tooltipstext posleft"></span>
						</div>

						<div class="form__item">
							<span class="clearfix">
								<label class="label_text clearfix"  for="leadcapture">Проверочный код</label>
								<span class="capture_img">
									<img src="php/captcha.php" alt="capturecode" />
								</span>

								<span class="capture_code">
									<input id="leadcapture" class="input_text" name="leadcapture" type="text" placeholder="Введите код">
									<span class="tooltipstext posright"></span>
								</span>
							</span>
						</div>

						<div class="buttons clearfix">
							<button class="button button_send" type="submit" name="submit" value="submit">Отправить</button>
							<button class="button button_clear" type="reset" name="reset" value="clear">Очистить</button>
						</div>
					</form>
				</article>
			</section>
		</main>
		<div class="empty"></div>
	</div>

	<?php require_once("php/html_footer.php");?>

</body>
</html>
