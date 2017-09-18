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

function editData($id)
{
	include('database.php');

	$query = mysqli_query($con, "SELECT * FROM `dokumentasi` WHERE no_dokumen='".$id."' ");
	$row = mysqli_fetch_array($query);

	$varGA = 'GA';$varIPA = 'IPA';$varEPD = 'EPD';$varBPD = 'BPD';$varOPD = 'OPD';$varSPD = 'SPD';$varEPO = 'EPO';$varBPO = 'BPO';$varOPO = 'OPO';$varSPO = 'SPO';$varCIT = 'CIT';

	$arrayUnit = array("GA", "IPA", "EPD", "BPD", "OPD", "SPD", "EPO", "BPO", "OPO", "SPO", "CIT");
	$arrayJenisDokumen = array("OPEX", "CAPEX");

	echo
	'
	<form role="form" action="" method="post">
	<div class="box-body">
	<div class="form-group">
	<label for="no_dokumen">Nomor Dokumen</label>
	<input type="text" class="form-control" name="no_dokumen" value="'.$row['no_dokumen'].'" readonly="readonly">
	</div>
	<div class="form-group">
	<label for="no_dokumen">Tanggal Dokumen</label>
	<input type="text" class="form-control" name="tanggal_dokumen" value="'.$row['tanggal_dokumen'].'" readonly="readonly">
	</div>
	<div class="form-group">
	<label for="tanggal_dokumen">Cost Center</label>
	<input type="text" class="form-control" name="cost_center" value="'.$row['cost_center'].'">
	</div>
	<div class="form-group">
	<label for="unit">Unit</label>
	<select class="form-control" name="unit">
	';

	foreach ($arrayUnit as $value) 
	{
		echo '<option value="'.$value.'" '.(($value == $row['unit'])? 'selected="selected"' : "") .'>'.$value.'</option> ';
	}

	echo 
	'		
	</select>
	</div>
	<div class="form-group">
	<label for="jenis_dokumen">Jenis Dokumen</label>                                            
	<select class="form-control" name="jenis_dokumen">
	';
	foreach ($arrayJenisDokumen as $value) 
	{
		echo '<option value="'.$value.'" '.(($value == $row['jenis_dokumen'])? 'selected="selected"' : "") .'>'.$value.'</option> ';
	}
	echo 
	'
	</select>
	</div>
	<div class="form-group">
	<label for="program">Program / Kegiatan</label>
	<textarea name="program" class="form-control" rows="3">';echo $row['program'];echo '</textarea>
	</div>
	<button type="submit" class="btn btn-default" name="update">Save</button>
	</div>
	</form>
	';

	if(isset($_POST["update"]))
	{
		$query = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";

		if($con->query($query) == TRUE)
		{
			echo
			'
			<script>								
			document.getElementById("editSuccess").style.display = "block";
			</script>
			';
		}
		else
		{
			echo
			'
			<script>
			document.getElementById("editFailed").style.display = "block";
			</script>
			';
		}
		
	}
}

function editFile($id)
{
	include('database.php');

	$query = mysqli_query($con, "SELECT * FROM `file_dokumentasi` WHERE no_dokumen='".$id."' ");
	$row = mysqli_fetch_array($query);

	echo 
	'
	<form role="form" action="" method="post" enctype="multipart/form-data">
	<div class="box-body">
	<div class="form-group">
	<label for="no_dokumen">Nomor Dokumen</label>
	<input type="text" class="form-control" name="no_dokumen" value="'.$row['no_dokumen'].'" readonly="readonly">
	</div>
	<div class="form-group">
	<label for="file_torjustifikasi">File TOR dan Justifikasi</label>
	<br>
	<span>'.$row['file_torjustifikasi'].'</span>
	<input type="file" class="form-control" name="file_torjustifikasi" ">
	</div>
	<div class="form-group">
	<label for="file_pr">File Purchase Release (PR)</label>
	<br>
	<span>'.$row['file_pr'].'</span>
	<input type="file" class="form-control" name="file_pr" ">
	</div>
	<div class="form-group">
	<label for="file_evaluasi">File Evaluasi</label>
	<br>
	<span>'.$row['file_evaluasi'].'</span>
	<input type="file" class="form-control" name="file_evaluasi" ">
	</div>
	<button type="submit" class="btn btn-default" name="update">Save</button>
	</div>
	</form>
	';


	if(isset($_POST["update"]))
	{
		$flagTor = 0; $flagPr = 0; $flagEval = 0;
		$fileTor_size=0;$filePr_size=0;$fileEval_size=0;
		if($_FILES["file_torjustifikasi"]["error"] == 4)
		{

		}
		else
		{
			$fileTor = $id."-".$_FILES['file_torjustifikasi']['name'];
			$fileTor_loc = $_FILES['file_torjustifikasi']['tmp_name'];
			$fileTor_size = $_FILES['file_torjustifikasi']['size'];
			$tmpTor = explode(".", $fileTor);
			$fileTor_ext = end($tmpTor);

			$flagTor = 1;
		}

		if($_FILES["file_pr"]["error"] == 4)
		{

		}
		else
		{
			$filePr = $id."-".$_FILES['file_pr']['name'];
			$filePr_loc = $_FILES['file_pr']['tmp_name'];
			$filePr_size = $_FILES['file_pr']['size'];
			$tmpPr = explode(".", $filePr);
			$filePr_ext = end($tmpPr);

			$flagPr = 1;
		}

		if($_FILES["file_evaluasi"]["error"] == 4)
		{

		}
		else
		{
			$fileEval = $id."-".$_FILES['file_evaluasi']['name'];
			$fileEval_loc = $_FILES['file_evaluasi']['tmp_name'];
			$fileEval_size = $_FILES['file_evaluasi']['size'];
			$tmpEval = explode(".", $fileEval);
			$fileEval_ext = end($tmpEval);

			$flagEval = 1;
		}

		$folder = "storage/";

		if( ($fileTor_size < 10000000) && ($filePr_size < 10000000) && ($fileEval_size < 10000000) )
		{
			if( ($flagTor == 1) && ($flagPr == 1) && ($flagEval == 1) )
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."', `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE no_dokumen = '".$id."' ";
			}
			else if( ($flagTor == 1) && ($flagPr == 1) && ($flagEval == 0) )
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."', `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."' WHERE no_dokumen = '".$id."' ";
			}
			else if( ($flagTor == 1) && ($flagPr == 0) && ($flagEval == 1) )
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE no_dokumen = '".$id."' ";
			}
			else if( ($flagTor == 1) && ($flagPr == 0) && ($flagEval == 0) )
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."' WHERE no_dokumen = '".$id."' ";
			}
			else if( ($flagTor == 0) && ($flagPr == 1) && ($flagEval == 1) )
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE no_dokumen = '".$id."' ";
			}
			else if( ($flagTor == 0) && ($flagPr == 1) && ($flagEval == 0) )
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."' WHERE no_dokumen = '".$id."' ";
			}
			else
			{
				$sql = "UPDATE `file_dokumentasi` SET `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE no_dokumen = '".$id."' ";
			}
			

			if($con->query($sql)==TRUE)
			{
				if( $flagTor == 1 )
				{
					$delFile = 'storage/'.$row['file_torjustifikasi'];
					unlink($delFile);
					move_uploaded_file($fileTor_loc,$folder.$fileTor);
				}
				if( $flagPr == 1 )
				{
					$delFile = 'storage/'.$row['file_pr'];
					unlink($delFile);
					move_uploaded_file($filePr_loc,$folder.$filePr);
				}
				if( $flagEval == 1 ){
					$delFile = 'storage/'.$row['file_evaluasi'];
					unlink($delFile);
					move_uploaded_file($fileEval_loc,$folder.$fileEval);
				}
				echo
				'
				<script>
				alert("Data berhasil dimasukkan.");
				window.location = "viewFile.php";		
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
			window.location = "viewFile.php";
			</script>
			';
		}
	}
}

?>