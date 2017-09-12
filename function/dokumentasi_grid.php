
<?php
	//include connection file 
	include_once("connection.php");
	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 => 'no_dokumen',
		1 => 'tanggal_dokumen',
		2 => 'cost_center',
		3 => 'unit',
		4 => 'jenis_dokumen',
		5 => 'program'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( no_dokumen LIKE '".$params['search']['value']."%' ";    
		$where .=" OR cost_center LIKE '".$params['search']['value']."%' ";
		$where .=" OR unit LIKE '".$params['search']['value']."%' ";
		$where .=" OR jenis_dokumen LIKE '".$params['search']['value']."%' ";
		$where .=" OR program LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$sql = "SELECT no_dokumen, tanggal_dokumen, cost_center, unit, jenis_dokumen, program FROM `dokumentasi` ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '')
	{
		$sqlTot .= $where;
		$sqlRec .= $where;
	}

	$sqlRec .=  " LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($conn, $sqlRec) or die("Error to fetch data");

	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_row($queryRecords) ) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
	