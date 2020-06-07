<?php include 'includes/language.php'; include 'includes/conn.php'; ?>

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
				<h1 class="mt-1 text-center"><?php echo $lang["statistics_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<table class="table">
					<thead>
						<tr>
							<th><?php echo $lang["statistics_table_header_1"] ?></th>
							<th><?php echo $lang["statistics_table_header_2"] ?></th>
						</tr>
					</thead>
					<tbody>
						<?php

						$query = "SELECT nazov, COUNT(*) FROM individual_tasks_use_log GROUP BY nazov";
						if($stmt = $con->prepare($query)){
							if($stmt->execute()){
								$stmt->bind_result($nazov, $count);
								$stmt->store_result();
									if($stmt->num_rows > 0){
										while ($stmt->fetch()) {
											echo '<tr>';
											echo '<td>'.$nazov.'</td>';
											echo '<td>'.$count.'</td>';
											echo '</tr>';
										}
									}
							}
						}

						?>

					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<form class="form" method="POST" action="sendmail.php">
					<div class="form-row">
						<div class="col-md-6">
							<input type="email" name="mailTo" id="email" placeholder="email" class="form-control">
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-primary btn-block"><?php echo $lang["statistics_button"] ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	


	<?php
    include 'includes/footer.php';
  ?>

		
</body>
</html>
		