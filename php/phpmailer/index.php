<?php
/**
	Тестирование отправки письма с реального сервера
*/
	function smtpmail($to, $subject, $content, $attach=false)
	{
        require_once('config.php');
        require_once('class.phpmailer.php');
        $mail = new PHPMailer(true);


        $mail->IsSMTP();

        //echo $to."<br />".$subject."<br />".$content."<br />";


          $mail->Host       = $__smtp['host'];
          $mail->SMTPDebug  = $__smtp['debug'];
          $mail->SMTPAuth   = $__smtp['auth'];
          $mail->Host       = $__smtp['host'];
          $mail->Port       = $__smtp['port'];
          $mail->Username   = $__smtp['username'];
          $mail->Password   = $__smtp['password'];

		  //$mail->SetFrom($__smtp['addreply'], $__smtp['username']);
		  $mail->SetFrom($__smtp['addreply'], 'www.ori-list.ru'); // Имя отправителя

		  $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
          $mail->AddAddress($to);

          $mail->Subject = htmlspecialchars($subject);
          //$mail->CharSet='cp1251'; //кодировка письма
          $mail->CharSet='utf-8'; //кодировка письма

          $mail->MsgHTML($content);
          if($attach)  $mail->AddAttachment($attach);
          $mail->Send();
         // echo "Message sent Ok!</p>\n";

	}
	if($_POST['msgsent']!=1 || empty($_POST['to']) ||  empty($_POST['subject']) || empty($_POST['content']))
	{
?>
		<form action = "index.php" method = "POST">
		<input type = "hidden" name = "msgsent" value = "1" />
		TO:			<input type = "text" name = "to" value = "mag-biz@yandex.ru" /><br />
		SUBJECT:	<input type = "text" name = "subject" value = "Тема Письма" /><br />
		MESSAGE:<br />
					<textarea cols = "40" rows = "5" name = "content">Собака Сутулая </textarea><br />
		<input type = "submit" value = "submit" />
		</form>
<?php
	}else{
		smtpmail($_POST['to'], $_POST['subject'], $_POST['content']);
	}
?>
