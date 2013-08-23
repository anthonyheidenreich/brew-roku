<?  
	require_once(__DIR__.'/../../init.php'); 
	$title = 'Admin';
	require_once('lib/mysql.php');
	$brew = new Brew($config['db']);
	if (isset($_REQUEST['delete'])) { 
		$brew->delete($_REQUEST['delete']);
	}
	include_once('template/_header.php');
?>
<ul class="navigation">
<? foreach ($brew->all() as $beer) { ?>
	<li>
		<h3>
			<a href="/admin/edit.php?uid=<?= $beer['uid'] ?>"><?= $beer['name'] ?></a>
			<a class="pull-right" href="/admin/index.php?delete=<?= $beer['uid'] ?>"><small>X</small></a>
		</h3>
		<p><a href="/admin/edit.php?uid=<?= $beer['uid'] ?>"><img src="<?= $beer['image'] ?>" /></a></p>
		<h4>Description</h4>
		<p><?= $beer['description'] ?></p>
		<h4>Notes</h4>
		<p><?= $beer['notes'] ?></p>
	</li>
<? } ?>
</ul>
<? include_once('template/_footer.php'); ?>
