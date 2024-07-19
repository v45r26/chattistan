const searchBar = document.querySelector('#searchBar'),
	  gen_btn = document.querySelector('#gen_btn'),
	  frnd_btn = document.querySelector('#frnd_btn'),
	  usersList = document.querySelector('#userList');

if (!gen_btn.classList.contains('stop')) 
{
	run_d_function();
}
function run_d_function()
{
	setInterval(()=>
	{
		if (!gen_btn.classList.contains('stop')) 
		{
			// let's start AJAX
			let xhr = new XMLHttpRequest(); //creating XML object
			xhr.open('GET','php/view_user.php?fltr=gen',true);
			xhr.onload = ()=>
			{
				if (xhr.readyState === XMLHttpRequest.DONE) 
				{
					if (xhr.status === 200) 
					{
						let data = xhr.response;
						//console.log(data);
						if (!searchBar.classList.contains("lola")) 
						{
							usersList.innerHTML = data;
						}
					}
				}
			}
			xhr.send(); 
		}
	},500);
}

function run_fl_frnd()
{
	setInterval(()=>
	{
		if (!frnd_btn.classList.contains('stop')) 
		{
			let xhr = new XMLHttpRequest(); //crweating XML object
			xhr.open('GET','php/view_user.php?fltr=frnd',true);
			xhr.onload = ()=>
			{
				if (xhr.readyState === XMLHttpRequest.DONE) 
				{
					if (xhr.status === 200) 
					{
						let data = xhr.response;
						// console.log(data);
						if (!frnd_btn.classList.contains('stop')) 
						{
							usersList.innerHTML = data;
						}
					}
				}
			}
			xhr.send();
		}
	},500)
}
function fltr_gen() 
{
	gen_btn.classList.remove('stop');
	frnd_btn.classList.add('stop');
	if (!gen_btn.classList.contains('stop')) 
	{
		run_d_function();
	}
}
function fltr_frnd() 
{
	frnd_btn.classList.remove('stop');
	gen_btn.classList.add('stop');
	if (!frnd_btn.classList.contains('stop')) 
	{
		run_fl_frnd();
	}
}