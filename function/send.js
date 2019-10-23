var xml, errorLabel;

window.onload = function(){
	errorLabel = document.getElementsByTagName("span")[0];
};

function startUpload(){
	
	xml = new XMLHttpRequest();
	
	if (xml){
		var fData = new FormData();
		fData.append('file', document.getElementById('file').files[0]);
		
		xml.open('POST', 'upload.php', true);
		xml.upload.addEventListener("progress", progress, false);
		xml.onreadystatechange = function(){
			if (xml.readyState == 4){
				console.log(xml.responseText);
				errorLabel.style.opacity = 0;
				window.setTimeout(function(){
					errorLabel.innerHTML = xml.responseText;
					errorLabel.style.opacity = 1;
				}, 500);
			}
		};
		
		xml.send(fData);
	}
	
}

function progress(e){
	
	var percent = ((e.loaded / e.total) * 100).toFixed(2);
	document.getElementById('progress').style.width = percent + "%";
	
}