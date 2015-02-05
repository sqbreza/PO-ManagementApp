$('body').on('click', '.delete', function (e) {
    $(this).parents('.eachLine').remove();
});


$('body').on('click', '.add', function (e) {

    var divItem =$(this).parents('.addSection');
    nameOfSectionId = divItem.attr("id");
    $(this).parents('.addLine').append("<div class='form-group eachLine'><div class='col-sm-3'><input type='text' name='"+nameOfSectionId+"_field_names[]' class='form-control' /></div><div class='col-sm-3'><input type='text' name='"+nameOfSectionId+"_details[]' class='form-control'/></div><div class='col-sm-1'><input type='text' name='"+nameOfSectionId+"_costs[]' class='costs form-control'/></div><div class='col-sm-1'><input type='text' name='"+nameOfSectionId+"_units[]'class='units form-control' /></div><div class='col-sm-2'><input type='text' name='"+nameOfSectionId+"_total[]' class='total form-control'/></div><div class='col-sm-2'><button class='btn btn-sm btn-danger delete'>Delete</button> <button class='btn btn-sm btn-success add'>Add</button></div></div>");
});





$( "#project_name" ).on('keyup',function() {
    $('#project_name_header').val($('#project_name').val());
});


/*$( ".addSection" ).on('keyup','.costs,.units',function() {
    costs = $(this).parents('.eachLine').find('.costs').val();
    units = $(this).parents('.eachLine').find('.units').val();
    percentCost = (costs*units)/100;
    result = parseFloat(costs)+parseFloat(percentCost);
    total = $(this).parents('.eachLine').find('.total').val(result);

    section = $(this).parents('.addSection');
    section_id = section.attr('id');

    var sum = 0;
    $('#'+section_id+' .total').each(function() {
        sum += Number($(this).val());
    });
    $('.'+section_id).val(sum);



    var sum_ = 0;
    $('.section_total').each(function() {
        sum_ += Number($(this).val());
    });

    $('#sum_total').val(sum_);
    $('#grand_total').val(sum_);

    var num2words = new NumberToWords();
    num2words.setMode("bd");
    var bd = num2words.numberToWords(sum_);
    $('#amount_in_words').val(bd);

});*/


$( ".addSection" ).on('keyup','.costs,.units',function() {
    costs = $(this).parents('.eachLine').find('.costs').val();
    units = $(this).parents('.eachLine').find('.units').val();
    total = $(this).parents('.eachLine').find('.total').val(costs*units);
    section = $(this).parents('.addSection');
    section_id = section.attr('id');

    var sum = 0;
    $('#'+section_id+' .total').each(function() {
        sum += Number($(this).val());
    });
    $('.'+section_id).val(sum);



    var sum_ = 0;
    $('.section_total').each(function() {
        sum_ += Number($(this).val());
    });

    $('#sum_total').val(sum_);
    $('#grand_total').val(sum_);

    var num2words = new NumberToWords();
    num2words.setMode("bd");
    var bd = num2words.numberToWords(sum_);
    $('#amount_in_words').val(bd);

});


/*
$( ".addSection" ).on('keyup','.units',function() {
    costs = $(this).parents('.eachLine').find('.costs').val();
    units = $(this).parents('.eachLine').find('.units').val();
    total = $(this).parents('.eachLine').find('.total').val(costs*units);
    section = $(this).parents('.addSection');
    section_id = section.attr('id');

    var sum = 0;
    $('#'+section_id+' .total').each(function() {
        sum += Number($(this).val());
    });
    $('.'+section_id).val(sum);

    var sum_ = 0;

    $('.section_total').each(function() {
        sum_ += Number($(this).val());
    });

    $('#sum_total').val(sum_);
    $('#grand_total').val(sum_);
    var num2words = new NumberToWords();
    num2words.setMode("bd");
    var bd = num2words.numberToWords(sum_);
    $('#amount_in_words').val(bd);

});

$('#sum_total').keyup(function(e){
    var num2words = new NumberToWords();
    num2words.setMode("bd");
    var bd = num2words.numberToWords($(this).val());
    $('#amount_in_words').val(bd);
});
*/



$('body').on('click', '#check_id', function (e) {
    var grand_total =parseInt( $('#grand_total').val());
    var vat =parseInt((grand_total * 15)/100);
    if ($('#check_id').is(":checked"))
    {
        grand_total = parseInt(grand_total+vat);
        $('#grand_total').val(grand_total);

    }else{
        $('#grand_total').val($('#sum_total').val());
    }

});

