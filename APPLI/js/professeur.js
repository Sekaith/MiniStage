function SupprimerProfesseur(id, compte) {

    document.getElementById('td' + id).style.display = 'none';

    if (id > 0) {
        var array = {'id' : id, "compte" : compte}
        var filterDataRequest = $.ajax({
            url: 'requete/AJAX/SupprimerProfesseur.php',
            type: 'POST',
            data: array,
            dataType: 'json'
        });

        Command: toastr["success"]("Professeur supprimé")
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
