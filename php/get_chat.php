<?php

session_start();

if (!isset($_SESSION['unique_id'])) 
{
	header('location: ../account/login.php');
}
else
{
	include_once 'config.php';

	$outgoing_id = mysqli_real_escape_string($conn,$_POST['outgoing_id']);
	$incoming_id = mysqli_real_escape_string($conn,$_POST['incoming_id']);

	$output = "";

	$sql = "SELECT * FROM messages WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY sno";
	$query = mysqli_query($conn, $sql);
	if ($query) 
	{
		$no_of_chat = mysqli_num_rows($query);
		if($no_of_chat > 0)
		{
			while ($row = mysqli_fetch_assoc($query))
			{
				if ($row['outgoing_msg_id'] === $outgoing_id) // if it is equal then this is sender msg
				{
				
					$output .= '<div class="chat outgoing">
									<div class="details">
										<p>'.$row['msg'].'</p>
									</div>
									<input type="hidden" class="no_of_chat" value="'.$no_of_chat.'">
								</div>';
				}
				else // else it is reciever msg
				{
					$output .= '<div class="chat incoming">
									<div class="details">
										<p>'.$row['msg'].'</p>
									</div>
									<input type="hidden" class="no_of_chat" value="'.$no_of_chat.'">
								</div>';
				}
			}	
		}
		else
		{
			$output .= "EMPTY!";
		}
		echo $output;
	}
	else 
	{
		echo "Something went Wrong!";
	}
}
?>