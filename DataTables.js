$(document).ready(function() {

    $("#tabelDok").on('click', '.editor_view', function() {
        var id = $(this).closest('tr').find('td').eq(0).text();
        //alert(id);
        var link = "/tor/editData.php?id=" + id;
        window.location.href = link;
    });

    $('#tabelDok').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "function/dokumentasi_grid.php",
            "type": "POST"
        },
        "columns": [
            { "data": "no_dokumen", "width": "5%" },
            { "data": "tanggal_dokumen", "width": "5%" },
            { "data": "cost_center", "width": "5%" },
            { "data": "unit", "width": "5%" },
            { "data": "jenis_dokumen", "width": "10%" },
            { "data": "program", "width": "35%" },
            { data: "file_torjustifikasi",
            render: function(data, type, row)
            {
                return '<a href="storage/'+data+'">Download</a>'
            }},
            { data: "file_pr",
            render: function(data, type, row)
            {
                return '<a href="storage/'+data+'">Download</a>'
            }},
            { data: "file_evaluasi",
            render: function(data, type, row)
            {
                return '<a href="storage/'+data+'">Download</a>'
            }},
            {   
                data: null,
                className: "center",
                defaultContent: '<a class="editor_view" style="cursor:pointer">View & Edit</a>',
                "width": "10%" 
            }
        ]
    } );
} );

