const d_time_block = document.querySelector('#d_time_block.d_time_block'),
	  t_dis = document.querySelector('#t_dis'),
	  d_date_block = document.querySelector('#d_date_block.d_date_block'),
	  d_dis = document.querySelector('#d_dis');
function showTime(){
	var date = new Date();
	var h = date.getHours(); // Houers 0 - 23
	var m = date.getMinutes(); // Minutes 0 - 59
	var s = date.getSeconds(); // Seconds 0 - 59
	var d = date.getDate(); // Date 1-31
	var mo = date.getMonth() + 1; // Months 0 - 11
	var y = date.getFullYear(); // Year YYYY
	var session = "AM";
				
	if(h >= 12){
		h = h - 12;
		session = "PM";
	}

	if(h == 0){
		h = 12;
	}

	h = (h < 10) ? "0" + h : h;
	m = (m < 10) ? "0" + m : m;
	s = (s < 10) ? "0" + s : s;
	d = (d < 10) ? "0" + d : d;
	mo = (mo < 10) ? "0" + mo : mo;

	var c_time = h + ":" + m + ":" + s + " " + session;
	d_time_block.innerText = c_time;
	d_time_block.textContent = c_time;

	var c_date = d  +"/" + mo + "/" + y;

	d_date_block.innerText = c_date;
	d_date_block.textContent = c_date;

	setTimeout(showTime, 1000);
}

showTime();

d_time_block.style.bottom = '-50px'; // default position of Time Box
d_date_block.style.bottom = '-50px'; // default position of Date box

/* display date and time by hover */
t_dis.onmouseenter = ()=>
{
	if (d_time_block.style.bottom == "-50px") 
	{
		d_time_block.style.bottom = '26px';
	}
}
t_dis.onmouseleave = ()=>
{
	if (d_time_block.style.bottom == '26px') 
	{
		d_time_block.style.bottom = '-50px';
	}
}
d_dis.onmouseenter = ()=>
{
	if (d_date_block.style.bottom == "-50px") 
	{
		d_date_block.style.bottom = '26px';
	}
}
d_dis.onmouseleave = ()=>
{
	if (d_date_block.style.bottom == '26px') 
	{
		d_date_block.style.bottom = '-50px';
	}
}