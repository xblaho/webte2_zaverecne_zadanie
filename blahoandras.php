<?php include 'includes/language.php'; ?>

<!DOCTYPE HTML>

<html>
<head>
  <?php
  	include 'includes/definitions.php';
  ?>
  <link rel="stylesheet" type="text/css" href="css/blahoandras.css">
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
				<h1 class="mt-1 text-center"><?php echo $lang["blahoandras_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form class="form">
					<div class="form-row mt-3">
						<div class="col-md-6">
							<label for="novaPoziciaInput"><?php echo $lang["blahoandras_input_value_label"] ?></label>
							<input type="number" step="0.000001" name="input" id="novaPoziciaInput" class="form-control">
							<input type="number" step="0.000001" name="initAlpha" id="initAlphaInput" class="form-control" value="0" hidden>
							<input type="number" step="0.000001" name="initQ" id="initQInput" class="form-control" value="0" hidden>
							<input type="number" step="0.000001" name="initTheta" id="initThetaInput" class="form-control" value="0" hidden>
						</div>
						<div class="col-md-6">
							<label for="novaPoziciaBtn" style="opacity:0;">Btn</label>
							<button class="btn btn-primary btn-block" id="novaPoziciaBtn" type="button"><?php echo $lang["blahoandras_button_label"] ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="grafCheckbox" class="checkboxLabel"><?php echo $lang["blahoandras_checkbox_graf_label"] ?></label>
			</div>
			<div class="col-md-1">
				<input type="checkbox" name="grafCheckbox" id="grafCheckbox" class="form-control" checked="checked">
			</div>
			<div class="col-md-2">
				<label for="animCheckbox" class="checkboxLabel"><?php echo $lang["blahoandras_checkbox_animation_label"] ?></label>
			</div>
			<div class="col-md-1">
				<input type="checkbox" name="animCheckbox" id="animCheckbox" class="form-control" checked="checked">
			</div>
		</div>
		<div class="row" id="airplaneRowDiv">
			<div class="col-10 offset-1 col-lg-8 offset-lg-2 div-wrapper d-flex justify-content-center align-items-center">
				<canvas height="500" width="800" id="animCanvas"></canvas>
				<img src="images/blahoandras_airplane.png" id="airplane" hidden>
				<img src="images/blahoandras_airplane_winglet.png" id="airplaneWinglet" hidden>
			</div>
		</div>
		<div class="row" id="grafRowDiv">
			<div class="col-md-6">
				<div id="graf1"></div>
			</div>
			<div class="col-md-6">
				<div id="graf2"></div>
			</div>
		</div>
	</div>	


	<?php
    include 'includes/footer.php';
  ?>

  <script>

  	$( document ).ready(function() {

  		// CANVAS (FABRIC) START
  		var canvas = new fabric.Canvas('animCanvas');
  		var airplaneElement = document.getElementById('airplane');
		var airplaneInstance = new fabric.Image(airplaneElement, {
		  left: 100,
		  top: 150,
		  angle: 0,
		  opacity: 1,
		});
		airplaneInstance.scale(0.5);
		//canvas.add(airplaneInstance);

		var airplaneWingletElement = document.getElementById('airplaneWinglet');
		var airplaneWingletInstance = new fabric.Image(airplaneWingletElement, {
		  left: 110,
		  top: 235,
		  angle: 0,
		  opacity: 1,
		  centeredRotation: true
		});
		airplaneWingletInstance.scale(0.5);
		//canvas.add(airplaneWingletInstance);


		var group = new fabric.Group([ airplaneInstance, airplaneWingletInstance ], {
		});
		canvas.add(group);

  		function radians_to_degrees(radians)
		{
		  var pi = Math.PI;
		  return radians * (180/pi);
		}

		//CANVAS FABRIC STOP

		// EXTEND GRAPH AND ANIMATE FUNCTION START
		var counterForGraph =  0;
  		function extendGraphAndAnimate(naklonLietadla, naklonZadnejKlapky){
  			Plotly.extendTraces('graf1', {
				x: [[counterForGraph]],
				y: [[naklonLietadla]]
			} , [0]);

			Plotly.extendTraces('graf2', {
				x: [[counterForGraph]],
				y: [[naklonZadnejKlapky]]
			} , [0]);

			var radToTurnLietadlo = radians_to_degrees(naklonLietadla)*-1;
			var radToTurnLietadloZadnaKlapka = radians_to_degrees(naklonZadnejKlapky)*-1;

			group.animate('angle', radToTurnLietadlo, { onChange: canvas.renderAll.bind(canvas) });
			airplaneWingletInstance.animate('angle', radToTurnLietadloZadnaKlapka, { onChange: canvas.renderAll.bind(canvas) });
			counterForGraph++;

  		}
  		// EXTEND GRAPH AND ANIMATE FUNCTION STOP

  		// NEW POSITION EVENT START
  		$("#novaPoziciaBtn").click(function(e){

  			var input = $("#novaPoziciaInput").val();

  			if(input < 0 || input > 0.8){
  				alert("Zlý input! (input musí byť medzi 0 a 0.8");
  			}
  			else{

  				var initAlpha = $("#initAlphaInput").val();
  				var initQ = $("#initQInput").val();
  				var initTheta = $("#initThetaInput").val();
  				
  				$.ajax({
				type: 'GET',
				url: 'octave_api.php?apikey=ABC&type=lietadlo&input='+input+'&initAlpha='+initAlpha+'&initQ='+initQ+'&initTheta='+initTheta+'',
				success: function(msg){

					const formatter = new Intl.NumberFormat('en-US', {
					   minimumFractionDigits: 0,      
					   maximumFractionDigits: 6,
					});

					var newAlpha = formatter.format(parseFloat(msg[1].final[0].initAlpha));
					var newQ = formatter.format(parseFloat(msg[1].final[1].initQ));
					var newTheta = formatter.format(parseFloat(msg[1].final[2].initTheta));

					if(newAlpha < 0){
						newAlpha = newAlpha * -1;
					}
					if(newQ < 0){
						newQ = newQ * -1;
					}
					if(newTheta <0){
						newTheta = newTheta * -1;
					}

					$("#initAlphaInput").val(newAlpha);
					$("#initQInput").val(newQ);
					$("#initThetaInput").val(newTheta);
					console.log($("#initAlphaInput").val());
					console.log($("#initQInput").val());
					console.log($("#initThetaInput").val());

					for(var i =0; i< msg[0].data.length; i++){
						(function(index) {
		        			setTimeout(function() { 
		        				var aktualnyNaklonLietadla = msg[0].data[index][0].naklon_lietadla;
								var aktualnyNaklonZadnejKlapky = msg[0].data[index][1].naklon_zadnej_klapky;
						    	extendGraphAndAnimate(aktualnyNaklonLietadla,aktualnyNaklonZadnejKlapky);
		        			}, index*100);
	    				})(i,msg);
					}
				}
				});
  			}
  		});
  		// NEW POSITION EVENT STOP

  		// INIT PLOTLY GRAPH START
  		var layoutGraf1 = {
		  title:'<?php echo $lang["blahoandras_graf_1_label"] ?>'
		};

		var layoutGraf2 = {
		  title:'<?php echo $lang["blahoandras_graf_2_label"] ?>'
		};

		var traceGraf1 = {
			x: [],
			y: [],
			mode: 'line',
			name: 'Graf1Trace1Name'
		};

		var traceGraf2 = {
			x: [],
			y: [],
			mode: 'line',
			name: 'Graf2Trace2Name'
		};

		var dataGraf1 = [traceGraf1];
		var dataGraf2 = [traceGraf2];

		Plotly.newPlot('graf1', dataGraf1, layoutGraf1);
		Plotly.newPlot('graf2', dataGraf2, layoutGraf2);
		// INIT PLOTLY GRAPH STOP

		//CHECKBOX FOR GRAPH AND ANIM START
		$('#grafCheckbox').change(function() {
	        if(this.checked) {
	        	$('#grafRowDiv').removeClass("d-none");
	        }
	        else{
				$('#grafRowDiv').addClass("d-none");
	        }      
	    });

	    $('#animCheckbox').change(function() {
	        if(this.checked) {
	        	$('#airplaneRowDiv').removeClass("d-none");
	        }
	        else{
				$('#airplaneRowDiv').addClass("d-none");
	        }     
	    });
		//CHECKBOX FOR GRAPH AND ANIM STOP

	});

  </script>

		
</body>
</html>
		