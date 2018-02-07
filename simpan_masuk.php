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



$vNopol=$_GET["inopol"];

$vDate=date("Ymd");
					
$PDO=$PDO1->prepare('SELECT parking_code FROM data_parkir order by parking_code desc limit 1');

$PDO->execute();
if($PDO->rowCount()!=0){
	
	$row = $PDO->fetchAll();
		foreach($row as $a)
		{
			$vTemp= $a['parking_code'];
		}
		$num=substr($vTemp,-3)+1;

		
		$vKode=$vDate."".sprintf('%03d',$num);
}
else{

		$vKode=$vDate."".sprintf('%03d',1);

}

$PDO=$PDO1->prepare('INSERT INTO data_parkir(nopol, parking_code, jam_masuk, jam_keluar) 
VALUES (:nopol,:code,:jmmsk,:jmklr)');
		$PDO->bindParam(':nopol', $vNopol);
		$PDO->bindParam(':code', $vKode);
		$PDO->bindParam(':jmmsk', $waktu);
		$PDO->bindParam(':jmklr', $keluar);
		$PDO->execute();

		$vSuccess="silahkan parkir";


		keHTML($vSuccess,$vError,$vKode);
		function keHTML($vSuccess,$vError,$vKode){
		echo '{"success" : "'.$vSuccess.'", "error" : "'.$vError.'", "kode" : "'.$vKode.'"}';
}
 ?>