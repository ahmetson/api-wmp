<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to API</title>

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
	<script type="text/javascript">
		var state = '<?php echo $state ?>';
		<?php if ($state == 'success') { ?>
			var shopId = <?php echo $shopId ?>;
			var token = '<?php echo $token ?>';
		<?php } else if ($state == 'failure') { ?>
			var message = '<?php echo $message; ?>';
		<?php } ?>

		function callback() {
			if (state == 'success')
				JSInterface.successCallback(shopId, token);
			else if (state == 'failure')
				JSInterface.failureCallback(message);
			else
				JSInterface.neutralCallback();
		}
	</script>
</div>

</body>
</html>