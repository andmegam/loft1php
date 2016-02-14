<?php

if(isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] == 0){

	$project_file = $_FILES['upload_file'];
	// Директория для файлов проекта
	$project_dir = 'img/project_img';

	// Создадим директорию на сервере, если её нет.
	if (!file_exists('../'.$project_dir)) {
		mkdir('../'.$project_dir, 0777);
	}

	// Закачиваем файл
	if(is_uploaded_file($project_file["tmp_name"])) {

		// Подготавливаем файл проекта
		$extension = strtolower(pathinfo($project_file['name'], PATHINFO_EXTENSION));
		$new_file_name = uniqid() . '.' . $extension;

		// Полный путь куда копировать
		//$final_path = $_SERVER['DOCUMENT_ROOT']."/".$project_dir."/".$new_file_name;
		$final_path = "../".$project_dir."/".$new_file_name;

		// Перемещаем файл в нужную нам папку.
		if(move_uploaded_file($project_file["tmp_name"], $final_path)) {
			$sever_mes = array( 'status' => 'server_ok', 'new_file_name' => $new_file_name);
			echo json_encode($sever_mes);
			return;
		} else {
			$sever_mes = array( 'status' => 'server_error', 'new_file_name' => $new_file_name);
			echo json_encode($sever_mes);
			return;
		}


	} else {
		echo '{"status":"error"}';
		return;
	}
}

echo '{"status":"error"}';
return;
