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
				<h1 class="mt-1 text-center"><?php echo $lang["octavecommands_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col">
				<form class="form" method="POST" action="octave_api.php?apikey=ABC&type=vlastny">
					<div class="form-row">
						<div class="col-md-6">
							<label for="input"><?php echo $lang["octavecommands_input_text"] ?></label>
							<input type="text" name="input" class="form-control" id="mainInput">
						</div>
						<div class="col-md-6">
							<label style="opacity:0;">Btn</label>
							<button type="button" class="btn btn-primary btn-block" id="calculate"><?php echo $lang["octavecommands_btn_text"]; ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>	
		<div class="row mt-4">
			<div class="col-md-6 offset-md-3 border border-primary p-3" id="borderDiv">
				<p class="text-center" id="answerParagraph"></p>
			</div>
		</div>	
	</div>	


	<?php
    include 'includes/footer.php';
  ?>

  	<script>
  		$( document ).ready(function() {

  			$("#calculate").click(function(e){
  				var inputValue =  $("#mainInput").val();
  				$.ajax({
					type: 'POST',
					url: 'octave_api.php?apikey=ABC&type=vlastny',
					data: {
						input: inputValue
					},
					success: function(msg){
						$("#answerParagraph").html("");
						$("#borderDiv").removeClass("border-danger");
						$("#borderDiv").addClass("border-primary");
						if(msg[0].data[0].response.length > 0){
							$("#answerParagraph").html(msg[0].data[0].response);
						}
						else{
							$("#borderDiv").addClass("border-danger");
							$("#borderDiv").removeClass("border-primary");
							$("#answerParagraph").html("Error");
						}
					}
				});
  			})
  			
  		});
  	</script>
</body>
</html>
		