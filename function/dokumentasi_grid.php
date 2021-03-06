<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'dokumentasi';
 
// Table's primary key
$primaryKey = 'no_dokumen';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
    array( 'db' => 'no_dokumen', 'dt' => 'no_dokumen' ),
    array( 'db' => 'tanggal_dokumen',  'dt' => 'tanggal_dokumen' ),
    array( 'db' => 'cost_center',   'dt' => 'cost_center' ),
    array( 'db' => 'unit',     'dt' => 'unit' ),
    array( 'db' => 'jenis_dokumen',     'dt' => 'jenis_dokumen' ),
    array( 'db' => 'program',     'dt' => 'program' ),
    array( 'db' => 'file_torjustifikasi', 'dt' => 'file_torjustifikasi' ),
    array( 'db' => 'file_pr', 'dt' => 'file_pr' ),
    array( 'db' => 'file_evaluasi', 'dt' => 'file_evaluasi' )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'db_doktor',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);