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