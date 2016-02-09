<?
session_start();
require_once("php/config_app.php");

// Вывод на страницу всех проекты из портфолио
$sql = "SELECT
				projectid, projectname, projecturl, projectdesc,  projectimg, dateinsert
		  FROM
		  		projects
	  ORDER BY
	  			dateinsert desc";
$result = mysqli_query ($mysqli, $sql);
$project_list = "";

while ($res = mysqli_fetch_array($result)) {

	$project_list .='
		<div class="project">
			<div class="hover-img">
				<img src="'.$res["projectimg"].'" alt="'.$res["projectname"].'" class="project-img">
				<div class="zoom-wrapper">
					<a href="'.$res["projecturl"].'" target="_blank" class="zoom-link">'.$res["projectname"].'</a>
				</div>
			</div>
			<div class="project-link">
				<a href="'.$res["projecturl"].'">'.$res["projecturl"].'</a>
			</div>
			<div class="project_descr">'.$res["projectdesc"].'</div>
		</div>
	';
}

// Кнопка добавления проекта
$button_add_project = "";
if (isset($_SESSION['login'])) {

	$button_add_project = '
		<div class="project newproject" id="link_popup_show">
			<i class="icon sprite-addproject">Иконка: добавление проекта</i>
			<div class="addproject">Добавить проект</div>
		</div>';
}

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
	<link rel="stylesheet" href="css/myworks.css" type="text/css"/>
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
				<article class="myinfo">
					<h1 class="myinfo-header">Мои работы</h1>
					<div class="myinfo-container works">

							<?php echo $project_list. $button_add_project; ?>

					</div>
				</article>
			</section>
		</main>

		<div class="empty"></div>
	</div>

	<div class="popup__overlay">
		<div class="popup">
			<form id="popup_form" class="form" method="post" action="php/form_add_project.php" enctype="multipart/form-data">
				<div class="popup_header clearfix">
					<div class="text">Добавление проекта</div>
					<div class="close">
						<div class="close_img" id="icon_popup_close">Закрыть</div>
					</div>
				</div>
				<div class="popup_body">
					<div class="sever_mess">
						<div class="server_mess_title">response_server</div>
						<div class="server_mess_desc">text_server</div>
					</div>

					<div class="form__item">
						<label class="label_text" for="project_name">Название проекта</label>
						<input id="project_name" class="input_text"  type="text" name="project_name" placeholder="Введите название">
						<span class="tooltipstext posleft"></span>
					</div>

					<div class="form__item">
						<label class="label_text" for="unload_file">Картинка проекта</label>
						<label class="label_unload_file" for="unload_file">
							<span class="unload_paht_file">Загрузите изображение</span>
							<span class="label_unload_file_img">icon-unload_file</span>
							<input id="unload_file" class="unload_file" multiple="multiple" name="project_file" type="file" ></label>
						<span class="tooltipstext posleft"></span>
					</div>

					<div class="form__item">
						<label class="label_text" for="project_url">URL проекта</label>
						<input id="project_url" class="input_text" type="text" name="project_url" placeholder="Добавьте ссылку">
						<span class="tooltipstext posleft"></span>
					</div>

					<div class="form__item">
						<label class="label_text" for="project_desc">Описание</label>
						<textarea id="project_desc" class="textarea_text" name="project_desc"
						placeholder="Пару слов о вашем проекте"></textarea>
						<span class="tooltipstext posleft"></span>
					</div>

					<div class="span_center">
						<button class="button button_add" id="button_add" name="submit" type="submit" value="submit">Добавить</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<?php require_once("php/html_footer.php");?></body>
</html>
