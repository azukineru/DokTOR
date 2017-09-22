<?php

function insertData($cost_center, $unit, $jenis_dokumen, $program)
{
	include('database.php');

	$select = mysqli_query($con, "SELECT * FROM `dokumentasi` ORDER BY no_dokumen DESC LIMIT 1 ");
	$row = mysqli_fetch_array($select);

	$lastId = $row['no_dokumen']+1;

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

	$folder = "storage/";

	if( ($fileTor_size < 10000000) && ($filePr_size < 10000000) && ($fileEval_size < 10000000) )
	{
		$query = "INSERT INTO dokumentasi (tanggal_dokumen, cost_center, unit, jenis_dokumen, program, file_torjustifikasi, ext_torjustifikasi, size_torjustifikasi, file_pr, ext_pr, size_pr, file_evaluasi, ext_evaluasi, size_evaluasi) VALUES (CURDATE(), '".$cost_center."', '".$unit."', '".$jenis_dokumen."', '".$program."', '".$fileTor."', '".$fileTor_ext."', '".$fileTor_size."', '".$filePr."', '".$filePr_ext."', '".$filePr_size."', '".$fileEval."', '".$fileEval_ext."', '".$fileEval_size."' )";


		if($con->query($query) == TRUE)
		{
			move_uploaded_file($fileTor_loc,$folder.$fileTor);
			move_uploaded_file($filePr_loc,$folder.$filePr);
			move_uploaded_file($fileEval_loc,$folder.$fileEval);

			echo
			'
			<script>								
				document.getElementById("insertSuccess").style.display = "block";
			</script>
			';
		}
		else
		{
			echo
			'
			<script>								
				document.getElementById("insertFailed").style.display = "block";
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
		window.location = "insertData.php";
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
	<form role="form" action="" method="post" enctype="multipart/form-data">
		<section class="col-lg-6 connectedSortable"> 
			<div class="box box-primary">   
				<div class="box-header">
					<h3 class="box-title">Data '.$id.'</h3>                                
				</div>               
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
				</div>
			</div>
		</section>
		<section class="col-lg-6 connectedSortable">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Upload File</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="file_torjustifikasi">File TOR dan Justifikasi</label>
						<br>
						<span>'.$row['file_torjustifikasi'].'</span>
						<input type="file" class="form-control" name="file_torjustifikasi" ">
					</div>
					<div class="form-group">
						<label for="file_pr">File Purchase Release</label>
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
				</div>
			</div>
		</section>
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary btn-flat" name="update">Save</button>
		</div>
	</form>
	';

	if(isset($_POST["update"]))
	{
		$flagTor = 0; $flagPr = 0; $flagEval = 0;
		$fileTor_size = 0; $filePr_size = 0; $fileEval_size = 0;

		if($_FILES["file_torjustifikasi"]["error"] == 4)
		{
			$flagTor = 0;
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
			$flagPr = 0;
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
			$flagEval = 0;
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
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."', `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}
			else if( ($flagTor == 1) && ($flagPr == 1) && ($flagEval == 0) )
			{
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."', `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}
			else if( ($flagTor == 1) && ($flagPr == 0) && ($flagEval == 1) )
			{
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}
			else if( ($flagTor == 1) && ($flagPr == 0) && ($flagEval == 0) )
			{
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_torjustifikasi` = '".$fileTor."', `ext_torjustifikasi` = '".$fileTor_ext."', `size_torjustifikasi` = '".$fileTor_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}
			else if( ($flagTor == 0) && ($flagPr == 1) && ($flagEval == 1) )
			{
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}
			else if( ($flagTor == 0) && ($flagPr == 1) && ($flagEval == 0) )
			{
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_pr` = '".$filePr."', `ext_pr` = '".$filePr_ext."', `size_pr` = '".$filePr_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}
			else
			{
				$sql = "UPDATE `dokumentasi` SET `cost_center` = '".$_POST['cost_center']."', `unit` = '".$_POST['unit']."', `jenis_dokumen` = '".$_POST['jenis_dokumen']."', `program` = '".$_POST['program']."', `file_evaluasi` = '".$fileEval."', `ext_evaluasi` = '".$fileEval_ext."', `size_evaluasi` = '".$fileEval_size."' WHERE `dokumentasi`.`no_dokumen` = '".$id."' ";
			}

			if($con->query($sql) == TRUE)
			{
				if( $flagTor == 1 )
				{
					$delFile = 'storage/'.$row['file_torjustifikasi'];
					if(file_exists($delFile))
					{
						unlink($delFile);
					}					
					move_uploaded_file($fileTor_loc,$folder.$fileTor);
				}
				if( $flagPr == 1 )
				{
					$delFile = 'storage/'.$row['file_pr'];
					if(file_exists($delFile))
					{
						unlink($delFile);
					}
					move_uploaded_file($filePr_loc,$folder.$filePr);
				}
				if( $flagEval == 1 ){
					$delFile = 'storage/'.$row['file_evaluasi'];
					if(file_exists($delFile))
					{
						unlink($delFile);
					}
					move_uploaded_file($fileEval_loc,$folder.$fileEval);
				}

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

function showNumDocs()
{
	include('database.php');

	$query = mysqli_query($con, "SELECT * FROM dokumentasi");
	$total=mysqli_num_rows($query);

	echo $total;
}

?>