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
				<h2 class="display-5"><?php echo $lang["apidescription_main_h2_text"] ?></h2>
				<p><?php echo $lang["apidescription_main_p_text"] ?></p>
			</div>
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["apidescription_table_h2_text"] ?></h2>
			</div>
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?php echo $lang["apidescription_table_head_1"] ?></th>
							<th><?php echo $lang["apidescription_table_head_2"] ?></th>
							<th><?php echo $lang["apidescription_table_head_3"] ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $lang["apidescription_table_tr_1_td_1"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_1_td_2"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_1_td_3"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["apidescription_table_tr_2_td_1"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_2_td_2"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_2_td_3"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["apidescription_table_tr_3_td_1"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_3_td_2"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_3_td_3"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["apidescription_table_tr_4_td_1"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_4_td_2"] ?></td>
							<td><?php echo $lang["apidescription_table_tr_4_td_3"] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>	
	</div>	


	<?php
    include 'includes/footer.php';
  ?>

		
</body>
</html>
		