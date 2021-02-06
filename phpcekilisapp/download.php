<?php
	include "config.php"; 
	if (!isset($_GET["tarih"])) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	$dosya = "cekilisler/".$_GET["tarih"].".txt";
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.basename($dosya));
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($dosya));
	readfile($dosya);

	if ($save != true) { //Kayıt seçeneği false ise dosyaları siler.
		$dir = "cekilisler";
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
		    $files[] = $filename;
		}

		sort($files);
		foreach ($files as $file) {
			if ($file != "." && $file != ".." && $file != "index.php") {
				unlink($dir."/".$file);
			}
		}

	}
	
	exit;
?>