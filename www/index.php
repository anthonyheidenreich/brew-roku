<?  
	require_once(__DIR__.'/../init.php'); 
	$title = 'On Tap';
	include_once('template/_header.php');
?>
<dl>
<? 
	require_once('lib/mysql.php');
	$brew = new Brew($config['db']);
	foreach ($brew->grouped() as $title=>$taps) {
		$class = strtolower(str_replace(' ','',$title));
		printf('<dt class="%s">%s</dt>', $class, $title);
		foreach ($taps as $beer) {
			printf('<dd class="%s"><div class="short"><h3>%s</h3><img src="%s" /></div><div class="full"><h3>Description</h3><p>%s</p><h3>Notes</h3><p>%s</p></div></dd>', $class, $beer['name'], $beer['image'], $beer['description'], $beer['notes']);
		}
	}
?>
</dl>
<? include_once('template/_footer.php'); ?>
