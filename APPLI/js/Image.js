function AjouterLogo(idetab) {

    var file_data = document.getElementById("image_uploadsLogo").files[0]
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('idetab', idetab);


    var filterDataRequest = $.ajax({
        url: 'requete/AJAX/AjouterImageLogo.php',
        type: 'POST',
        data: form_data,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
    });

    Command: toastr["success"]("Image sauvegardé !")
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "1500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


}

function AjouterSignature(idetab) {

    var file_data = document.getElementById("image_uploadsSignature").files[0]
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('idetab', idetab);

    var filterDataRequest = $.ajax({
        url: 'requete/AJAX/AjouterImageSignature.php',
        type: 'POST',
        data: form_data,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
    });

    Command: toastr["success"]("Image sauvegardé !")
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "1500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


}

