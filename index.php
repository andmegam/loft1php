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
	<link rel="stylesheet" href="css/content.css" type="text/css"/>

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
				<article class="myinfo">
					<h2 class="myinfo-header">Основная информация </h2>
					<div class="myinfo-container clearfix">
						<div class="left-data">
							<div class="pic avatar">
								<img src="img/avatar.jpg" alt="Машков Андрей"  ></div>
						</div>
						<div class="right-data">
							<ul class="info">
								<li class="myinfo-data-item clearfix">
									<div class="info-item-title">Меня зовут:</div>
									<div class="info-item-desc">Машков Андрей Александрович</div>
								</li>
								<li class="myinfo-data-item clearfix">
									<div class="info-item-title">Мой возраст:</div>
									<div class="info-item-desc">32 года</div>
								</li>
								<li class="myinfo-data-item clearfix">
									<div class="info-item-title">Мой город:</div>
									<div class="info-item-desc">Саратов, Россия</div>
								</li>
								<li class="myinfo-data-item clearfix">
									<div class="info-item-title">Моя специализация:</div>
									<div class="info-item-desc">FRONTEND разработчик</div>
								</li>
								<li class="myinfo-data-item clearfix">
									<div class="info-item-title">Ключевые навыки:</div>
									<span class="skillsblock">
										<span class="skill">html</span>
										<span class="skill">css</span>
										<span class="skill">javascript</span>
										<span class="skill">gulp</span>
										<span class="skill">git</span>
										<span class="skill">jquery</span>
									</span>
								</li>
							</ul>
						</div>
					</div>
				</article>
				<article class="myinfo">
					<h2 class="myinfo-header">Опыт работы</h2>
					<div class="myinfo-container">
						<div class="row rabota">
							<h3 class="row-first">ООО "Фармнет" - Руководитель отдела обработки информации</h3>
							<h2 class="row-second">Июнь 2006 - по настоящее время</h2>
						</div>
						<div class="row rabota">
							<h3 class="row-first">ОАО АКБ "Пробизнесбанк" - Программист-разработчик SQL</h3>
							<h2 class="row-second">Март 2010 - Август 2010</h2>
						</div>
					</div>
				</article>

				<article class="myinfo">
					<h2 class="myinfo-header">Образование</h2>
					<div class="myinfo-container">
						<div class="row vuz">
							<h3 class="row-first">Высшее - СГУ имени Н. Г. Чернышевского (г. Саратов)</h3>
							<h2 class="row-second">Сентябрь 2001 - Май 2006</h2>
						</div>
						<div class="row course">
							<h3 class="row-first">
								Курс от Академии Лидогенерации по специальности "Лид-Менеджер
							</h3>
							<h2 class="row-second">
								Январь 2015 - Март 2015
								(
								<a href="http://lead-academy.ru/certificates/c/foO1GVvMs3fd"
								target="_blank">сертификат</a>
								)
							</h2>
						</div>
					</div>
				</article>
			</section>
		</main>
		<div class="empty"></div>
	</div>

	<?php require_once("php/html_footer.php");?>

</body>
</html>
