function affiche_Etab()//Recherche par Etab
{
document.getElementById('bouton').style.display = 'none';
document.getElementById('champEtab').style.display = 'block';
document.getElementById('champ').style.display = 'block';
document.getElementById('titre').innerHTML = 'Recherche par établissement';
}

function charge_form()//Recherche par Etab
{		//recup idutilisateur
		$('#etablissement option[value=-1]').remove();
		$('#mini option').remove();
		$('#mini').append('<option value="-1">--Séléctionner un créneau--</option>');
        select = document.getElementById("etablissement");
		choice = select.selectedIndex;
 		ID = select.options[choice].value;
		document.getElementById('champForm').style.display = 'block';
		
		if (ID>0)
		{
			$('#formation').empty();
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/charge_Form.php',
				type: 'POST',
                data: 'etablissement='+ID,
                dataType: 'json'
				});
				
				
				filterDataRequest.done(function(data) {
				$('#formation').append('<option value="-1">--Séléctionner une formation--</option>');
            	$.each(data, function(index, value) {
                $('#formation').append('<option value="'+ index +'">'+ value +'</option>');
                });	
				});
		}	
}

function charge_mini()//Recherche par Etab
{		
		
		document.getElementById('champMini').style.display = 'block';
		
			$('#mini').empty();
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/charge_mini.php',
				type: 'POST',
                data: $('#formulaireReserver').serialize(),
                dataType: 'json'
				});
				
				
				filterDataRequest.done(function(data) {
				$('#mini').append('<option value="-1">--Séléctionner un créneau--</option>');
            	$.each(data, function(index, value) {
                $('#mini').append(value);
                });	
				});
}

function affiche_Form()//Recherche par formation
{
document.getElementById('bouton').style.display = 'none';
document.getElementById('champForm2').style.display = 'block';
document.getElementById('champ').style.display = 'block';
document.getElementById('titre').innerHTML = 'Recherche par Formation';
}

function charge_Etab()//Recherche par formation
{		//recup idutilisateur
		$('#formation2 option[value=-1]').remove();
		$('#mini option').remove();
		$('#mini').append('<option value="-1">--Séléctionner un créneau--</option>');
        select = document.getElementById("formation2");
		choice = select.selectedIndex;
 		ID = select.options[choice].value;
		document.getElementById('champEtab2').style.display = 'block';
		
		if (ID>0)
		{
			$('#etablissement2').empty();
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/charge_Etab.php',
				type: 'POST',
                data: 'formation='+ID,
                dataType: 'json'
				});
				
				filterDataRequest.done(function(data) {
				$('#etablissement2').append('<option value="-1">--Séléctionner un établissement--</option>');
            	$.each(data, function(index, value) {
                $('#etablissement2').append('<option value="'+ index +'">'+ value +'</option>');
                });	
				});
		}	
}

function charge_mini2()//Recherche par formation
{		
		
		document.getElementById('champMini').style.display = 'block';
		
			$('#mini').empty();
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/charge_mini.php',
				type: 'POST',
                data: $('#formulaireReserver').serialize(),
                dataType: 'json'
				});
				
				
				filterDataRequest.done(function(data) {
				$('#mini').append('<option value="-1">--Séléctionner un créneau--</option>');
            	$.each(data, function(index, value) {
                $('#mini').append(value);
                });	
				});
				console.log($('#mini'));
}

function charge_inscription()
{
	document.getElementById('inscription').style.visibility = 'visible';
	$('#mini option[value=-1]').remove();
}

function charge_mini3()//Recherche par un chef de travaux
{		
	$('#formationR option[value=-1]').remove();
		
		document.getElementById('champMiniR').style.display = 'block';
			$('#miniR').empty();
			var filterDataRequest = $.ajax({
				url: 'requete/AJAX/charge_mini.php',
				type: 'POST',
                data: $('#formulaireReservChef').serialize(),
                dataType: 'json'
				});
				
				
				filterDataRequest.done(function(data) {
				$('#miniR').append('<option value="-1">--Séléctionner un créneau--</option>');
            	$.each(data, function(index, value) {
                $('#miniR').append(value);
                });	
				});
}

function charge_inscriptionR()
{
	document.getElementById('inscriptionR').style.visibility = 'visible';
	$('#miniR option[value=-1]').remove();
}

function BTN_autre()
{
	if (document.getElementById('autre').checked) 
	{
  	    document.getElementById('etablissementR').style.display="none";
	  } else {
     	 document.getElementById('etablissementR').style.display="block";
  	}
}