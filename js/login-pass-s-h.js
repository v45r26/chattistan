const pswrdField_0 = document.querySelector('#input-passwrd_0'),
	  toggleBtn_0 = document.querySelector('#tglBtn_0');

toggleBtn_0.onclick = function()
{
	if (pswrdField_0.type == "password") 
	{
		pswrdField_0.type = "text";
		toggleBtn_0.classList.add('active');
	}
	else
	{
		pswrdField_0.type = "password";
		toggleBtn_0.classList.remove('active');
	}
}