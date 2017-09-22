<?php

include('database.php');

header('Content-Type: application/json');

$query = mysqli_query($con, "SELECT * FROM (SELECT COUNT(tanggal_dokumen) AS count, tanggal_dokumen AS tanggal FROM dokumentasi GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10) AS t ORDER BY tanggal");

$row = array();

while( $r = mysqli_fetch_assoc($query))
{
	$row[] = $r;	
}

print json_encode($row);

?>