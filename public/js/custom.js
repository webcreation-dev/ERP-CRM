
function articleAmount(puId, qteId, amoutId)
{
	qte = document.getElementById(qteId).value;
	price = document.getElementById(puId).value;
	if((qte !='') && (price !='')){
	    amount = parseInt(qte) * parseFloat(price);
		document.getElementById(amoutId).value= amount;
	}

}

function optionTotAmount(quotaId,durationId)
{
	quota = document.getElementById(quotaId).value;
	duration = document.getElementById(durationId).value;

	if((quota !='') && (duration !='')){
	    amount = parseInt(quota) * parseInt(duration);
		document.getElementById('optionAmoutId').innerHTML=amount;
	}

}


function deleteConfirmation()
{
	var ok = confirm("Veuillez confirmer la suppression !");
	if(ok){
		return true;
	}else{
		return false;
	}
}

function regulationConfirmation()
{
	var ok = confirm("Veuillez confirmer la régularisation de cette facture !");
	if(ok){
		return true;
	}else{
		return false;
	}
}



function paiementConfirmation()
{
	var ok = confirm("Veuillez bien verifier les informations de paiment !");
	if(ok){
		return true;
	}else{
		return false;
	}
}

function balanceConfirmation()
{
	var ok = confirm("Etes vous sur de vouloir procéder ?");
	if(ok){
		return true;
	}else{
		return false;
	}
}


function controleSolde()
{
	oldSolde = parseFloat(document.getElementById('accountSoldeInput').value);
	amount = parseFloat(document.getElementById('operationAmount').value);
	opType = parseInt(document.getElementById('operationType').value);


	if(opType==0){

		if(oldSolde < amount){
			alert('Solde insuffisant pour faire l\'operation de retrait')	;
			return false;
		}else{
			return true;
		}

	}
}

function depositorSetDefaultValue(obj) {
	if(obj.checked==true)	{
		document.getElementById('depositor').value ="Lui-même";
	}else{
	 document.getElementById('depositor').value ="";
	}
}

//Control Room Control Form

function depositorSetDefaultValue(obj) {
	if(obj.checked==true)	{
		document.getElementById('depositor').value ="Lui-même";
	}else{
	 document.getElementById('depositor').value ="";
	}
}


