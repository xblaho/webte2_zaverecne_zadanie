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
	
<!--	<div class="container mt-4 mb-4 mainContainer">-->
<!--		<div class="row">-->
<!--			<div class="col">-->
<!--				<h1 class="mt-1 text-center">--><?php //echo $lang["datnguyenthe_main_h1_text"] ?><!--</h1>-->
<!--				<hr>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row">-->
<!--			<div class="col-md-12">-->
<!--				<h2 class="display-5">--><?php //echo $lang["index_main_h2_text"] ?><!--</h2>-->
<!--				<p>--><?php //echo $lang["index_main_p_text"] ?><!--</p>-->
<!--			</div>-->
<!--			<div class="col-md-12">-->
<!--				<h2 class="display-5">--><?php //echo $lang["index_main_h2_text"] ?><!--</h2>-->
<!--				<p>--><?php //echo $lang["index_main_p_text"] ?><!--</p>-->
<!--			</div>-->
<!--			<div class="col-md-12">-->
<!--				<h2 class="display-5">--><?php //echo $lang["index_main_h2_text"] ?><!--</h2>-->
<!--				<p>--><?php //echo $lang["index_main_p_text"] ?><!--</p>-->
<!--			</div>-->
<!--		</div>	-->
<!--	</div>	-->


    <div class="container mt-4 mb-4 mainContainer">
        <div class="row">
            <div class="col">
                <h1 class="mt-1 text-center"><?php echo $lang["datnguyenthe_main_h1_text"] ?></h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="form">
                    <div class="form-row">
                        <div class="col-md-4">
                            <input type="number" name="" step="0.000001" id="pozadovanavyska" placeholder="<?php echo $lang['datnguyenthe_input_placeholder'] = 'požadovaná nová poloha kyvadla'; ?>" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-dark" id="vypocitat" type="button"><?php echo $lang["datnguyenthe_submit_button"]; ?></button>
                        </div>
                        <div class="col-md-2">
                            <span class="spandisp"><?php echo $lang["szaboovaklaudia_checkbox_graph"]; ?></span>
                            <input type="checkbox" name="ukazgraf" class="ukaz" id="ukazgraf" checked="checked">
                        </div>
                        <div class="col-md-3">
                            <span class="spandisp"><?php echo $lang["szaboovaklaudia_checkbox_animation"]; ?></span>
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
                <div id="graph"></div>
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

    <script>
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

        var graflayout = {
            title:'Pendulum'
        };

        var trace1 = {
            x: [],
            y: [],
            mode: 'line',
            name: '<?php echo $lang["datnguyenthe_graph_trace1"] ?>'
        };

        var trace2 = {
            x: [],
            y: [],
            mode: 'line',
            name: '<?php echo $lang["datnguyenthe_graph_trace2"] ?>'
        };

        var grafdata = [trace1, trace2];

        Plotly.newPlot('graph', grafdata, graflayout);
    </script>
		
</body>
</html>
		