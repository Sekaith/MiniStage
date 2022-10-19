$("#date").datetimepicker({
	format: "dd-mm-yyyy",
	todayHighlight : true,
	initialDate : new Date(),
	autoclose: true,
	minView:"month",
});

$("#heure1").datetimepicker({
            format: "hh:ii",
            autoclose: true,
            startView: "day",
            minView: "hour",
            maxView:"day",
        });

$("#heure2").datetimepicker({
            format: "hh:ii",
            autoclose: true,
            startView: "day",
            minView: "hour",
            maxView:"day",
});

function surligne(champ, erreur)
{
   if(erreur){
      champ.style.backgroundColor = "#fba";
   }else{
      champ.style.backgroundColor = "";
   }
}

function MAJ(str)
{
	var STR=str.value.toUpperCase();
	str.value=STR;
}

function verifList(list)
{
	if(list.value ==-1)
	{
	  surligne(list, true);
      return false;
	}
	else
	{
	 surligne(list, false);
     return true;
   }
}

function verifChaine(champ)
{
   var regex = /^([a-zA-Z'àâéèêôùûçÀÂÉÈÔÙÛÇ()-\s]{1,30})$/;
   
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifNB(champ)
{
	var regex = /^[1-9]{1,1}[0-9]{0,1}$/;	
	
	if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function Maj(str)
{
	var Str=str.value.substring(0,1).toUpperCase() + str.value.substring(1).toLowerCase();
	str.value=Str;
}

function verifTel(champ)
{
   var regex = /^0[0-9]([ .-]?[0-9]{2}){4}$/;  
   if(!regex.test(champ.value))
   {
	  surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }

}

function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;

   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifCP(champ)
{
	var regex = /^[0-9]{5,5}$/;	
	
	if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifRNE(champ)
{
	var regex = /^[0-9]{7,7}[A-Z]{1,1}$/;	
	
	if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function validRNE1()
{
	var valid=true;
	if (!verifRNE(document.forms["FormInscription"].elements["rne"]) || document.forms["FormInscription"].elements["rne"].value == "")
	{
		alert ( "Veuillez entrer un RNE correct !"  );
        valid = false;
		return valid;
	}	
	return true;
	
}


function validRNE2()
{
	var valid=true;
	if (!verifRNE(document.forms["FormOublie"].elements["rne"]) || document.forms["FormOublie"].elements["rne"].value == "")
	{
		alert ( "Veuillez entrer un RNE correct !"  );
        valid = false;
		return valid;
	}	
	return true;
	
}

/************************************************validation des forumaires**********************************/

function validerCreer()
{
if (document.forms["formulaireCreerMS"].elements["date"].value == "")
	{
    	alert ( "Veuillez entrer une date");
        valid = false;
		return valid;
	}
	
else if((document.forms["formulaireCreerMS"].elements["heure1"].value)>=(document.forms["formulaireCreerMS"].elements["heure2"].value))
   {
	  alert ( "Veuillez entrer un créneaux correcte");
	  valid = false;
	  return valid;
   }
   
else if (!verifNB(document.forms["formulaireCreerMS"].elements["place"]) || document.forms["formulaireCreerMS"].elements["place"].value == "")
	{
		alert ( "Veuillez entrer un nombre de place correcte!"  );
        valid = false;
		return valid;
	}
	
else if (!verifList(document.forms["formulaireCreerMS"].elements["formation"]))
	{
		alert ( "Veuillez choisir une formation !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifList(document.forms["formulaireCreerMS"].elements["civilite"]))
	{
		alert ( "Veuillez choisir une civilité !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["formulaireCreerMS"].elements["nomprof"]) || document.forms["formulaireCreerMS"].elements["nomprof"].value == "")
	{
		alert ( "Veuillez entrer un nom de professeur correct !"  );
        valid = false;
		return valid;
	}

	return true;
}

function validerModifMS()
{
if (document.forms["formulairemodifMS"].elements["date"].value == "")
	{
    	alert ( "Veuillez entrer une date");
        valid = false;
		return valid;
	}
	
else if((document.forms["formulairemodifMS"].elements["heure1"].value)>=(document.forms["formulairemodifMS"].elements["heure2"].value))
   {
	  alert ( "Veuillez entrer un créneaux correcte");
	  valid = false;
	  return valid;
   }
   
else if (!verifNB(document.forms["formulairemodifMS"].elements["place"]) || document.forms["formulairemodifMS"].elements["place"].value == "")
	{
		alert ( "Veuillez entrer un nombre de place correcte!"  );
        valid = false;
		return valid;
	}
	
else if (!verifList(document.forms["formulairemodifMS"].elements["formation"]))
	{
		alert ( "Veuillez choisir une formation !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifList(document.forms["formulairemodifMS"].elements["civilite"]))
	{
		alert ( "Veuillez choisir une civilité !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["formulairemodifMS"].elements["nomprof"]) || document.forms["formulairemodifMS"].elements["nomprof"].value == "")
	{
		alert ( "Veuillez entrer un nom de professeur correct !"  );
        valid = false;
		return valid;
	}

	return true;
}

function validerProfil()
{
var valid=true;
    if ( document.forms["formulaireProfil"].elements["mdp"].value == "" )
    {
        alert ( "Veuillez entrer un mot de passe !" );
        valid = false;
		return valid;
    }
	
	else if (!verifChaine(document.forms["formulaireProfil"].elements["nom"]) || document.forms["formulaireProfil"].elements["nom"].value == "")
	{
		alert ( "Veuillez entrer un nom correct !"  );
        valid = false;
		return valid;
	}
		
	else if (!verifChaine(document.forms["formulaireProfil"].elements["prenom"]) || document.forms["formulaireProfil"].elements["prenom"].value == "")
	{
		alert ( "Veuillez entrer un prénom correct !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifMail(document.forms["formulaireProfil"].elements["mail"]) || document.forms["formulaireProfil"].elements["mail"].value == "")
	{
		alert ( "Veuillez entrer un email correct !"  );
        valid = false;
		return valid;
	}
		
	else if (!verifTel(document.forms["formulaireProfil"].elements["tel"]) || document.forms["formulaireProfil"].elements["tel"].value == "")
	{
		alert ( "Veuillez entrer un numéro de téléphone correct !"  );
        valid = false;
		return valid;
		}
				
	return true;
}	

function validerEtab()
{
var valid=true;
	
	if (!verifChaine(document.forms["formulaireEtab"].elements["nom"]) || document.forms["formulaireEtab"].elements["nom"].value == "")
	{
		alert ( "Veuillez entrer un nom correct !"  );
        valid = false;
		return valid;
	}
		
	else if (document.forms["formulaireEtab"].elements["rne"].value == "")
	{
		alert ( "Veuillez entrer un RNE !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["formulaireEtab"].elements["ville"]) || document.forms["formulaireEtab"].elements["ville"].value == "")
	{
		alert ( "Veuillez entrer une ville correct !"  );
        valid = false;
		return valid;
	}
		
	else if (!verifCP(document.forms["formulaireEtab"].elements["cp"]) || document.forms["formulaireEtab"].elements["cp"].value == "")
	{
		alert ( "Veuillez entrer un code postal correct !"  );
        valid = false;
		return valid;
	}
		
	else if (document.forms["formulaireEtab"].elements["adresse"].value == "")
	{
		alert ( "Veuillez entrer une adresse correct !"  );
        valid = false;
		return valid;
	}
	
	else if (document.forms["formulaireEtab"].elements["mail"].value == "")
	{
		alert ( "Veuillez entrer une adresse email"  );
        valid = false;
		return valid;
	}
				
	return true;
}

function validerInscription()
{
var valid=true;
    if ( document.forms["FormInscription"].elements["rne"].value == "" )
    {
        alert ( "Veuillez entrer un RNE !(retournez à l'index=" );
        valid = false;
		return valid;
    }
	
	else if (!verifList(document.forms["FormInscription"].elements["academie"]))
	{
		alert ( "Veuillez choisir une académie !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifList(document.forms["FormInscription"].elements["type"]))
	{
		alert ( "Veuillez choisir un type d'établissement !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["FormInscription"].elements["etab"]) || document.forms["FormInscription"].elements["etab"].value == "")
	{
		alert ( "Veuillez entrer un nom d'établissement correct !"  );
        valid = false;
		return valid;
	}
	
	else if ( document.forms["FormInscription"].elements["adresse"].value == "" )
    {
        alert ( "Veuillez entrer une adresse !(retournez à l'index=" );
        valid = false;
		return valid;
    }
		
	else if (!verifCP(document.forms["FormInscription"].elements["cp"]) || document.forms["FormInscription"].elements["cp"].value == "")
	{
		alert ( "Veuillez entrer un code postal correct !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["FormInscription"].elements["ville"]) || document.forms["FormInscription"].elements["ville"].value == "")
	{
		alert ( "Veuillez entrer une ville correct !"  );
        valid = false;
		return valid;
	}
		
	else if (!verifChaine(document.forms["FormInscription"].elements["nom"]) || document.forms["FormInscription"].elements["nom"].value == "")
	{
		alert ( "Veuillez entrer un nom correct !"  );
        valid = false;
		return valid;
		}
		
	else if (!verifChaine(document.forms["FormInscription"].elements["prenom"]) || document.forms["FormInscription"].elements["prenom"].value == "")
	{
		alert ( "Veuillez entrer un prenom correct !"  );
        valid = false;
		return valid;
		}
		
		else if (!verifList(document.forms["FormInscription"].elements["fonction"]))
	{
		alert ( "Veuillez choisir une fonction !"  );
        valid = false;
		return valid;
	}
		
		else if (!verifMail(document.forms["FormInscription"].elements["mail"]) || document.forms["FormInscription"].elements["mail"].value == "")
	{
		alert ( "Veuillez entrer un Mail correct !"  );
        valid = false;
		return valid;
		}
		
		else if (!verifTel(document.forms["FormInscription"].elements["tel"]) || document.forms["FormInscription"].elements["tel"].value == "")
	{
		alert ( "Veuillez entrer un numéro de téléphone correct !"  );
        valid = false;
		return valid;
		}
				
	return true;
}	

function validerReserver()
{
	var valid=true;
	
	if (!verifChaine(document.forms["formulaireReserver"].elements["nom"]) || document.forms["formulaireReserver"].elements["nom"].value == "")
	{
		alert ( "Veuillez entrer un nom correct !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["formulaireReserver"].elements["prenom"]) || document.forms["formulaireReserver"].elements["prenom"].value == "")
	{
		alert ( "Veuillez entrer un prénom correct !"  );
        valid = false;
		return valid;
	}
	else if(document.forms["formulaireReserver"].elements["mini"].value<1)
	{
		alert ( "Veuillez choisir un créneaux disponible"  );
        valid = false;
		return valid;
	}
				
	return true;
	}
		
function validerReserverChef()
{
	var valid=true;
	
	if (!verifChaine(document.forms["formulaireReservChef"].elements["nomR"]) || document.forms["formulaireReservChef"].elements["nom"].value == "")
	{
		alert ( "Veuillez entrer un nom correct !"  );
        valid = false;
		return valid;
	}
	
	else if (!verifChaine(document.forms["formulaireReservChef"].elements["prenomr"]) || document.forms["formulaireReservChef"].elements["prenom"].value == "")
	{
		alert ( "Veuillez entrer un prénom correct !"  );
        valid = false;
		return valid;
	}
	
	else if(document.forms["formulaireReservChef"].elements["miniR"].value<1)
	{
		alert ( "Veuillez choisir un créneaux disponible"  );
        valid = false;
		return valid;
	}
				
	return true;
	}