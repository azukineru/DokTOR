$(function() {
    $('#example2').dataTable({
        "bProcessing": true,
        "serverSide": true,
        "ajax":"function/dokumentasi_grid.php",
        "columns": [
            { "width": "5%"},
            { "width": "10%"},
            { "width": "15%"},
            { "width": "10%"},
            { "width": "15%"},
            { "width": "45%"}
        ]
    });
});