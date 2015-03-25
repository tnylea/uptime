@extends('uptime')

@section('content')

<div class="bg"></div>
<div class="bg-dim"></div>

<div id="circle"></div>

<div class="container">
	<div id="status"><span class="code"></span></div>
</div>

@endsection

@section('javascript')
	<script src="/js/circle-progress.js"></script>
	<script>

	//set interval for 5 minutes
	var interval = 325000;

		$(document).ready(function(){
			runLoader();
			perform_check();
			
			setInterval(function(){
				runLoader();
				perform_check();
			}, interval);

		});

		perform_check = function(){
			$('.code').text('Checking...');
			$('#status').removeClass();
			$.post('/check', { url: '<?= getenv('SITE_URL') ?>', _token: '<?php echo csrf_token(); ?>' }, function(data){
				if(data == 200){
					$('.code').text('PASS');
					$('#status').addClass('success');
				} else {
					$.post('/sendEmail', { _token: '<?php echo csrf_token(); ?>' }, function(data){
						console.log(data);
					});
					$('.code').text('Error');
					$('#status').addClass('error');
				}
			});
		}

		runLoader = function(){
			$('#circle').circleProgress({
	        value: 1,
	        size: 110,
	        animation: { duration: interval, easing: "linear" },
	        fill: { 'color' : 'rgba(255, 255, 255, 0.8)' }
	    });
		}
	</script>
@endsection
