$('body').on('click', '#save', function (e) {

    var ajaxCall = true;
    var formObj = {};
    var formData = new FormData($('form')[0]);

    inputs = $('form').serializeArray();


    $.each(inputs, function (i, input) {
        formObj[input.name] = input.value;
    });


    supervisor_name = $.trim(formObj.supervisor_name);
    project_name = $.trim(formObj.project_name);
    project_name_header = $.trim(formObj.project_name_header);
    grand_total = $.trim(formObj.grand_total);
    amounts_in_word = $.trim(formObj.amounts_in_word);
    client_company_id = $.trim(formObj.client_company_id);

    if( supervisor_name.length === 0 ) {
        ajaxCall = false;
        alert('Supervisor name must not be empty!');
    }

    if( project_name.length === 0 ) {
        ajaxCall = false;
        alert('Project name must not be empty!');
    }

    if( project_name_header.length === 0 ) {
        ajaxCall = false;
        alert('Project name header must not be empty!');
    }

    if( grand_total.length === 0 ) {
        ajaxCall = false;
        alert('Grand total must not be empty!');
    }

    if( amounts_in_word.length === 0 ) {
        ajaxCall = false;
        alert('Amounts in words must not be empty!');
    }

    if( client_company_id.length === 0 ) {
        ajaxCall = false;
        alert('Please select client name!');
    }

    if(ajaxCall){

    $.ajax({
        url  : 'form',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {

            var data = JSON.parse(data);

            if(data.id){
                id = data.id;
                window.location.replace("view-quotation?id="+id);
            }
        },
        error: function() {
            alert("There was an error. Try again please!");
        },
        cache: false,
        contentType: false,
        processData: false
    });
    }

    return false;

});



$('body').on('click', '#update', function (e) {
    var ajaxCall = true;
    var formObj = {};
    var formData = new FormData($('form')[0]);

    inputs = $('form').serializeArray();


    $.each(inputs, function (i, input) {
        formObj[input.name] = input.value;
    });

    supervisor_name = $.trim(formObj.supervisor_name);
    project_name = $.trim(formObj.project_name);
    project_name_header = $.trim(formObj.project_name_header);
    grand_total = $.trim(formObj.grand_total);
    amounts_in_word = $.trim(formObj.amounts_in_word);

    if( supervisor_name.length === 0 ) {
        ajaxCall = false;
        alert('Supervisor name must not be empty!');
    }

    if( project_name.length === 0 ) {
        ajaxCall = false;
        alert('Project name must not be empty!');
    }

    if( project_name_header.length === 0 ) {
        ajaxCall = false;
        alert('Project name header must not be empty!');
    }

    if( grand_total.length === 0 ) {
        ajaxCall = false;
        alert('Grand total must not be empty!');
    }

    if( amounts_in_word.length === 0 ) {
        ajaxCall = false;
        alert('Amounts in words must not be empty!');
    }

    if(ajaxCall){

     $.ajax({
         url  : 'form-update',
         type: 'POST',
         data: formData,
         async: false,
         success: function (data) {
             var data = JSON.parse(data);

             if(data.id){
                 id = data.id;
                 window.location.replace("view-quotation?id="+id);
             }
         },
         error: function() {
             alert("There was an error. Try again please!");
         },
         cache: false,
         contentType: false,
         processData: false
     });
    }

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


function deleteQuotation(id,ref){

    $.ajax({
        url  : 'delete-quotation',
        type: 'POST',
        data: {"id":id,"ref":ref},

        success: function (data) {
            console.log(data);

        }
    });

    return false;
}