$('body').on('click', '#save', function (e) {


   /* var client = new XMLHttpRequest();

    function upload()
    {
        var file = document.getElementById("fileToUpload");

        *//* Create a FormData instance *//*
        var formData = new FormData();
        *//* Add the file *//*
        formData.append("upload", file.files[0]);

        client.open("post", "/ice9/web/uploads", true);
        client.setRequestHeader("Content-Type", "multipart/form-data");
        client.send(formData);  *//* Send to server *//*
    }

    *//* Check the response status *//*
    client.onreadystatechange = function()
    {
        if (client.readyState == 4 && client.status == 200)
        {
            alert(client.statusText);
        }
    }
*/


   // upload();

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


    //var data = $('form').serialize();
   /* $.ajax({
        type     :'POST',
        cache    : false,
        data: data,
        contentType:'multipart/form-data',
        url  : 'form',
        success  : function(response) {
            console.log(response);
        }
    });*/
});