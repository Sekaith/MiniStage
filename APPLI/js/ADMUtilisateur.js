function affiche_DDFPT()
{
document.getElementById('bouton').style.display = 'none';
document.getElementById('formulaire').style.display = 'block';
document.getElementById('titre').innerHTML = 'Ajout d\'un utilisateur DDFPT';
document.getElementById('idprofil').value = '2';
document.getElementById('rattacher').style.display = 'none';
}

function affiche_Prof()
{
document.getElementById('bouton').style.display = 'none';
document.getElementById('formulaire').style.display = 'block';
document.getElementById('titre').innerHTML = 'Ajout d\'un utilisateur Prof';
document.getElementById('idprofil').value = '3';
document.getElementById('etab').style.display = 'none';
document.getElementById('logosign').style.display = 'none';
}

function affiche_Reserv()
{
document.getElementById('bouton').style.display = 'none';
document.getElementById('formulaire').style.display = 'block';
document.getElementById('titre').innerHTML = 'Ajout d\'un utilisateur Reservant';
document.getElementById('idprofil').value = '4';
document.getElementById('rattacher').style.display = 'none';
document.getElementById('logosign').style.display = 'none';
}

function SupprimeUtil(id)
{
	if (confirm("Voulez-vous supprimer l'utilisateur?"))
	 { // Clic sur OK
	
		document.getElementById('td'+id).style.display = 'none';
		
			if (id>0)
			{
				var filterDataRequest = $.ajax({
					url: 'requete/AJAX/ADMsupprime_Util.php',
					type: 'POST',
              	  	data: 'id='+id,
              	 	dataType: 'json'
				});
			
			Command: toastr["success"]("Utilisateur supprimé")
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
}


function SupprimeForm(id)
{
	if (confirm("Voulez-vous supprimer la formation?"))
	 { // Clic sur OK
	
		document.getElementById('td'+id).style.display = 'none';
		
			if (id>0)
			{
				var filterDataRequest = $.ajax({
					url: 'requete/AJAX/ADMsupprime_Form.php',
					type: 'POST',
              	  	data: 'id='+id,
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
}