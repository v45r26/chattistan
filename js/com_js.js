const profile_box_tgl = document.querySelector('#profile-box-tgl'),
	  prof_btn = document.querySelector('#prof-btn');

profile_box_tgl.style.display = "none";

prof_btn.onclick = ()=>
{
	if (profile_box_tgl.style.display == "block") 
	{
		profile_box_tgl.style.display = "none";
	}
	else
	{
		profile_box_tgl.style.display = "block";
	}
}

