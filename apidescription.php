<?php include 'includes/language.php'; ?>

<!DOCTYPE HTML>

<html>
<head>
  <?php
  	include 'includes/definitions.php';
  ?>
</head>
<body>
	<header>
		<?php
			include 'includes/navbar.php';
		?>
	</header>


	
	<div class="container mt-4 mb-4 mainContainer">
		<div class="row">
			<div class="col">
				<h1 class="mt-1 text-center"><?php echo $lang["apidescription_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["index_main_h2_text"] ?></h2>
				<p><?php echo $lang["index_main_p_text"] ?></p>
			</div>
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["index_main_h2_text"] ?></h2>
				<p><?php echo $lang["index_main_p_text"] ?></p>
			</div>
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["index_main_h2_text"] ?></h2>
				<p><?php echo $lang["index_main_p_text"] ?></p>
			</div>
		</div>	
	</div>	


	<?php
    include 'includes/footer.php';
  ?>

		
</body>
</html>
		