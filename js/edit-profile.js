const form = document.querySelector('.edit-form-box form'),
	  subBtn = form.querySelector('#subBtn'),
	  errTxt = document.querySelector('.res-success-fail span'),
	  i_frame = document.querySelector('#i-frame');

form.onsubmit = (e)=>
{
	e.preventDefault();// prevent from form submitting
}
subBtn.onclick = ()=>
{
	// let's start AJAX
	let xhr = new XMLHttpRequest();
	xhr.open('POST','../php/edit-profile.php',true);
	xhr.onload = ()=>
	{
		if (xhr.readyState === XMLHttpRequest.DONE)
		{
			if (xhr.status === 200) 
			{
				let data = xhr.response;
				// console.log(data);
				if (data == 'success') 
				{
					reload_iframe();
					errTxt.innerText = data;
					errTxt.textContent = data;
				}
				else
				{
					errTxt.innerText = data;
					errTxt.textContent = data;
				}				
			}
		}
	}
	// we hae to send the form data through AJAX to php
	let formData = new FormData(form); //creating new formData object
	xhr.send(formData); // sending the form data to php
}

function reload_iframe()
{
	i_frame.contentWindow.location.reload(true);
} // when we want to reload
