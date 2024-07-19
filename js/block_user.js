function block_user()
{	
	const b_btn = document.querySelector('#scc'),
		  b_uid = b_btn.value,
		  inputField = document.querySelector('#inputField');

	let xhr = new XMLHttpRequest();
	xhr.open('GET','../php/block_user.php?b_uid='+b_uid,true);
	xhr.onload = () =>
	{
		if (xhr.readyState === XMLHttpRequest.DONE) 
		{
			if (xhr.status === 200) 
			{
				let data = xhr.response;
				// console.log(data);
				if (data == 'blocked') 
				{
					// alert('blocked');
					b_btn.innerText = 'Unblock';
					b_btn.textContent = 'Unblock';
					location = '';
				}
				else if(data == 'unblocked')
				{
					b_btn.innerText = 'Block';
					b_btn.textContent = 'Block';
					location = '';
				}
			}
		}
	}
	xhr.send();
}