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
		<link rel="stylesheet" type="text/css" href="css/szaboovaklaudia.css">
	</header>


	
	<div class="container mt-4 mb-4 mainContainer">
		<div class="row">
			<div class="col">
				<h1 class="mt-1 text-center"><?php echo $lang["szaboovaklaudia_main_h1_text"] ?></h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form class="form">
					<div class="form-row">
						<div class="col-md-4">
							<input type="number" name="" step="0.000001" id="pozadovanavyska" placeholder="<?php echo $lang['szaboovaklaudia_input'] ?>" class="form-control">
						</div>
						<div class="col-md-3">
							<button class="btn btn-dark" id="vypocitat" type="button"><?php echo $lang["szaboovaklaudia_button"] ?></button>
						</div>
						<div class="col-md-2">
							<span class="spandisp"><?php echo $lang["szaboovaklaudia_check_1"] ?></span>
							<input type="checkbox" name="ukazgraf" class="ukaz" id="ukazgraf" checked="checked">
						</div>
						<div class="col-md-3">
							<span class="spandisp"><?php echo $lang["szaboovaklaudia_check_2"] ?></span>
							<input type="checkbox" name="ukazanimaciu" class="ukaz" id="ukazanimaciu" checked="checked">
						</div>
					</div>
					<input type="number" name="" step="0.000001" id="x1" value="0" hidden>
					<input type="number" name="" step="0.000001" id="x1d" value="0" hidden>
					<input type="number" name="" step="0.000001" id="x2" value="0" hidden>
					<input type="number" name="" step="0.000001" id="x2d" value="0" hidden>
				</form>
			</div>
		</div>	
		<div class="row d-none" id="wronginputdiv">
			<div class="col">
				<p class="text-danger display-4 text-center"><?php echo $lang["szaboovaklaudia_error"] ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="vozidlograf"></div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<canvas id="animacia" width="900" height="600"></canvas>
			</div>
		</div>
		<div class="row d-none">
			<img src="images/szaboovaklaudia_car.png" id="auto">
			<img src="images/szaboovaklaudia_car_front_wheel.png" id="kolesopredny">
			<img src="images/szaboovaklaudia_car_rear_wheel.png" id="kolesozadny">
		</div>
	</div>	


	<?php
    include 'includes/footer.php';
  ?>

  <script type="text/javascript">
  	$( document ).ready(function() {
  		var graflayout = {
		  title:''
		};

		var trace1 = {
			x: [],
			y: [],
			mode: 'line',
			name: '<?php echo $lang["szaboovaklaudia_graf_label_1"] ?>'
		};

		var trace2 = {
			x: [],
			y: [],
			mode: 'line',
			name: '<?php echo $lang["szaboovaklaudia_graf_label_2"] ?>'
		};

		var grafdata = [trace1, trace2];

		Plotly.newPlot('vozidlograf', grafdata, graflayout);

		var grafx =  0;

  		function kresli(x1, x3){
  			Plotly.extendTraces('vozidlograf', {
				x: [[grafx]],
				y: [[x1]]
			} , [0]);

			Plotly.extendTraces('vozidlograf', {
				x: [[grafx]],
				y: [[x3]]
			} , [1]);

			grafx++;

  		}

  		var lastX1 = 0;
  		var lastX3 = 0;

  		function animate(x1, x3){

  			var toAnimateX1 = 0;
  			var toAnimateX3 = 0;

  			var animaciaSizeKonstanta = 1000;
  			/*if(x1 < 0){

  				x1 = x1*(-1);

  				if(lastX1<x1){
  					toAnimateX1 = "+="+x1*animaciaSizeKonstanta;
	  			}
	  			else{
	  				toAnimateX1 = "-="+x1*animaciaSizeKonstanta;
	  			}
  			}
  			else{
  				if(lastX1<x1){

  					toAnimateX1 = "-="+x1*animaciaSizeKonstanta;
	  			}
	  			else{
	  				toAnimateX1 = "+="+x1*animaciaSizeKonstanta;
	  			}
  			}

  			if(x3 < 0){

  				x3 = x3*(-1);

  				if(lastX3<x3){
  					toAnimateX3 = "+="+x3*animaciaSizeKonstanta;
	  			}
	  			else{
	  				toAnimateX3 = "-="+x3*animaciaSizeKonstanta;
	  			}
  			}
  			else{
  				if(lastX3<x1){
  					toAnimateX3 = "-="+x3*animaciaSizeKonstanta;
	  			}
	  			else{
	  				toAnimateX3 = "+="+x3*animaciaSizeKonstanta;
	  			}
  			}*/

  			var valX1 = lastX1 - x1;
  			var valX3 = lastX3 - x3;

  			if(valX1 < 0){
  				var val = -1*valX1*animaciaSizeKonstanta;
  				toAnimateX1 = "+="+val;
  			}
  			else{
  				var val = valX1*animaciaSizeKonstanta;
  				toAnimateX1 = "-="+val;
  			}

  			if(valX3 < 0){
  				var val = -1*valX3*animaciaSizeKonstanta;
  				toAnimateX3 = "+="+val;
  			}
  			else{
  				var val = valX3*animaciaSizeKonstanta;
  				toAnimateX3 = "-="+val;
  			}


  			autogroup.animate('top', toAnimateX3, { onChange: canvas.renderAll.bind(canvas) });
  			predneKolesoInst.animate('top', toAnimateX1, { onChange: canvas.renderAll.bind(canvas) });
  			zadneKolesoInst.animate('top', toAnimateX1, { onChange: canvas.renderAll.bind(canvas) });
  			lastX1 = x1;
  			lastX3 = x3;
  		}

  		$('#ukazgraf').change(function() {
	        if(this.checked) {
	        	$('#vozidlograf').removeClass("d-none");
	        }
	        else{
				$('#vozidlograf').addClass("d-none");
	        }      
	    });

	    $('#ukazanimaciu').change(function() {
	        if(this.checked) {
	        	$('#animacia').removeClass("d-none");
	        }
	        else{
				$('#animacia').addClass("d-none");
	        }     
	    });

		$("#vypocitat").click(function(e){
			$("#wronginputdiv").addClass("d-none");

			$.ajax({
				type: 'POST',
				url: 'logindividualtaskuse.php',
				data:{
					name: "Tlmič auta"
				},
				success: function(msg){
				}
			});

  			var input = $("#pozadovanavyska").val();
  			if(input > 0.3 || input < -0.3){
  				$("#wronginputdiv").removeClass("d-none");
  			}
  			else{
  				var x1 = $("#x1").val();
	  			var x1d = $("#x1d").val();
	  			var x2 = $("#x2").val();
	  			var x2d = $("#x2d").val();

	  			$.ajax({
				type: 'GET',
				url: 'octave_api.php?apikey=ABC&type=tlmenie&input='+input+'&initX1='+x1+'&initX1d='+x1d+'&initX2='+x2+'&initX2d='+x2d+'',
				success: function(msg){

					$("#x1").val(parseFloat(msg[1].final[0].initX1));
	  				$("#x1d").val(parseFloat(msg[1].final[1].initX1d));
	  				$("#x2").val(parseFloat(msg[1].final[2].initX2));
	  				$("#x2d").val(parseFloat(msg[1].final[3].initX2d));
					console.log($("#x1").val());
					console.log($("#x1d").val());
					console.log($("#x2").val());
					console.log($("#x2d").val());

					for(var i =0; i< msg[0].data.length; i++){
						(function(index) {
		        			setTimeout(function() { 
		        				var x1 = msg[0].data[index][0].pozicia_vozidla;
								var x3 = msg[0].data[index][1].pozicia_kolesa;
						    	kresli(x1,x3);
						    	animate(x1,x3);
		        			}, index*100);
	    				})(i,msg);
					}
				}
				});
  			}
  		});

		var canvas = new fabric.Canvas('animacia');
		var autoElem = document.getElementById('auto');
		var autoInst = new fabric.Image(autoElem,{
			left: 250,
			top: 50,
		});
		autoInst.scale(0.2);
		//canvas.add(autoInst);

		var predneKolesoElem = document.getElementById('kolesopredny');
		var predneKolesoInst = new fabric.Image(predneKolesoElem,{
			left: 250,
			top: 50,
		});
		predneKolesoInst.scale(0.2);
		//canvas.add(predneKolesoInst);

		var zadneKolesoElem = document.getElementById('kolesozadny');
		var zadneKolesoInst = new fabric.Image(zadneKolesoElem,{
			left: 250,
			top: 50,
		});
		zadneKolesoInst.scale(0.2);
		//canvas.add(zadneKolesoInst);

		var autogroup = new fabric.Group([ autoInst, predneKolesoInst, zadneKolesoInst ], {
		});
		canvas.add(autogroup);
  	});
  </script>
		
</body>
</html>
		