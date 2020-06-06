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
				<h1 class="mt-1 text-center"><?php echo $lang["blahoandras_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form class="form">
					<div class="form-row mt-3">
						<div class="col-md-6">
							<label for="novaPoziciaInput">Nový náklon lietadla</label>
							<input type="number" step="0.000001" name="input" id="novaPoziciaInput" class="form-control">
							<input type="number" step="0.000001" name="initAlpha" id="initAlphaInput" class="form-control" value="0" hidden>
							<input type="number" step="0.000001" name="initQ" id="initQInput" class="form-control" value="0" hidden>
							<input type="number" step="0.000001" name="initTheta" id="initThetaInput" class="form-control" value="0" hidden>
						</div>
						<div class="col-md-6">
							<label for="novaPoziciaBtn" style="opacity:0;">Btn</label>
							<button class="btn btn-primary btn-block" id="novaPoziciaBtn" type="button">Ukáž!</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
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
  		var counterForGraph =  0;

  		function extendGraph(naklonLietadla, naklonZadnejKlapky){
  			Plotly.extendTraces('graf1', {
				x: [[counterForGraph]],
				y: [[naklonLietadla]]
			} , [0]);

			Plotly.extendTraces('graf2', {
				x: [[counterForGraph]],
				y: [[naklonZadnejKlapky]]
			} , [0]);

			counterForGraph++;
			console.log("EXTEND");
			/*for(var j =0; j< jsonOutput.length; j++){

				setTimeout(
				  function() 
				  {
				  		var aktualnyNaklonLietadla = jsonOutput[j][0].naklon_lietadla;
						var aktualnyNaklonZadnejKlapky = jsonOutput[j][1].naklon_zadnej_klapky;

				        Plotly.extendTraces('graf1', {
						x: [[counterForGraph]],
						y: [[aktualnyNaklonLietadla]]
					} , [0]);

					Plotly.extendTraces('graf2', {
						x: [[counterForGraph]],
						y: [[aktualnyNaklonZadnejKlapky]]
					} , [0]);

					counterForGraph++;
				 }, 100);
			}*/
  		}

  		$("#novaPoziciaBtn").click(function(e){

  			var input = $("#novaPoziciaInput").val();
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

				//console.log(msg[1]);
				//console.log(formatter.format(parseFloat(msg[1].final[0].initAlpha)));
				//console.log(formatter.format(parseFloat(msg[1].final[1].initQ)));
				//console.log(formatter.format(parseFloat(msg[1].final[2].initTheta)));

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

				/*console.log(parseFloat(msg[1].final[0].initAlpha).toFixed(6));
				console.log(parseFloat(msg[1].final[1].initQ).round(3));
				$("#initAlphaInput").val(msg[1].final[0].initAlpha);
				$("#initQInput").val(parseFloat(msg[1].final[1].initQ).toFixed(6));
				$("#initThetaInput").val(msg[1].final[2].initTheta);*/

				for(var i =0; i< msg[0].data.length; i++){
					(function(index) {
	        			setTimeout(function() { 
	        				//console.log(index);
	        				//console.log(msg[0].data[index]);
	        				var aktualnyNaklonLietadla = msg[0].data[index][0].naklon_lietadla;
							var aktualnyNaklonZadnejKlapky = msg[0].data[index][1].naklon_zadnej_klapky;
					    	extendGraph(aktualnyNaklonLietadla,aktualnyNaklonZadnejKlapky);
	        			}, index*1);
    				})(i,msg);
				}
			}
			});
  		});

  		var layoutGraf1 = {
		  title:'Graf1Title'
		};

		var layoutGraf2 = {
		  title:'Graf2Title'
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

	});

  </script>

		
</body>
</html>
		