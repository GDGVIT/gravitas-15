<?php
	if(true)//session_variable verification
	{
		echo "
		<h2>Expenditure:</h2>
		Branch:
			<select id='branch_revenue' onchange='notify_me(this.value)' name='branch_expenses'>
			  <option value='0'>Choose Any One</option>  
			  <option value='1'>Sponsors</option>
			  <option value='2' >Accomodation</option>
			  <option value='3'>Stall Rent</option>
			  <option value='4'>T-Shirt Sales</option>
			  <option value='5'>Workshops</option>
			  <option value='6'>Others</option>
			</select></br></br>
			<div id='revenue_detail' name='revenue_detail'></div>";
	}
?>