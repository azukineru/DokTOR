<?php

include("database.php");

$query = mysqli_query($con, "SELECT * FROM `file_dokumentasi` ORDER BY no_dokumen DESC LIMIT 1 ");
$row = mysqli_fetch_array($query);

$lastId = $row['no_dokumen']+1;

if(isset($_POST['uploadDok']))
{
	// File TOR dan Dokumentasi
	$fileTor = $lastId."-".$_FILES['file_torjustifikasi']['name'];
	$fileTor_loc = $_FILES['file_torjustifikasi']['tmp_name'];
	$fileTor_size = $_FILES['file_torjustifikasi']['size'];
	$tmpTor = explode(".", $fileTor);
	$fileTor_ext = end($tmpTor);

	// File Purchase Release
	$filePr = $lastId."-".$_FILES['file_pr']['name'];
	$filePr_loc = $_FILES['file_pr']['tmp_name'];
	$filePr_size = $_FILES['file_pr']['size'];
	$tmpPr = explode(".", $filePr);
	$filePr_ext = end($tmpPr);

	// File Evaluasi
	$fileEval = $lastId."-".$_FILES['file_evaluasi']['name'];
	$fileEval_loc = $_FILES['file_evaluasi']['tmp_name'];
	$fileEval_size = $_FILES['file_evaluasi']['size'];
	$tmpEval = explode(".", $fileEval);
	$fileEval_ext = end($tmpEval);

	$folder = "../storage/";

	if( ($fileTor_size < 10000000) && ($filePr_size < 10000000) && ($fileEval_size < 10000000) )
	{
		$sql = "INSERT INTO file_dokumentasi(file_torjustifikasi,ext_torjustifikasi,size_torjustifikasi,file_pr,ext_pr,size_pr,file_evaluasi,ext_evaluasi,size_evaluasi) 
		VALUES('$fileTor','$fileTor_ext','$fileTor_size','$filePr','$filePr_ext','$filePr_size','$fileEval','$fileEval_ext','$fileEval_size')";

		if($con->query($sql) == TRUE)
		{
			move_uploaded_file($fileTor_loc,$folder.$fileTor);
			move_uploaded_file($filePr_loc,$folder.$filePr);
			move_uploaded_file($fileEval_loc,$folder.$fileEval);
			echo
			'
			<script>
			alert("Data berhasil dimasukkan.");
			window.location = "../insertFile.php";
			</script>
			';
		}
		else
		{
			echo
			'
			<script>
			alert("Data gagal dimasukkan.");
			window.location = "../insertFile.php";
			</script>
			';
		}
	}
	else
	{
		echo
		'
		<script>
		alert("Data gagal dimasukkan. Ukuran file terlalu besar.");
		window.location = "../insertFile.php";
		</script>
		';
	}

	

}

?>