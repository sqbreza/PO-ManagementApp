$('.addLine').on("keyup keypress", function(e) {
    var code = e.keyCode || e.which;
    if (code  == 13) {
        e.preventDefault();
        return false;
    }
});

$( "#project_name" ).on('keyup',function() {
    $('#project_name_header').val($('#project_name').val());
});


$('body').on('click', '.delete', function (e) {
    $(this).parents('.eachLine').remove();
});

$('body').on('click', '.add', function (e) {
    var divItem =$(this).parents('.addSection');
    nameOfSectionId = divItem.attr("id");
    $(this).parents('.addLine').after("<div class='addLine'><div class='form-group eachLine'><div class='col-sm-2'><input type='text' name='"+nameOfSectionId+"_field_names[]' class='form-control' /></div><div class='col-sm-3'><input type='text' name='"+nameOfSectionId+"_details[]' class='form-control'/></div><div class='col-sm-2'><input type='text' name='"+nameOfSectionId+"_costs[]' class='costs form-control'/></div><div class='col-sm-1'><input type='text' name='"+nameOfSectionId+"_units[]'class='units form-control' /></div><div class='col-sm-2'><input type='text' name='"+nameOfSectionId+"_total[]' class='total form-control'/></div><div class='col-sm-2'><button class='btn btn-sm btn-danger delete'>Delete</button> <button class='btn btn-sm btn-success add'>Add</button></div></div></div>");
});






$( ".addSection" ).on('keyup','.costs,.units',function() {

    var calc = $('#calculation').val();

    costs = $(this).parents('.eachLine').find('.costs').val();
    units = $(this).parents('.eachLine').find('.units').val();
    if(calc == 'Percentage'){
        percentCost = (costs*units)/100;
        result = parseFloat(percentCost);
        result = result.toFixed(2);
        total = $(this).parents('.eachLine').find('.total').val(result);

    }else {

        result = costs * units;
        result = result.toFixed(2);
        total = $(this).parents('.eachLine').find('.total').val(result);

    }

    section = $(this).parents('.addSection');
    section_id = section.attr('id');

    totalAmount(section_id);
    serviceCharge('check_id_'+section_id);
    grandTotal();

});

$('.addSection').on('keyup','.total',function(){
    section = $(this).parents('.addSection');
    section_id = section.attr('id');

    totalAmount(section_id);
    serviceCharge('check_id_'+section_id);
    grandTotal();

});


$('.addSection').on('keyup','.service_charge',function(){
    section = $(this).parents('.addSection');
    section_id = section.attr('id');

    totalAmount(section_id);
    serviceCharge('check_id_'+section_id);
    grandTotal();

});




$('body').on('click', '#check_id', function (e) {

    grandTotal();

});




$('body').on('click', '.service_charge', function(){
    var sid = $(this).attr('id');
    serviceCharge(sid);
});


function grandTotal(){
    var grand_total =parseFloat( $('#grand_total').val());
    var company_vat =parseFloat( $('#company_vat').val());

    var vat =parseFloat((grand_total * company_vat)/100);
    if ($('#check_id').is(":checked"))
    {
        grand_total = parseFloat(grand_total+vat);
        grand_total = grand_total.toFixed(2);
        $('#grand_total').val(grand_total);

    }else{
        $('#grand_total').val($('#sum_total').val());
    }
}

function totalAmount(section_id){
    var sum = 0;
    $('#'+section_id+' .total').each(function() {
        sum += Number($(this).val());
    });
    sum = sum.toFixed(2);
    $('.'+section_id).val(sum);





    var sum_ = 0;
    $('.section_total').each(function() {
        sum_ += Number($(this).val());
    });

    sum_ = sum_.toFixed(2);
    $('#sum_total').val(sum_);
    $('#grand_total').val(sum_);

    var num2words = new NumberToWords();
    num2words.setMode("bd");
    var bd = num2words.numberToWords(sum_);
    $('#amount_in_words').val(bd);
}

function serviceCharge(sid) {

    id = sid.replace("check_id_", "");
    var scId = 'service_charge_'+id;
    var sc = $('#'+scId).val();
    var subTotalId = id+'_sub_total_no_sc';
    var subTotalWithSCAmount = id+'_sub_total_amount_sc';
    var subTotalWithSCId = id+'_sub_total';
    var subTotal = parseFloat($('#'+subTotalId).val());
    var amount =parseFloat((subTotal * sc)/100);



    if ($('#'+sid).is(":checked"))
    {

        _subTotal = (subTotal + amount);
        $('#'+subTotalWithSCId).val(_subTotal);
        $('#'+subTotalWithSCAmount).val(amount);

    }else{
        $('#'+subTotalWithSCId).val(subTotal);
        $('#'+subTotalWithSCAmount).val(0);
        $('#'+scId).val(0);
    }

    var sum_ = 0;
    $('.section_total').each(function() {
        sum_ += Number($(this).val());
    });

    sum_ = sum_.toFixed(2);

    $('#sum_total').val(sum_);
    $('#grand_total').val(sum_);

    var num2words = new NumberToWords();
    num2words.setMode("bd");
    var bd = num2words.numberToWords(sum_);
    $('#amount_in_words').val(bd);

}


$(document).ready(function(){
    $("textarea").jqte();



    section = $('.addSection');

    $(section).each(function(i,v){
        section_id = $(v).attr('id');
        totalAmount(section_id);
        serviceCharge('check_id_'+section_id);

    });

});

