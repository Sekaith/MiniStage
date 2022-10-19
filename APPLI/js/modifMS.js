function verifplace(nb)
{
	nbO=parseInt(document.getElementById('placeO').innerHTML);
	nbplacereste=parseInt(document.getElementById('placereste').value);
	
	nb=parseInt(nb.value);
	incr=nb-nbO;
	
	if(incr>0)
	{
		nbplacereste=nbplacereste+incr;
		
	}
	else 
	{
	if(incr<0)
		if(nbplacereste>0)
		{
		nbplacereste=nbplacereste+incr;
		}
		else
		{
			nb=nb+1;
			 alert("Impossible de réduire plus le nombre de places car vous avez déja "+nb+" réservations");
			 
			 document.getElementById('place').value=nb.toString();
		}
	}
	document.getElementById('placereste').value= nbplacereste.toString();
	document.getElementById('placeO').innerHTML=nb.toString();
}