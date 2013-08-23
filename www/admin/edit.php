<?  
    require_once(__DIR__.'/../../init.php'); 
    require_once('lib/mysql.php');
    $brew = new Brew($config['db']);
    if (isset($_POST['_submit'])) {
		# debug($_FILES);
		if (0 == $_FILES['image']['error']) {
			require_once('lib/image.php');
			$uploaded_filename = sprintf('%s/%s.%s', $config['fs']['upload'], $_REQUEST['uid'], pathinfo($_FILES['image']['name'])['extension']);
			move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_filename);
			$_REQUEST['image'] = Image::resize($uploaded_filename);
		} else {
			unset($_REQUEST['image']);
		}
        unset($_REQUEST['_submit']);
        $brew->save($_REQUEST);
    }
    $beer = $brew->get(@$_REQUEST['uid']);
    $title = $beer['name'];
    include_once('template/_header.php');
?>
<p class="pull-right"><a href="/admin/">Back to Admin Page</a></p>
<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="/admin/edit.php?uid=<?= @$_REQUEST['uid'] ?>">
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Name</label>
    <div class="col-lg-10">
        <input type="text" class="form-control" value="<?= $beer['name'] ?>" name="name" />
    </div>
  </div>
  <div class="form-group">
    <label for="image" class="col-lg-2 control-label">Image</label>
    <div class="col-lg-10">
        <input type="file" name="image" />
        <p class="help-block"><img src="<?= $beer['image'] ?>" /></p>
    </div>
  </div>
  <div class="form-group">
    <label for="description" class="col-lg-2 control-label">Description</label>
    <div class="col-lg-10">
        <textarea name="description" class="form-control" rows="3"><?= $beer['description'] ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="notes" class="col-lg-2 control-label">Notes</label>
    <div class="col-lg-10">
        <textarea name="notes" class="form-control" rows="3"><?= $beer['notes'] ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="brewed_on" class="col-lg-2 control-label">Brewed On</label>
    <div class="col-lg-10">
        <input type="date" class="form-control" name="brewed_on" value="<?= $beer['brewed_on'] ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="kegged_on" class="col-lg-2 control-label">Kegged On</label>
    <div class="col-lg-10">
        <input type="date" class="form-control" name="kegged_on" value="<?= $beer['kegged_on'] ?>" />
    </div>
  </div>
  <div class="form-group">
    <label for="keg" class="col-lg-2 control-label">Keg</label>
    <div class="col-lg-10">
        <select name="keg" class="form-control">
            <option value="">Choose a Keg</option>
            <? $kegs = ['Red Top', 'Red Stripe', 'Yellow Stripe', 'White Stripe', 'Green Top', 'Black Top'];
                foreach ($kegs as $keg) {
                    printf('<option%2$s value="%1$s">%1$s</option>', $keg, $keg == $beer['keg'] ? ' selected="selected"' : '');
                }
            ?>
        </select>
    </div>
  </div>
  <div class="form-group">
    <label for="status" class="col-lg-2 control-label">Status</label>
    <div class="col-lg-10">
        <select name="status" class="form-control">
        <?  foreach (array_keys($brew->brews) as $status) {
				printf('<option%2$s value="%1$s">%1$s</option>', $status, $status == $beer['status'] ? ' selected="selected"' : '');
            }
        ?>
        </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" name="_submit" class="btn btn-default">Update</button>
      <a href="/admin/" class="btn btn-default">Cancel</a>
    </div>
  </div>
</form>
<? include_once('template/_footer.php'); ?>
