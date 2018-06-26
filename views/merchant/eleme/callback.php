<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>WaiMaiPay</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	.logo-icon {
		width: 40px;

		vertical-align: middle;

		margin-right: 10px;

		margin-top: -3px;

		border-radius: 40%;
	}

	.text-center {
		text-align: center;
	}
	</style>
</head>
<body>

<div id="container">
	<h1><img src="/files/images/logo.png" class="logo-icon">WaiMaiPay</h1>

	<div id="body">
		<p class="text-center"><a href="http://wmp.ahmetson.com/files/latest.apk">Download</a></p>

		<p>WaiMaiPay is an made by <em>Ahmetson.com</em> for couriers. It will make their ridings more secure & comfortable, while will satisfy your Merchants customers. To learn more about the APP visit the <a href="http://wmp.ahmetson.com/">http://wmp.ahmetson.com/</a>

		<p>Contact to the us <code>wmp@ahmetson.com</code>.</p>
	</div>

	<p class="footer">Copyrights: <a href="http://ahmetson.com/">http://ahmetson.com/</a></p>
	<?php if ($state == 'auth_succeed') { ?>
	<script  src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<div id="loadingOverlay">
		<div id="floatingBarsG">
			<div class="blockG" id="rotateG_01"></div>
			<div class="blockG" id="rotateG_02"></div>
			<div class="blockG" id="rotateG_03"></div>
			<div class="blockG" id="rotateG_04"></div>
			<div class="blockG" id="rotateG_05"></div>
			<div class="blockG" id="rotateG_06"></div>
			<div class="blockG" id="rotateG_07"></div>
			<div class="blockG" id="rotateG_08"></div>
		</div>
		<style >
		#loadingOverlay {
background-color: rgba(0,0,0,0.6);
position: fixed;
height: 100%;
margin: 0;
top: 0;
left: 0;
bottom: 0;
right: 0;
	}
			#floatingBarsG{
	position: fixed;
width: 56px;
height: 69px;
left: 50%;
top: 50%;
margin-top: -30px;
margin-left: -30px;
}

.blockG{
	position:absolute;
	background-color:rgb(32,43,59);
	width:9px;
	height:22px;
	border-radius:7px 7px 0 0;
		-o-border-radius:7px 7px 0 0;
		-ms-border-radius:7px 7px 0 0;
		-webkit-border-radius:7px 7px 0 0;
		-moz-border-radius:7px 7px 0 0;
	transform:scale(0.4);
		-o-transform:scale(0.4);
		-ms-transform:scale(0.4);
		-webkit-transform:scale(0.4);
		-moz-transform:scale(0.4);
	animation-name:fadeG;
		-o-animation-name:fadeG;
		-ms-animation-name:fadeG;
		-webkit-animation-name:fadeG;
		-moz-animation-name:fadeG;
	animation-duration:1.66s;
		-o-animation-duration:1.66s;
		-ms-animation-duration:1.66s;
		-webkit-animation-duration:1.66s;
		-moz-animation-duration:1.66s;
	animation-iteration-count:infinite;
		-o-animation-iteration-count:infinite;
		-ms-animation-iteration-count:infinite;
		-webkit-animation-iteration-count:infinite;
		-moz-animation-iteration-count:infinite;
	animation-direction:normal;
		-o-animation-direction:normal;
		-ms-animation-direction:normal;
		-webkit-animation-direction:normal;
		-moz-animation-direction:normal;
}

#rotateG_01{
	left:0;
	top:25px;
	animation-delay:0.62s;
		-o-animation-delay:0.62s;
		-ms-animation-delay:0.62s;
		-webkit-animation-delay:0.62s;
		-moz-animation-delay:0.62s;
	transform:rotate(-90deg);
		-o-transform:rotate(-90deg);
		-ms-transform:rotate(-90deg);
		-webkit-transform:rotate(-90deg);
		-moz-transform:rotate(-90deg);
}

#rotateG_02{
	left:7px;
	top:9px;
	animation-delay:0.83s;
		-o-animation-delay:0.83s;
		-ms-animation-delay:0.83s;
		-webkit-animation-delay:0.83s;
		-moz-animation-delay:0.83s;
	transform:rotate(-45deg);
		-o-transform:rotate(-45deg);
		-ms-transform:rotate(-45deg);
		-webkit-transform:rotate(-45deg);
		-moz-transform:rotate(-45deg);
}

#rotateG_03{
	left:23px;
	top:3px;
	animation-delay:1.04s;
		-o-animation-delay:1.04s;
		-ms-animation-delay:1.04s;
		-webkit-animation-delay:1.04s;
		-moz-animation-delay:1.04s;
	transform:rotate(0deg);
		-o-transform:rotate(0deg);
		-ms-transform:rotate(0deg);
		-webkit-transform:rotate(0deg);
		-moz-transform:rotate(0deg);
}

#rotateG_04{
	right:7px;
	top:9px;
	animation-delay:1.25s;
		-o-animation-delay:1.25s;
		-ms-animation-delay:1.25s;
		-webkit-animation-delay:1.25s;
		-moz-animation-delay:1.25s;
	transform:rotate(45deg);
		-o-transform:rotate(45deg);
		-ms-transform:rotate(45deg);
		-webkit-transform:rotate(45deg);
		-moz-transform:rotate(45deg);
}

#rotateG_05{
	right:0;
	top:25px;
	animation-delay:1.46s;
		-o-animation-delay:1.46s;
		-ms-animation-delay:1.46s;
		-webkit-animation-delay:1.46s;
		-moz-animation-delay:1.46s;
	transform:rotate(90deg);
		-o-transform:rotate(90deg);
		-ms-transform:rotate(90deg);
		-webkit-transform:rotate(90deg);
		-moz-transform:rotate(90deg);
}

#rotateG_06{
	right:7px;
	bottom:6px;
	animation-delay:1.66s;
		-o-animation-delay:1.66s;
		-ms-animation-delay:1.66s;
		-webkit-animation-delay:1.66s;
		-moz-animation-delay:1.66s;
	transform:rotate(135deg);
		-o-transform:rotate(135deg);
		-ms-transform:rotate(135deg);
		-webkit-transform:rotate(135deg);
		-moz-transform:rotate(135deg);
}

#rotateG_07{
	bottom:0;
	left:23px;
	animation-delay:1.87s;
		-o-animation-delay:1.87s;
		-ms-animation-delay:1.87s;
		-webkit-animation-delay:1.87s;
		-moz-animation-delay:1.87s;
	transform:rotate(180deg);
		-o-transform:rotate(180deg);
		-ms-transform:rotate(180deg);
		-webkit-transform:rotate(180deg);
		-moz-transform:rotate(180deg);
}

#rotateG_08{
	left:7px;
	bottom:6px;
	animation-delay:2.08s;
		-o-animation-delay:2.08s;
		-ms-animation-delay:2.08s;
		-webkit-animation-delay:2.08s;
		-moz-animation-delay:2.08s;
	transform:rotate(-135deg);
		-o-transform:rotate(-135deg);
		-ms-transform:rotate(-135deg);
		-webkit-transform:rotate(-135deg);
		-moz-transform:rotate(-135deg);
}



@keyframes fadeG{
	0%{
		background-color:rgb(9,74,186);
	}

	100%{
		background-color:rgb(252,247,252);
	}
}

@-o-keyframes fadeG{
	0%{
		background-color:rgb(9,74,186);
	}

	100%{
		background-color:rgb(252,247,252);
	}
}

@-ms-keyframes fadeG{
	0%{
		background-color:rgb(9,74,186);
	}

	100%{
		background-color:rgb(252,247,252);
	}
}

@-webkit-keyframes fadeG{
	0%{
		background-color:rgb(9,74,186);
	}

	100%{
		background-color:rgb(252,247,252);
	}
}

@-moz-keyframes fadeG{
	0%{
		background-color:rgb(9,74,186);
	}

	100%{
		background-color:rgb(252,247,252);
	}
}
		</style>
	</div>
	<?php } ?>
	<script type="text/javascript">
		<?php if ($state == 'auth_succeed') { ?>
			var code = '<?php echo $code; ?>';
			var tokenGettingUrl = 'http://api.wmp.host/merchant/set-eleme-token?code='+code;


			$(document).ajaxStart(function() {
			  $("#loadingOverlay").show();
			}).ajaxStop(function() {
			  $("#loadingOverlay").hide();
			});

			$.ajax({
				    type: "GET",
				    dataType: 'json',
				    url: tokenGettingUrl,
				    success: function(data) {
				    	console.log("Success"+data.shopId+", "+data.token+", "+data.refreshToken);
				    	JSInterface.authSucceed(data.shopId, data.token, data.refreshToken);
				    },
				    error: function(data){ 
				    	console.log(data);
				    	JSInterface.authFailed(data.message);
				    }
				  });


		<?php } else if ($state == 'auth_failed') { ?>
			console.log("Failed");
			//JSInterface.authFailed('<?php echo $errorDescription; ?>');
		<?php } ?>
		console.log("Well done!");
	</script>
</div>

</body>
</html>