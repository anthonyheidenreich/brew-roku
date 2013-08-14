<?  require_once(dirname(__FILE__).'/../init.php'); ?>
<html>
<head>
  <meta charset="utf-8" />
  <title>On Tap</title>

  <link rel="icon" type="image/x-icon" href="/ui/favicon.ico">

  <link href="/ui/css/www.css" rel="stylesheet" type="text/css" />

  <script src="/ui/js/jquery-1.10.2.min.js"></script>
  <script src="/ui/js/underscore-min.js"></script>
</head>
<body>
<div id="body">
	<div id="content">
		<dl>
<? 
	require_once(BASEDIR.'/lib/mysql.php');
	$brew = new Brew($config['db']);
	$beers = $brew->grouped();
	foreach ($beers as $title=>$taps) {
		$class = strtolower(str_replace(' ','',$title));
		printf('<dt class="%s">%s</dt>', $class, $title);
		foreach ($taps as $beer) {
			printf('<dd class="%s"><p class="short"><h3>%s</h3><img src="%s" /></p><p class="full">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet est ut magna molestie aliquet. Etiam quis luctus elit. Sed vitae risus cursus, euismod tellus in, ornare leo. Integer malesuada vitae nunc a condimentum. Mauris tincidunt felis eget leo accumsan, a pharetra metus interdum. Donec ante sem, accumsan eu justo sit amet, consectetur dictum risus. Fusce commodo neque non lorem ultricies euismod. Proin in gravida lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque hendrerit eleifend turpis suscipit viverra. Vivamus auctor felis eu nunc adipiscing luctus. Quisque vulputate nibh vitae massa laoreet, ac condimentum leo accumsan. Sed vel tempus erat, vel commodo arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec imperdiet congue tellus.  </p></dd>', $class, $beer['name'], $beer['image']);
		}
	}
?>
		</dl>
	</div>
	<div id="footer">
		<p>Last Updated: Aug 13, 2013</p>
	</div>
</div>
</body>
</html>
