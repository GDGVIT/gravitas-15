<?php
	session_start();
	if((isset($_SESSION['name_fin']))&&(isset($_REQUEST['id'])))//session_variable verification
	{
		echo"
		<h2>Sponsors</h2>
			Event Name: <input type='text' name='event_name' id='event_name'  placeholder='Event Name' autocomplete='off'><br><br>
			Sponsor Company/Person name: <input type='text' name='company_name' id='company_name'  placeholder='Company or Person Name' autocomplete='off'><br><br>
			Amount:<input type='text' name='amount'  placeholder='Amount Credited' id='amount' autocomplete='off' onkeypress='return isNumber(event)'></br><br>

			Modes:</br>
				<input type = 'radio' value ='cash' name ='mode' id='1' onclick='method_pay(this.id)'>Creditted with Cash<br>
				<input type = 'radio' value ='dd' name ='mode' id='2' onclick='method_pay(this.id)'>Creditted with DD<br>
				<input type = 'radio' value ='cheque' name ='mode' id='3' onclick='method_pay(this.id)'>Creditted with Cheque<br>
				<input type = 'radio' value ='net_transfer' name ='mode' id='4' onclick='method_pay(this.id)'>Creditted with NET Banking<br>
				</br><div id='more_credit_options'></div><br>
			Phone Number:<input type='text' name='phno' id='phno' placeholder='9092******' autocomplete='off' onkeypress='return isNumber(event)'><br><br>
			Email-ID:<input type='email' name='email_id' id='email_id'  placeholder='someone@something.com' autocomplete='off'><br><br>
			Remarks:<br> <textarea name='remarks_sponsor' rows='5' cols='50' id='remarks_sponsor'  placeholder='Details regarding the info added' autocomplete='off'></textarea><br><br>		
			<button onclick='submit_sponsor();'>Submit!</button>";
	}
	else if((isset($_SESSION['name_fin']))&&(!isset($_REQUEST['id']))||((!isset($_SESSION['name_fin']))&&(!isset($_REQUEST['id']))))
	{
		session_unset();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		session_destroy();
		header("Location:login_approve.php");
	}
	else
	{
		session_unset();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		session_destroy();
		echo "<div>Ah4*!bb dhS8!) Nh5@n</div>";
		exit();
	}
?>