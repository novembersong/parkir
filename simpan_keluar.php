<?php 

$PDO1 = new PDO("mysql:host=localhost;dbname=parkir", 'root', '');
$PDO1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Asia/Jakarta');
$vMasuk='';
$vNopol='';
$vSuccess='';
$vError='';
$keluar='';
$waktu=date('Y-m-d H:i:s');


$vKodePark=$_GET["ikode"];
$vNopol=$_GET["inopol"];


					
$PDO=$PDO1->prepare('SELECT parking_code FROM data_parkir WHERE parking_code=:code ');
$PDO->bindParam(':code', $vKodePark);
$PDO->execute();
if($PDO->rowCount()!=0){
	$PDO=$PDO1->prepare('UPDATE data_parkir SET nopol=:nopol,jam_keluar=:jmklr WHERE parking_code=:code');
		$PDO->bindParam(':nopol', $vNopol);
		$PDO->bindParam(':code', $vKodePark);
		$PDO->bindParam(':jmklr', $waktu);
		$PDO->execute();
		$vSuccess="makasih sudah parkir";
	
}
else{

		$vError="Kode Parkir Tidak Ditemukan";	

}

		keHTML($vSuccess,$vError);
		function keHTML($vSuccess,$vError){
		echo '{"success" : "'.$vSuccess.'", "error" : "'.$vError.'"}';
}
 ?>