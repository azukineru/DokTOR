<?php

function insertData($cost_center, $unit, $jenis_dokumen, $program)
{
	include('database.php');

	$query = "INSERT INTO dokumentasi (cost_center, unit, jenis_dokumen, program) VALUES ('".$cost_center."', '".$unit."', '".$jenis_dokumen."', '".$program."')";

	if($con->query($query) == TRUE)
	{
		echo
		'
			<script>
				alert("Data berhasil dimasukkan.");
			</script>
		';
	}
	else
	{
		echo
		'
			<script>
				alert("Data gagal dimasukkan.");
			</script>
		';
	}
}

?>