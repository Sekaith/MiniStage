function SupprimeFormation(id, compte) {

    document.getElementById('td' + id).style.display = 'none';

    if (id > 0) {
        var filterDataRequest = $.ajax({
            url: 'requete/AJAX/SupprimerFormation.php',
            type: 'POST',
            data: ['id=' + id, "compte=" + compte],
            dataType: 'json'
        });

        Command: toastr["success"]("Formation supprimée")
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


}
