<?php

if(isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] == 0){

	$project_file = $_FILES['upload_file'];

	// Создадим директорию на сервере, если её нет.
	if (!file_exists('../'.$project_dir)) {
		mkdir('../'.$project_dir, 0777);
	}

	// Закачиваем файл
	if(is_uploaded_file($project_file["tmp_name"])) {

		// Проверка формата файла
		$extension = strtolower(pathinfo($project_file['name'], PATHINFO_EXTENSION));
		$allowed = array('png', 'jpeg', 'jpg', 'gif');
		if(!in_array(strtolower($extension), $allowed)){
			echo '{"status":"server_error", "text_status":"Ваш файл не является изображением"}';
			return;
		}

		// Проверка размера файла
		if ($project_file["size"] > 1024*1024 ) {
			echo '{"status":"server_error", "text_status":"Ваш файл слишком большой (более 1Mb)"}';
			return;
		}

		// Директория для файлов проекта
		$project_dir = 'img/project_img';

		// Новое имя файла
		$new_file_name = uniqid() . '.' . $extension;

		// Полный путь куда копировать
		$final_path = "../".$project_dir."/".$new_file_name;

		// Перемещаем файл в нужную нам папку.
		if(move_uploaded_file($project_file["tmp_name"], $final_path)) {
			echo '{"status":"server_ok", "text_status":"'.$new_file_name.'"}';
			return;
		} else {
			echo '{"status":"server_error", "text_status":"Ошибка загрузки файла"}';
			return;
		}

	} else {
		echo '{"status":"server_error", "text_status":"Ошибка загрузки файла"}';
		return;
	}
}
echo '{"status":"server_error", "text_status":"Файла нет"}';
return;
