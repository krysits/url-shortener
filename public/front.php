<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="0K.LV - URL Shortener">
	<meta name="author" content="https://krysits.com">
	<title>0K.LV - URL Shortener</title>
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<!-- Custom styles for this template -->
	<link href="/css/landing-page.min.css" rel="stylesheet">
	<link href="/css/campaign.css" rel="stylesheet">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-5467644203652210",
			enable_page_level_ads: true
		});
	</script>
</head>
<body>
<!-- head -->
<header class="masthead text-white text-center">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-xl-9 mx-auto">
				<h1 class="mb-5">0K.LV - URL Shortener</h1>
			</div>
			<div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
				<form action="/" method="get" id="frm">
					<div class="form-row">
						<div class="col-12 col-md-9 mb-2 mb-md-0">
							<input type="text" name="q" id="q" class="form-control form-control-lg" placeholder="Paste URL here with http://"
							       value="">
							<input type="text" name="alias" id="alias" class="form-control form-control-sm" placeholder="Alias"
							       value="">
							<input type="button" onclick="$('#optional').removeClass('d-none');$(this).hide();" class="form-control form-control-sm" placeholder="Campaign"
							       value="Add Campaign information">
						</div>
						<div class="col-12 col-md-3">
							<button type="submit" class="btn btn-block btn-lg btn-primary">OK</button>
						</div>
					</div>
					
					<div id="optional" class="form-row d-none">
						<div class="FormControl FormControl--inline FormControl--required"><label class="FormControl-label">Source</label>
							<div class="FormControl-body"><input class="FormField" id="utm_source" name="utm_source" placeholder=" " value=""></div>
							<div class="FormControl-info">The referrer: (e.g.&nbsp;<code>google</code>,&nbsp;<code>newsletter</code>)</div>
						</div>
						<div class="FormControl FormControl--inline FormControl--required"><label class="FormControl-label">Medium</label>
							<div class="FormControl-body"><input class="FormField" id="utm_medium" name="utm_medium" placeholder=" "  value=""></div>
							<div class="FormControl-info">Marketing medium: (e.g.&nbsp;<code>cpc</code>,&nbsp;<code>banner</code>,&nbsp;<code>email</code>)</div>
						</div>
						<div class="FormControl FormControl--inline FormControl--required"><label class="FormControl-label">Campaign Name</label>
							<div class="FormControl-body"><input class="FormField" id="utm_campaign" name="utm_campaign" placeholder=" " value=""></div>
							<div class="FormControl-info">Product, promo code, or slogan (e.g. <code>spring_sale</code>)</div>
						</div>
						<div class="FormControl FormControl--inline"><label class="FormControl-label">Term</label>
							<div class="FormControl-body"><input class="FormField" id="utm_term" name="utm_term" placeholder=" " value=""></div>
							<div class="FormControl-info">Identify the paid keywords</div>
						</div>
						<div class="FormControl FormControl--inline"><label class="FormControl-label">Content</label>
							<div class="FormControl-body"><input class="FormField" id="utm_content" name="utm_content" placeholder=" " value=""></div>
							<div class="FormControl-info">Use to differentiate ads</div>
						</div>
					</div>
				
				</form>
			</div>
		</div>
	</div>
</header>
<!-- Footer -->
<footer class="footer bg-light">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 h-100 text-center text-lg-left my-auto">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- 0k.lv - url shortener [front-page] -->
				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-5467644203652210"
				     data-ad-slot="1540878194"
				     data-ad-format="auto"
				     data-full-width-responsive="true"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				<p class="text-muted small mb-4 mb-lg-0">&copy; 0k.lv <?php echo date('Y');?></p>
			</div>
		</div>
	</div>
</footer>
<!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-4648147-31"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-4648147-31');
</script>
<!-- js logic -->
<script>
	$(document).on('submit', '#frm', (e)=>{
		e.preventDefault();
		let data = {};
		if($('#q').val().length) {
			let campaign = '';
			if($('#q').val().indexOf('?') == -1) {
				campaign += $('#q').val() + '?';
			}
			else {
				campaign += $('#q').val();
			}
			if($('#utm_source').val().length) {
				campaign += '&utm_source=' + $('#utm_source').val();
			}
			if($('#utm_medium').val().length) {
				campaign += '&utm_source=' + $('#utm_medium').val();
			}
			if($('#utm_campaign').val().length) {
				campaign += '&utm_source=' + $('#utm_campaign').val();
			}
			if($('#utm_term').val().length) {
				campaign += '&utm_source=' + $('#utm_term').val();
			}
			if($('#utm_content').val().length) {
				campaign += '&utm_source=' + $('#utm_content').val();
			}
			data['url'] = campaign;
		}
		else {
			alert('No URL!');
			return false;
		}
		if($('#alias').val().length) {
			data['alias'] = $('#alias').val();
		}
		$.get("add.php", data, function(response){
			if(response == '-1') {
				alert('Invalid URL!');
				$('#frm').trigger("reset");
			}
			else if(response == '0') {
				alert('URL not saved!');
				$('#frm').trigger("reset");
			}
			else {
				$('#frm').trigger("reset");
				$('#q').val(response);
				$('#q').select();
			}
		});
	});
</script>

</body>
</html>