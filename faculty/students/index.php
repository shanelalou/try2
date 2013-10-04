<?php include '../../config.php';?>
<?php
	if(!isset($_SESSION['faculty'])){
		header("location: ../");
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Template</title>
	<link rel="stylesheet" type="text/css" href="../../source/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../../source/styles/ui-lightness/jquery-ui-1.8.23.custom.css">
	<script type="text/javascript" src="../../source/scripts/js.js"></script>
	<script type="text/javascript" src="../../source/scripts/ui.js"></script>
</head>
<body>

	<div class="head">
		<div class="wraper">
			<div class="head-logo"></div>
			<div class="head-label">
				<div class="center" style="font-size:18px">COLLEGE OF COMPUTER STUDIES</div>
				<div class="center" style="font-size:15px">COURSE ENLISTMENT</div>
			</div>
			<div class="menu">
				<ul>
					<li><a href="../classes">CLASS LOADS</a></li>
					<li><a href="../enlistment">ENLISTMENT</a></li>
					<li><a href="">LOGOUT</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="wraper">
			<div class="right" style="font-size:15px"><a href="../profile"><?php echo faculty($_SESSION['faculty'],"code")." - ".faculty($_SESSION['faculty'],"lastname").", ".faculty($_SESSION['faculty'],"firstname")." ".faculty($_SESSION['faculty'],"middlename"); ?></a></div>
		</div>
	</div>

	<div class="page-content">
		<div class="wraper">

		</div>
	</div>
</body>
</html>