<?php
include('config/cek.php');
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Cryptografi Mail</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="Asset/home/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom Theme files -->
	<link href="Asset/home/css/style.css" rel='stylesheet' type='text/css' />
	<link href="Asset/home/css/font-awesome.css" rel="stylesheet">

	<script src="Asset/home/js/jquery.min.js"> </script>
	<script src="Asset/home/js/bootstrap.min.js"> </script>

	<!-- Scroll menu scripts -->
	<script src="Asset/home/js/jquery.metisMenu.js"></script>
	<script src="Asset/home/js/jquery.slimscroll.min.js"></script>
	<!-- Custom and plugin javascript -->
	<link href="Asset/home/css/custom.css" rel="stylesheet">
	<script src="Asset/home/js/custom.js"></script>
	<!-- show pass-->
	<script src="Asset/jsform/pass.js"></script>

	<link rel="icon" type="image/png" sizes="16x16" href="Asset/home/images/logo1.png">
</head>

<body>
	<div id="wrapper">
		<!----->
		<nav class="navbar-default navbar-static-top" role="navigation">
			<div class="navbar-header">
				<!--Tombol untuk resvonsive hp-->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">icon</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!--tulisan side bartop-->
				<h1> <a class="navbar-brand" href="index.php">CryptoMail</a></h1>
			</div>
			<div class="full-left">
				<?php
				$day = date("D");
				switch ($day) {
					case 'Sun':
						$hari = "Minggu";
						break;
					case 'Mon':
						$hari = "Senin";
						break;
					case 'Tue':
						$hari = "Selasa";
						break;
					case 'Wed':
						$hari = "Rabu";
						break;
					case 'Thu':
						$hari = "Kamis";
						break;
					case 'Fri':
						$hari = "Jum'at";
						break;
					case 'Sat':
						$hari = "Sabtu";
						break;
					default:
						$hari = "Ingatkan hari ini..";
				}
				// default zona time 
				date_default_timezone_set('Asia/Jakarta');
				// cetak hari 
				$tanggal = date("d M Y");
				echo "
					<a href='index.php'>
					<span>
					<span class='teal-text'>$hari, </span>$tanggal</span>
					<span id='clock'></span>
					</a>
					"; ?>
			</div>
			<div class=" border-bottom">


				<!-- navtop links, forms, and other content for toggling -->
				<div class="drop-men">
					<ul class=" nav_1">
						<!--notif-->
						<!--
						<li class="dropdown at-drop">
							<a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i class="fa fa-globe"></i> <span class="number">5</span></a>
							<ul class="dropdown-menu menu1 " role="menu">
								<li><a href="#">
										<div class="user-new">
											<p>isan.mh69@gmail.com</p>
											<span>40 seconds ago</span>
										</div>
										<div class="user-new-left">

											<i class="fa fa-user-plus"></i>
										</div>
										<div class="clearfix"> </div>
									</a>
								</li>
								<li><a href="#">
										<div class="user-new">
											<p>Tugas Akhir Ihsan Miftahul Huda</p>
											<span>3 minutes ago</span>
										</div>
										<div class="user-new-left">

											<i class="fa fa-heart"></i>
										</div>
										<div class="clearfix"> </div>
									</a>
								</li>
								<li><a href="#" class="view">View all messages</a></li>
							</ul>
						</li>
						-->
						<!--logout-->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown">
								<span class=" name-caret"><?php echo $_SESSION['email']; ?>
									<i class="caret"></i></span>
								<img size="40px" src="Asset/home/images/user1.png">

							</a>
							<ul class="dropdown-menu " role="menu">
								<li><a href=<?php echo "?page=inbox"; ?>><i class="fa fa-envelope"></i>Inbox</a></li>
								<li><a href="logout.php"><i class="fa fa-clipboard"></i>Logout</a></li>
							</ul>
						</li>

					</ul>
				</div>
				<!-- /.navbar-collapse -->


				<div class="clearfix">

				</div>

				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">

							<li>
								<a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-home nav_icon"></i><span class="nav-label">Home</span> </a>
							</li>
							<li>
								<a href=<?php echo "?page=tulis"; ?> class=" hvr-bounce-to-right"><i class="fa fa-envelope nav_icon"></i> <span class="nav-label">Kirim Pesan</span> </a>
							</li>
							<li>
								<a href=<?php echo "?page=inbox"; ?> class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Kontak Masuk</span> </a>
							</li>
							<!--
							<li>
								<a href="#" class=" hvr-bounce-to-right"><i class="fa fa-key nav_icon"></i> <span class="nav-label">Kriptografi</span><span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="#" class=" hvr-bounce-to-right"> <i class="fa fa-lock nav_icon"></i>Enkripsi</a></li>
									<li><a href="#" class=" hvr-bounce-to-right"><i class="fa fa-unlock nav_icon"></i>Dekripsi</a></li>
								</ul>
							</li>
							-->
							<li>
								<a href=<?php echo "?page=panduan"; ?> class=" hvr-bounce-to-right"><i class="fa fa-question-circle nav_icon"></i> <span class="nav-label">Panduan</span> </a>
							</li>
							<li>
								<a href=<?php echo "?page=tentang"; ?> class=" hvr-bounce-to-right"><i class="fa fa-info-circle nav_icon"></i> <span class="nav-label">Tentang</span> </a>
							</li>
						</ul>
					</div>
				</div>
		</nav>

		<!--isi Content -->
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="content-main">

				<!--Isi Content-->
				<?php
				error_reporting(0);

				$page = $_GET['page'];
				if ($page) {
					include "$page" . ".php";
				} else {
					include "home.php";
				}
				?>


				<!---->
				<div class="copy">
					<p> &copy; 2019 Cryptografi Email | by <a href="" target="_blank">Ihsan Miftahul Huda</a> </p>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>

	<script src="Asset/ckeditor/ckeditor.js"></script>

</body>



</html>