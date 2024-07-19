// check internet is connected or not
const onl_off_stat = document.querySelector('i.onl_off_status');

setInterval(function() 
{
	if (window.navigator.onLine) 
	{
		// alert('Connection available');
		onl_off_stat.classList.add("online");
		onl_off_stat.classList.remove("offline");
		onl_off_stat.setAttribute('title','Online');
	}
	else 
	{
		// alert('Connection not available');
		onl_off_stat.classList.add("offline");
		onl_off_stat.classList.remove("online");
		onl_off_stat.setAttribute('title','Offline');
	}
}, 1000);