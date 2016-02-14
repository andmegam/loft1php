<?php

if (isset($_POST['formdata'])) {

	parse_str($_POST['formdata'], $params);

	$project_name = strip_tags(htmlspecialchars(trim($params['project_name'])));
	$project_url = strip_tags(htmlspecialchars(trim($params['project_url'])));
	$project_desc = strip_tags(htmlspecialchars(trim($params['project_desc'])));
	$project_img = strip_tags(htmlspecialchars(trim($params['project_img'])));
}

if (!empty($project_name) && !empty($project_url) && !empty($project_desc) && !empty($project_img) ){

	// Подключение к БД
	require_once("config_app.php");

	$path_file = "img/project_img/".$project_img;

	// Запись в БД
	$sql = "INSERT INTO projects (projectname,projecturl,projectdesc, projectimg)
	VALUES ('".$project_name."','".$project_url."' ,'".$project_desc."','".$path_file."');";
	$result = mysqli_query($mysqli,$sql) or die(mysqli_error()) ;

	// HTML нового блока

	$project_new ='
		<div class="project">
			<div class="hover-img">
				<img src="'.$path_file.'" alt="'.$project_name.'" class="project-img">
				<div class="zoom-wrapper">
					<a href="'.$project_url.'" target="_blank" class="zoom-link">'.$project_name.'</a>
				</div>
			</div>
			<div class="project-link">
				<a href="'.$project_url.'">'.$project_url.'</a>
			</div>
			<div class="project_descr">'.$project_desc.'</div>
		</div>';


	if($result) {
		$sever_mes = array( 'status' => 'server_ok',
							'status_text' => 'Проект успешно добавлен',
							'project_new' => $project_new);
		echo json_encode($sever_mes);
		return;
	}else {
		$sever_mes = array( 'status' => 'server_error', 'status_text' => 'Ошибка загрузки в базу данных');
		echo json_encode($sever_mes);
		return;
	}
}else {

	$sever_mes = array( 'status' => 'server_error', 'status_text' => 'Не хватает данных');
	echo json_encode($sever_mes);
	return;
}
?>
