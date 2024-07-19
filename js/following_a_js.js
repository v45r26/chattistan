const resSF = document.querySelector('.bottom-sec .res-success-fail span'); 
function inc_follow_m(val)
{
	a = val.value;
	// console.log(a);

	// let's start AJAX
	let xhr = new XMLHttpRequest();
	xhr.open("GET","php/inc_follow_m.php?u_id="+a,true);
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
					resSF.innerText = data+'!';
					resSF.textContent = data+'!';
					val.style.display = "none"; // after following display none
					//self.frames['file_op'].location.href = 'if_data/view_profile.php?v_pro='+a;	
				}
				else
				{
				 	resSF.innerText = data+'!';
					resSF.textContent = data+'!';				
				}
			}
		}
	}
	// let formData = new FormData(form);
	xhr.send();
}