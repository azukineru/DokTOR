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

?>