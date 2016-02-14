<?php
if (!isset($_SESSION['login'])) {

	$lock = '<a href="login.php" class="lock-inner">Войти</a>';
}else {
	$lock = '<a href="login.php?destroy=yes" class="lock-exit">Выйти</a>';
}




?>
	<footer class="footer">
		<div class="container container-footer clearfix">
			<div class="lock">
				<?php echo $lock;?>
			</div>
			<div class="copyright">
				&copy; 2016 Это мой сайт, пожалуйста, не копируйте и не воруйте его.
			</div>

		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.12.0.min.js"><\/script>');</script>
	<script src="js/jquery.placeholder.min.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>

	<script src="js/main.js"></script>
