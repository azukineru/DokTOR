<?php

include('database.php');

header("Content-type: application/xls");
header("Content-Disposition: attachment; filename=Dokumentasi_TOR_dan_Justifikasi.xls");

$query = mysqli_query($con, "SELECT `no_dokumen`, `tanggal_dokumen`, `cost_center`, `unit`, `jenis_dokumen`, `program`, `file_torjustifikasi`, `file_pr`, `file_evaluasi` FROM dokumentasi ");

echo '<table border=1>';
echo '<tr>';
echo '<td>No. Dokumen</td>';
echo '<td>Tanggal Dokumen</td>';
echo '<td>Cost Center</td>';
echo '<td>Unit</td>';
echo '<td>Jenis Dokumen</td>';
echo '<td>Program / Kegiatan</td>';
echo '<td>File TOR dan Justifikasi</td>';
echo '<td>File Purchase Release</td>';
echo '<td>File Evaluasi</td>';
echo '</tr>';

while( $row = mysqli_fetch_array($query) )
{
	echo '<tr>';
	echo '<td>'.$row['no_dokumen'].'</td>';
	echo '<td>'.$row['tanggal_dokumen'].'</td>';
	echo '<td>'.$row['cost_center'].'</td>';
	echo '<td>'.$row['unit'].'</td>';
	echo '<td>'.$row['jenis_dokumen'].'</td>';
	echo '<td>'.$row['program'].'</td>';
	echo '<td>'.$row['file_torjustifikasi'].'</td>';
	echo '<td>'.$row['file_pr'].'</td>';
	echo '<td>'.$row['file_evaluasi'].'</td>';
	echo '</tr>';
}
echo '</table>';

?>