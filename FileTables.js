$(document).ready(function() {

    $("#tabelFile").on('click', '.editor_view', function() {
        var id = $(this).closest('tr').find('td').eq(0).text();
        //alert(id);
        //var link = "/tor/editData.php?id=" + id;
        window.location.href = link;
    });

    $('#tabelDok').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "function/file_grid.php",
            "type": "POST"
        },
        "columns": [
            { "data": "no_dokumen", "width": "5%" },
            { "data": "file_torjustifikasi" },
            { "data": "file_pr" },
            { "data": "file_evaluasi" }
        ]
    } );
} );

