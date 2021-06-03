<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ruleta</title>
    <!-- Vendor CSS Files -->
    <link href="{{ asset('ruleta/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <script src="{{ asset('ruleta/assets/js/TweenMax.min.js') }}"></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('ruleta/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('ruleta/assets/css/main.css') }}" rel="stylesheet">
</head>
<body onload="mueveReloj()">
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html">Ruleta</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <p class="form-control-static text-danger" >La hora es:</p>

            <form name="form_reloj">
                <input type="text" name="reloj" size="10" disabled="">
            </form>
        </div>
    </header><!-- End Header -->
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container" >
            <div class="row">
                <div class="col-lg-6 order-4 order-lg-1 hero-img" data-aos="zoom-in" data-aos-delay="200";>
                    <div id="canvasContainer" width="438" height="582" class="the_wheel" align="center" valign="center">
                        <canvas id="canvas" width="432" height="432">
                            <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
                        </canvas>
                        <img id="prizePointer" src="assets/img/wheel_back.png" alt="V" style="padding-left: 14px"; />
                    </div>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-2" data-aos="fade-up" data-aos-delay="200" >
                    <table style= "text-danger" align="center">
                        <th >Resultados</th>
                    </table>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>               
        </div>
                
    </section>

    <!-- Vendor JS Files -->
    <script src="{{ asset('ruleta/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('ruleta/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('ruleta/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('ruleta/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('ruleta/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('ruleta/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('ruleta/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('ruleta/js/main.js')}}"></script>
   <script src="{{ asset('ruleta/js/Winwheel.js')}}"></script>
   <script type="text/javascript">
   	 
            // Create new wheel object specifying the parameters at creation time.
            let theWheel = new Winwheel({

                'outerRadius'     : 199,        // Set outer radius so wheel fits inside the background.
                'innerRadius'     : 136,         // Make wheel hollow so segments don't go all way to center.
                'textFontSize'    : 16,         // Set default font size for the segments.
                'textOrientation' : 'curved', // Make text vertial so goes down from the outside of wheel.
               'textAlignment'  : 'outer',
    			'textMargin'     : 15,      // Align text to outside of wheel.
                'numSegments'     : 38,         // Specify number of segments.
                'rotationAngle'   : -2,
                'drawMode' : 'image',                
               'segments'        :             // Define segments including colour and text.
                [                               // font size and test colour overridden on backrupt segments.
                   { 'text' : '0 ' },
                   { 'text' : '28 '},
                   { 'text' : '9  '},
                   { 'text' : '26 '},
                   { 'text' : '30  '},
                   { 'text' : '11 '},
                   { 'text' : '7  '},
                   { 'text' : '20 '},
                   { 'text' : '32 '},
                   { 'text' : '17 '},
                   { 'text' : '5 '},
                   { 'text' : '22 '},
                   { 'text' : '34  '},
                   { 'text' : '15 '},
                   { 'text' : '3  '},
                   { 'text' : '24 '},
                   { 'text' : '36  '},
                   { 'text' : '13 '},
                   { 'text' : '1 '},
                   { 'text' : '00 ' },
                   { 'text' : '27  '},
                   { 'text' : '10 '},
                   { 'text' : '25  '},
                   { 'text' : '29 '},
                   { 'text' : '12  '},
                   { 'text' : '8 '},
                   { 'text' : '19  '},
                   { 'text' : '31 '},
                   { 'text' : '18 '},
                   { 'text' : '6 '},
                   { 'text' : '21  '},
                   { 'text' : '33 '},
                   { 'text' : '16  '},
                   { 'text' : '4  '},
                   { 'text' : '23 '},
                   { 'text' : '35 '},
                   { 'text' : '14 '},
                   { 'text' : '2 '}
                ],


                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 10,    // Duration in seconds.
                    'spins'    : 5,     // Default number of complete spins.
                    'callbackFinished' : resetWheel,
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
                'pins' :				// Turn pins on.
                {
                    'number'     : 37,
                    'fillStyle'  : 'silver',
                    'outerRadius': 1,
                }
            });
            

            // Loads the tick audio sound in to an audio object.
             
            let audio = new Audio('ruleta/assets/audio/tick.mp3');
            let loadedImg = new Image();
		    //var myVar = setInterval(startSpin, 10000);


			 function playSound()
            {
                // Stop and rewind the sound if it already happens to be playing.
                audio.pause();
                audio.currentTime = 0;

                // Play the sound.
                audio.play();
            }

            // Vars used by the code in this page to do power controls.
            let wheelSpinning = false;
            

            // -------------------------------------------------------
            // Function to handle the onClick on the power buttons.
            // -------------------------------------------------------
			 loadedImg.onload = function()
			{
			    theWheel.wheelImage = loadedImg;    // Make wheelImage equal the loaded image object.
			    theWheel.draw();                    // Also call draw function to render the wheel.
			}
			loadedImg.src = "ruleta/assets/img/spin.png";


            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            // 
      function startSpin()
            {
                // Ensure that spinning can't be clicked again while already running.
                if (wheelSpinning == false) {
                    // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                    // to rotate with the duration of the animation the quicker the wheel spins.
                  

                    // Disable the spin button so can't click again while wheel is spinning.
                    

                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();

                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }

            // -------------------------------------------------------
            // Function for reset button.
            // -------------------------------------------------------
            function resetWheel(indicatedSegment)
            {
                theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
                theWheel.rotationAngle = -5;     // Re-set the wheel angle to 0 degrees.
                theWheel.draw();                // Call draw to render changes to the wheel.

     			
                wheelSpinning = false;
                
                numeroApuesta = document.getElementById('numero').value;
                cantidadApuesta = document.getElementById('apuesta').value;
             
                 alert('El numero ganador es: ' + indicatedSegment.text);
                       // Reset to false to power buttons and spin can be clicked again.
            }

            function mueveReloj()
            {
			    momentoActual = new Date()
			    hora = momentoActual.getHours()
			    minuto = momentoActual.getMinutes()
			    segundo = momentoActual.getSeconds()

			    horaImprimible = hora + " : " + minuto + " : " + segundo

			    document.form_reloj.reloj.value = horaImprimible

			    setTimeout("mueveReloj()",1000)
			}

   </script>
</body>
</html>