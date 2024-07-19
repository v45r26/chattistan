const form = document.querySelector(".bott-box form"),
	  inputField = form.querySelector("#inputField"),
	  sendBtn = form.querySelector("button"),
	  chatBox = document.querySelector(".chat-box"),
	  go_t_B = document.querySelector("#go_t_B"),
	  no_of_chat = document.querySelector('.no_of_chat');

go_t_B.style.display = 'none';

form.onsubmit = (e)=>
{
	e.preventDefault();// prevent from form submitting
}
sendBtn.onclick = ()=>
{
	// let's start AJAX
	let xhr = new XMLHttpRequest(); //crweating XML object
	xhr.open('POST','../php/insert_chat.php',true);
	xhr.onload = ()=>
	{
		if (xhr.readyState === XMLHttpRequest.DONE) 
		{
			if (xhr.status === 200) 
			{
				// let data = xhr.response;
				// console.log(data);
				inputField.value = "";
				scrollToBottom();
			}
		}
	}
	let formData = new FormData(form); //creating new formData object
	xhr.send(formData); // sending the form data to php
}

chatBox.onmouseenter = ()=>
{
	chatBox.classList.add('active');
}
chatBox.onmouseleave = ()=>
{
	chatBox.classList.remove('active');
}

setInterval(()=>
{
	// let's start AJAX
	let xhr = new XMLHttpRequest(); //crweating XML object
	xhr.open('POST','../php/get_chat.php',true);
	xhr.onload = ()=>
	{
		if (xhr.readyState === XMLHttpRequest.DONE) 
		{
			if (xhr.status === 200) 
			{
				let data = xhr.response;
				// console.log(data);
				chatBox.innerHTML = data;

				if (!chatBox.classList.contains("active"))
				{
					scrollToBottom();
				}
			}
		}
	}
	let formData = new FormData(form); //creating new formData object
	xhr.send(formData);
},500); // this function will run every 0.5 sec frequently


function scrollToBottom() 
{
	chatBox.scrollTop = chatBox.scrollHeight;
}

chatBox.onscroll = ()=>
{
	var distanceScrolled = chatBox.scrollTop;
    console.log('Scrolled: ' + distanceScrolled);
	if (chatBox.scrollTop == chatBox.scrollHeight) 
	{
		go_t_B.style.display = 'block';
	}
	else
	{
		go_t_B.style.display = 'none';
	}
}
go_t_B.onclick =()=>
{
	scrollToBottom();
}
