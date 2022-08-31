function enviar(){
	console.log(document.querySelector("#email").value)
	if(document.querySelector("#email").value == document.querySelector("#conf_email").value){
		if(document.querySelector("#senha").value == document.querySelector("#conf_senha").value){
			if(document.querySelector("#senha").value.length >= 6){
				document.querySelector("#form").submit();
			}else{
				alert("A senha precisa ter no mínimo 6 caracteres");
			}
		}else{
			alert("Senhas incompativeis!");
		}
	}else{
		alert("E-mails incompativeis!");
	}
}