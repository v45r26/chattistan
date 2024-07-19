const form = document.querySelector('.form.login form.login-form'),
	  subBtn = form.querySelector('.field.button input[type="submit"]'),
	  errTxt = form.querySelector('.error-txt');

form.onsubmit = (e)=>
{
	e.preventDefault();// prevent from form submitting
}

subBtn.onclick = ()=>
{
	// let's start AJAX
	let xhr = new XMLHttpRequest();
	xhr.open('POST','../php/login_php.php',true);
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
					window.location = "../index.php";
				}
				else
				{
					errTxt.innerText = data;
					errTxt.textContent = data;
					errTxt.style.display = "block";
				}
			}
		}
	}
	let formData = new FormData(form);
	xhr.send(formData);
}