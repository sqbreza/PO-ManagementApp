var sectionId =1;
$('#add').click(function (e) {

    $('#items').append("<div><input type='text' name='section0_field_name[]' class='form-control template-input-design'><button class='delete btn-sm btn-danger'>Delete</button></div>");

});

$('#addSection').click(function (e) {


    $('#addSectionDiv').append("<div class='template-section' id='section"+sectionId+"'><button style='float:right;' class='deleteSection btn-sm btn-danger'>&#10006;</button><label class='form-control template-create-label'>Section Name:</label><input type='text' name='section_name[]' class='form-control template-input-design'><button class='add btn btn-primary btn-sm'>Add Field</button><div class='items form-group'> <div><label class='form-control template-create-label'>Fields Name:</label></div></div></div>");
    sectionId++;
});


$('body').on('click', '.delete', function (e) {
    $(this).parent('div').remove();
});

$('body').on('click', '.deleteSection', function (e) {
    $(this).parent('div').remove();
    sectionId--;
});

$('body').on('click', '.add', function (e) {

    //alert(event.target.id);
    var divItem =$(this).parent('div');

    nameOfSectionId = divItem.attr("id");

    divItem.append("<div><input type='text' name='"+nameOfSectionId+"_field_name[]' class='items form-control template-input-design'><button class='delete btn-sm btn-danger'>Delete</button></div>");

    return false;

});

$('#templateForm').on('click', '#formSubmit', function (e) {

    var data = $('form').serialize();

    var ajaxCall = true;
    var formObj = {};
    var inputs = $('form').serializeArray();

    $.each(inputs, function (i, input) {

        formObj[input.name] = input.value;

    });

    template_name = $.trim(formObj.template_name);
    calculation = $.trim(formObj.calculation);



    if( template_name.length === 0 ) {
        ajaxCall = false;
        alert('Template  name must not be empty!');
    }

    if( calculation.length === 0 ) {
        ajaxCall = false;
        alert('Please, select calculation type!');
    }

    $.each($('input[name^="section_name"]'), function (i, input) {

        field_name = $('input[name^="section'+i+'_field_name"]');

        if(!field_name[0]){
            ajaxCall = false;
            alert('There should be at least one field!');
        }


      /*  $.each(field_name, function (i, input) {

            field_name_value = input.value;

            if( field_name_value.length === 0 ) {
                ajaxCall = false;
                alert('Field name must not be empty!');
            }

        });*/



    });



    if(ajaxCall) {
        $.ajax({
            type: 'POST',
            cache: false,
            data: data,
            url: 'form',
            success: function (response) {
                //console.log(response);
                var data = JSON.parse(response);

                if(data.id){
                    id = data.id;
                    window.location.replace("view-template?id="+id);
                }
            },
            error: function() {
                alert("There was an error. Try again please!");
            }
        });
    }

});


$('#templateForm').on('click', '#formUpdate', function (e) {

    var data = $('form').serialize();

    var ajaxCall = true;
    var formObj = {};
    var inputs = $('form').serializeArray();

    $.each(inputs, function (i, input) {

        formObj[input.name] = input.value;

    });

    template_name = $.trim(formObj.template_name);

    if( template_name.length === 0 ) {
        ajaxCall = false;
        alert('Template  name must not be empty!');
    }

    $.each($('input[name^="section_name"]'), function (i, input) {

        field_name = $('input[name^="section'+i+'_field_name"]');

        if(!field_name[0]){
            ajaxCall = false;
            alert('There should be at least one field!');
        }


       /* $.each(field_name, function (i, input) {

            field_name_value = input.value;

            if( field_name_value.length === 0 ) {
                ajaxCall = false;
                alert('Field name must not be empty!');
            }

        });*/



    });




    if(ajaxCall){

        $.ajax({
            type     :'POST',
            cache    : false,
            data: data,
            url  : 'update-form',
            success  : function(response) {
                //console.log(response);
                var data = JSON.parse(response);

                if(data.id){
                    id = data.id;
                    window.location.replace("view-template?id="+id);
                }
            },
            error: function() {
                alert("There was an error. Try again please!");
            }
        });
    }





});


