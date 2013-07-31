<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<title>Box</title>
	</head>
	<body <?php $this->is_home() ? print 'class="background"' : print '';?>>
		<header id="main">
		</header>
		<?php echo $content;?>
		<footer class="center">
		</footer>
		<script type="text/javascript" src="<?=$this->getAssetsUrl()?>/js/common.js"></script>
	</body>
</html>