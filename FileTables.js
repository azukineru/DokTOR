$(document).ready(function() {

    $("#tabelFile").on('click', '.editor_view', function() {
        var id = $(this).closest('tr').find('td').eq(0).text();
        //alert(id);
        //var link = "/tor/editData.php?id=" + id;
        window.location.href = link;
    });

    $('#tabelFile').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "function/file_grid.php",
            "type": "POST"
        },
        "columns": [
        { "data": "no_dokumen", "width": "5%" },
        {  data: "file_torjustifikasi",
        render: function(data, type, row)
        {
            return '<a href="storage/'+data+'">' + data + '</a>';
        }},
        {  data: "file_pr",
        render: function(data, type, row)
        {
            return '<a href="storage/'+data+'">' + data + '</a>';
        }},
        {  data: "file_evaluasi",
        render: function(data, type, row)
        {
            return '<a href="storage/'+data+'">' + data + '</a>';
        }}
        ]
    } );
} );

