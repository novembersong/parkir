<?php

$PDO1 = new PDO("mysql:host=localhost;dbname=parkir", 'root', '');
$PDO1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 date_default_timezone_set('Asia/Jakarta');
$kd=date("Y-m-d H-i-s");

 

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<script>
	$(document).ready(function(){
		$('#masuk').click(function(){
			var kode=$("#code").val();
			var nopol=$("#nopol").val();

		
			$.ajax({
					  type     : 'GET',
					  url      : 'simpan_masuk.php',
					  data     : {ikode:kode,inopol:nopol},		
					  dataType : 'json',
					  error    : function(){
								   alert("GAGAL : Ajax Request tidak dapat dijalankan !");
								   
								 },
					  success  : function(json){
								   if (json.error != ""){
									 alert(json.error);
							
								   }
								   else{
										alert(json.success);
										location.reload();
											
								   }
								 }
					    });

		});

	});

	$(document).ready(function(){
		$('#keluar').click(function(){
			var kode=$("#code").val();
			var nopol=$("#nopol").val();

			if(nopol == ""){
          		alert("Harap Isi No Polisi");
          		return false;
       			 }
			$.ajax({
					  type     : 'GET',
					  url      : 'simpan_keluar.php',
					  data     : {ikode:kode,inopol:nopol},		
					  dataType : 'json',
					  error    : function(){
								   alert("GAGAL : Ajax Request tidak dapat dijalankan !");
								   
								 },
					  success  : function(json){
								   if (json.error != ""){
									 alert(json.error);
							
								   }
								   else{
										alert(json.success);
										location.reload();	
								   }
								 }
					    });

		});

	});


	</script>
</head>
<body>
<div class="col-md-offset-3 form-group">
	<div class="form-group">
		<label class="col-md-2 control-label">NO.POLISI</label>
		<label class="col-md-1 control-label">:</label>
		<input id="nopol" type="text" class=" control-label" placeholder="No Polisi" style="width:100px"> 
	</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Parking Code</label>
			<label class="col-md-1 control-label">:</label>
			<input id="code" type="text" class=" control-label" placeholder="Parking Code" >	
		</div>	
</div>


<div class="col-md-offset-5 form-group">
<button id="masuk" type="button" class="btn btn-success">Masuk</button> 
<button id="keluar" type="button" class="btn btn-danger">keluar</button>
</div>

<table class="table">
		 <thead>
		          
		          <th >No.Polisi</th>
		          <th >Parking Code</th>
				  <th >Jam Masuk</th>
		          <th >Jam Keluar</th>
		
		         
		 </thead>
		  <tbody>
 <?php 

		$PDO=$PDO1->prepare('SELECT * FROM data_parkir');
		
		$PDO->execute();
    
      
		$row = $PDO->fetchAll();
		
		foreach($row as $r)
		{


		  
 ?>

		    <tr>
				<td><?php echo $r['nopol']; ?></td>
				<td><?php echo $r['parking_code']; ?></td>
				<td><?php echo $r['jam_masuk']; ?></td>
				<td><?php echo $r['jam_keluar']; ?></td>
			</tr>
	<?php	
		}	
 
 
	?>
            </tbody>

</table>
</body>
</html>