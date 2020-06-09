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
		<div class="row mt-1">
			<div class="col">
				<h1 class="mt-1 text-center"><?php echo $lang["index_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["index_main_h2_text"] ?></h2>
				<p><?php echo $lang["index_main_p_text"] ?></p>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["index_main_h2_tasks"] ?></h2>
				<ul>
					<li><?php echo $lang["index_main_ul_li_1"] ?></li>
					<li><?php echo $lang["index_main_ul_li_2"] ?></li>
					<li><?php echo $lang["index_main_ul_li_3"] ?></li>
					<li><?php echo $lang["index_main_ul_li_4"] ?></li>
					<li><?php echo $lang["index_main_ul_li_5"] ?></li>
					<li><?php echo $lang["index_main_ul_li_6"] ?></li>
					<li><?php echo $lang["index_main_ul_li_7"] ?></li>
				</ul>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-md-12">
				<h2 class="display-5"><?php echo $lang["index_main_h2_task_distribution"] ?></h2>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?php echo $lang["index_main_table_head_1"] ?></th>
							<th><?php echo $lang["index_main_table_head_2"] ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $lang["index_main_table_tr_1_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_1_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_2_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_2_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_3_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_3_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_4_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_4_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_5_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_5_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_6_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_6_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_7_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_7_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_8_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_8_td_2"] ?></td>
						</tr>
						<tr>
							<td><?php echo $lang["index_main_table_tr_9_td_1"] ?></td>
							<td><?php echo $lang["index_main_table_tr_9_td_2"] ?></td>
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
		