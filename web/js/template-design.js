var sectionId =1;
$('#add').click(function (e) {

    $('#items').append("<div><input type='text' name='section0_field_name[]' class='form-control template-input-design'><button class='delete btn-sm btn-danger'>Delete</button></div>");

});

$('#addSection').click(function (e) {


    $('#addSectionDiv').append("<div class='template-section' id='section"+sectionId+"'><button style='float:right;' class='deleteSection btn-sm btn-danger'>&#10006;</button><label class='form-control'>Section Name:</label><input type='text' name='section_name[]' class='form-control template-input-design'><button class='add btn btn-primary btn-sm'>Add Field</button><div class='items form-group'> <div><label class='form-control'>Fields Name:</label></div></div></div>");
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
        $.ajax({
            type     :'POST',
            cache    : false,
            data: data,
            url  : 'form',
            success  : function(response) {
               console.log(response);
            }
        });


});


$('#templateForm').on('click', '#formUpdate', function (e) {

    var data = $('form').serialize();
    $.ajax({
        type     :'POST',
        cache    : false,
        data: data,
        url  : 'update-form',
        success  : function(response) {
            console.log(response);
        }
    });


});


