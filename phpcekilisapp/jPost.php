<?php 
$katilimcilar = $_POST['katilimcilar'];
/*print_r($_POST);*/
$katilimci = explode("\r\n", $katilimcilar);
if (!empty($_POST["unique"])) {
	$unique = $_POST["unique"];
	if ($unique == true) {
		$katilimci = array_unique($katilimci); // Tekrar eden katılımcılar çıkartıldı.
	}
}
$kazanan = array();
$katilimci = array_values(array_diff($katilimci,array(''))); //Boş katılımcıdan kurtulmak için kullanıldı.
$cntr = count($katilimci);
$kazanabilecek_sayisi = count(array_unique($katilimci));//Çekilişi kazanabilecek kişi sayısı.
$isEmpty = array_filter($katilimci);
$kazanacak_sayisi = $_POST['kazanacak_sayisi'];
$kontrol = array(); //Kazananın tekrar kazanmaması için kullanıldı.

$sonuc = "";
$sonuc .= "Çekilişe Katılan : ".$kazanabilecek_sayisi." Kişi</br>";
//$sonuc .= "Toplam Çekiliş Hakkı : ".$cntr." Adet</br>";
date_default_timezone_set("Europe/Istanbul");
$tarih = date("Y-m-d H:i:sa");
$tarih2 = date("Y-m-d H-i-sa");
$sonuc .= "Çekiliş Tarihi : ".$tarih."</br></br><hr>";

if($kazanacak_sayisi <= $cntr){
	if(!empty($isEmpty)){
		for($i=1; $i<=$kazanacak_sayisi; $i++){
			$sayi1 = rand(0, $cntr-1);
			if(!in_array($sayi1,$kontrol)){
				if (empty($unique) && in_array($katilimci[$sayi1], $kazanan)) {
					$i--;
				}else{
					array_push($kontrol,$sayi1);
					array_push($kazanan,$katilimci[$sayi1]);
					$sonuc .= "<b>".$i."</b>".'-'.$katilimci[$sayi1]."<br/>";
				} 
			}else{
				$i--;
			}
			
		}
		echo $sonuc;
		$sonuc = str_replace("</br>", "\n", $sonuc);
		$sonuc = str_replace("<br/>", "\n", $sonuc);
		$sonuc = str_replace("<b>", "", $sonuc);
		$sonuc = str_replace("</b>", "", $sonuc);
		$sonuc = str_replace("<hr>", "", $sonuc);
		$handle = fopen("cekilisler/".$tarih2.".txt", "w");
		fwrite($handle, $sonuc);
		fclose($handle);
		echo "</br><a href='download.php?tarih=".$tarih2."'><button>Text Olarak İndir</button></a>";
	}else{
		echo "Boş bırakmayın.";
	}
}else{
		echo "Kazanacak sayısı, katılımcı sayısından daha fazla olmamalıdır.";
}
?> 