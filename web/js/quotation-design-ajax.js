$('body').on('click', '#save', function (e) {


    var formData = new FormData($('form')[0]);

    $.ajax({
        url  : 'form',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            console.log(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;

});


$('body').on('click', '#update', function (e) {


    var formData = new FormData($('form')[0]);

    $.ajax({
        url  : 'form-update',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            console.log(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;

});


$('body').on('click', '#file_delete', function (e) {




});

function deleteFile(filename,ref){

    $.ajax({
        url  : 'delete-files',
        type: 'POST',
        data: {"filename":filename, "ref":ref },

        success: function (data) {
            console.log(data);
            $( "div" ).remove( ".arc_file_table" );
            $.each($.parseJSON(data), function(key,value){
                console.log(value.file_name);

                var filename = String(value.file_name)+"";

                $( "#arc_file_div" ).append( "<div class='table-bordered col-sm-12 arc_file_table'><div class='col-sm-6 text-left'><a target='_blank' class='btn btn-xs' href='../uploads/"+value.file_name+"'> Attachment "+(key+1)+"</a></div><div class='col-sm-6 text-right'><a class='btn btn-danger btn-xs' onclick='deleteFile("+"\""+value.file_name+"\""+","+"\""+value.ref+"\""+");'>Delete</a></div></div>");


            });

        }
    });

    return false;
}