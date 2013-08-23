<?
class Image
{
	public static function resize($file, $max_height=150, $max_width=150, $force=False) {
		$info = pathinfo($file);
		$out = sprintf('%s/%s-%sx%s.png', $info['dirname'], $info['filename'], $max_height, $max_width);
		$cmd = sprintf('convert %s -resize "%dx%d%s" %s', $file, $max_height, $max_width, $force ? '!' : '', $out);
		self::_exec($cmd);
		return self::_url($out);
	}

	private static function _url($path) {
		return end(explode('www', $path));
	}

	private static function _exec($cmd) {
		shell_exec($cmd);
	}
}
