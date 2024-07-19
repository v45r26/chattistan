const pswrdField_0 = document.querySelector('#input-passwrd_0'),
	  toggleBtn_0 = document.querySelector('#tglBtn_0'),
	  pswrdField_1 = document.querySelector('#input-passwrd_1'),
	  toggleBtn_1 = document.querySelector('#tglBtn_1');

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
toggleBtn_1.onclick = function()
{
	if (pswrdField_1.type == "password") 
	{
		pswrdField_1.type = "text";
		toggleBtn_1.classList.add('active');
	}
	else
	{
		pswrdField_1.type = "password";
		toggleBtn_1.classList.remove('active');
	}
}