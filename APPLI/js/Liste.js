function validReception(id,statut)
{
	
	if(statut=="0")
	{
	
	document.getElementById(id).src="image/confirm1.png";
		
		if (id>0)
		{
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/valid_confirm.php',
				type: 'POST',
                data: 'confirmation='+id,
                dataType: 'json'
				});
		
		document.getElementById(id).onclick= function() { validReception(id,1); };
		document.getElementById(id).title="Annuler la validation";
		document.getElementById('val'+id).innerHTML="1";
		
		
		Command: toastr["success"]("Réception validée")
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
		  "timeOut": "1000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
			}
		}	
	}
	
	else
	{
		if (confirm("Voulez-vous supprimer la confirmation ?"))
	 { // Clic sur OK
		
		document.getElementById(id).src="image/confirm0.png";
		
		if (id>0)
		{
			var filterDataRequest2 = $.ajax({
				url: 'requete/AJAX/Supprime_confirm.php',
				type: 'POST',
                data: 'confirmation='+id,
                dataType: 'json'
				});
		
		document.getElementById(id).onclick=function() { validReception(id,0); };
		document.getElementById(id).title="Valider le mini-stage";
		document.getElementById('val'+id).innerHTML="01";
		
		
		Command: toastr["success"]("Réception supprimée")
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
		  "timeOut": "1000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
			}
		}	
	 }
	}
}

function SupprimeReserv(id)
{
	 
	 if (confirm("Voulez-vous supprimer la reservation?"))
	 { // Clic sur OK
	
		document.getElementById('td'+id).style.display = 'none';
		
			if (id>0)
			{
				var filterDataRequest = $.ajax({
					url: 'requete/AJAX/Supprime_Reserv.php',
					type: 'POST',
              	  	data: 'id='+id,
              	 	dataType: 'json'
				});
			
			Command: toastr["success"]("Réservation supprimée")
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

function SupprimeMS(id,nb)
{
	 
	 if (nb>0)
	 {alert("Vous ne pouvez pas supprimer ce ministage, il existe "+nb+" réservations");}
	 else
	 {
	 
	  if (confirm("Voulez-vous supprimer le ministage?"))
	 { // Clic sur OK
	
		document.getElementById('td'+id).style.display = 'none';
		
			if (id>0)
			{
				var filterDataRequest = $.ajax({
					url: 'requete/AJAX/Supprime_MS.php',
					type: 'POST',
              	  	data: 'id='+id,
              	 	dataType: 'json'
				});
			
			Command: toastr["success"]("Mini-stage supprimée")
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
}

function Rappel(id)
{
	if (confirm("Voulez-vous envoyer un rappel par mail ?"))
	 { // Clic sur OK
	 
	document.getElementById('rap'+id).src="image/mail1.png";
		
		if (id>0)
		{
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/rappel.php',
				type: 'POST',
                data: 'id='+id,
                dataType: 'json'
				});
				
			document.getElementById('rap'+id).onclick= function() {};
			document.getElementById('rap'+id).title="Rappel envoyé";
		
		Command: toastr["success"]("Rappel envoyé")
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
		  "timeOut": "1000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
			}
		}
	 }
}

function absence(id,statut)
{
	
	if(statut=="0")
	{
	if (confirm("Voulez-vous signaler une absence ?"))
	 { // Clic sur OK
	
	document.getElementById('abs'+id).src="image/abs1.png";
		
		if (id>0)
		{
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/signalAbs.php',
				type: 'POST',
                data: 'id='+id,
                dataType: 'json'
				});
		
		document.getElementById('abs'+id).onclick= function() { absence(id,1); };
		
		
		Command: toastr["success"]("Absence signalée")
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
		  "timeOut": "1000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
			}
		}
	}
	}
	
	else
	{
		if (confirm("Voulez-vous supprimer l'absence ?"))
	 { // Clic sur OK
		
		document.getElementById('abs'+id).src="image/abs0.png";
		
		if (id>0)
		{
			var filterDataRequest2 = $.ajax({
				url: 'requete/AJAX/SupAbs.php',
				type: 'POST',
                data: 'id='+id,
                dataType: 'json'
				});
		
		document.getElementById('abs'+id).onclick=function() { absence(id,0); };
		
		Command: toastr["success"]("Absence supprimée")
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
		  "timeOut": "1000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
			}
		}	
	 }
	}
}