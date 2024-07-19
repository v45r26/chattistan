const searchbar = document.querySelector('#searchBar'),
	  gen_s_btn = document.querySelector('#gen_btn'),
	  frnd_s_btn = document.querySelector('#frnd_btn'),
	  userList = document.querySelector('.s-b-user-list#userList');

searchbar.onkeyup = ()=>
{
	gen_s_btn.classList.add('stop');
	frnd_s_btn.classList.add('stop');
	searchbar.classList.add('lola');
	let searchTerm = searchbar.value;
	// let's start AJAX
	if (searchTerm != '') 
	{
		let xhr = new XMLHttpRequest(); //crweating XML object
		xhr.open('POST','php/searchUser.php',true);
		xhr.onload = ()=>
		{
			if (xhr.readyState === XMLHttpRequest.DONE) 
			{
				if (xhr.status === 200) 
				{
					let data = xhr.response;
					// console.log(data);
					userList.innerHTML = data;
				}
			}
		}
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send('searchTerm=' + searchTerm); 
	}
	else
	{
		searchbar.classList.remove('lola');
	}
}