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
                            <input type="number" id="user_input" placeholder="<?php echo $lang['datnguyenthe_input_placeholder'] = 'požadovaná nová poloha kyvadla'; ?>" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-dark" id="submit" type="button"><?php echo $lang["datnguyenthe_submit_button"]; ?></button>
                        </div>
                        <div class="col-md-2">
                            <span class="spandisp"><?php echo $lang["datnguyenthe_checkbox_graph"]; ?></span>
                            <input type="checkbox" name="toggle graph" id="toggle_graph" checked="checked">
                        </div>
                        <div class="col-md-3">
                            <span class="spandisp"><?php echo $lang["datnguyenthe_checkbox_animation"]; ?></span>
                            <input type="checkbox" name="toggle animation" id="toggle_animation" checked="checked">
                        </div>
                    </div>
                    <input id="initPosition" value="0" hidden>
                    <input id="initAngle" value="0" hidden>
                </form>
            </div>
        </div>
        <div class="row" id="error_invalid_input" style="display: none">
            <div class="col">
                <p class="text-danger display-4 text-center"><?php echo $lang["datnguyenthe_error_invalid_input"] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="graph"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="canvas" width="500" height="500" style="border: 1px solid black"></canvas>
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
        $('#toggle_graph').change(function() {
            if(this.checked) {
                $('#graph').show();
            }
            else{
                $('#graph').hide();
            }
        });

        $('#toggle_animation').change(function() {
            if(this.checked) {
                $('#canvas').show();
            }
            else{
                $('#canvas').hide();
            }
        });

        $("#submit").click(function(e){
            $("#error_invalid_input").hide();

            $.ajax({
                type: 'POST',
                url: 'logindividualtaskuse.php',
                data:{
                    name: "Inverted Pendulum"
                },
                success: function(msg){
                }
            });

            var r = $("#user_input").val();
            if(r < -5 || r > 5){
                $("#error_invalid_input").show();
            }
            else{
                var initPosition = $("#initPosition").val();
                var initAngle = $("#initAngle").val();

                var url = 'octave_api.php?apikey=ABC&type=kyvadlo&input='+r+'&initPosition='+initPosition+'&initAngle='+initAngle+'';
                console.log(url);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(msg){

                        console.log(msg);

                        if(!msg.success){
                            return;
                        }

                        console.log(msg[1].final.finalPosition);
                        console.log(msg[1].final.finalAngle);

                        //update the initital conditions with new data
                        $("#initPosition").val(parseFloat(msg[1].final.finalPosition));
                        $("#initAngle").val(msg[1].final.finalAngle);


                        for(var i =0; i< msg[0].data.length; i++){
                            (function(index) {
                                setTimeout(function() {
                                    var position = msg[0].data[index].pendulum_position;
                                    var angle = msg[0].data[index].pendulum_angle;
                                    console.log(position + " | " + angle);
                                    updateGraph(position,angle);
                                    // animate(x1,x3);
                                }, 1000);
                            })(i);
                        }
                    }
                });
            }
        });

        /* ==========GRAPH================*/
        var layout = {
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

        var data = [trace1, trace2];
        Plotly.newPlot('graph', data, layout);

        var grafx =  0;

        function updateGraph(position, angle){
            Plotly.extendTraces('graph', {
                x: [[grafx]],
                y: [[position]]
            } , [0]);

            Plotly.extendTraces('graph', {
                x: [[grafx]],
                y: [[angle]]
            } , [1]);

            grafx++;

        }


        /*============Animation on canvas================*/
        var canvas = new fabric.Canvas('canvas');
        // create a rectangle object
        var rect = new fabric.Rect({
            left: 100,
            top: 100,
            fill: 'red',
            width: 20,
            height: 20
        });
        var line = new fabric.Line({
            x1: 50,
            y1: 50,
            x2: 200,
            y2: 200
        });

        // "add" rectangle onto canvas
        canvas.add(rect);
        canvas.add(line);

        rect.set('fill', 'red');
        line.set('fill', 'blue');
        rect.set({ strokeWidth: 5, stroke: 'rgba(100,200,200,0.5)' });
        rect.set('angle', 15).set('flipY', true);

    </script>
		
</body>
</html>
		