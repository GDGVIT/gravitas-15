 <?php
session_start();
if(isset($_SESSION["regno"]))
{
	require 'sql_con.php';
	$event_id = $_GET["val"];
	$d=date('d/m/Y');
	
	$q1 = "SELECT * FROM `events` WHERE `id` = $event_id";
	$r1 = mysqli_query($mysqli,$q1);
	$t1=mysqli_fetch_array($r1);
	$event_id = $t1[0];
	$event_name = $t1[1];
	$price = $t1[2];
	$t_int = $t1[3];
	$f_int = $t1[4];
	$t_ext = $t1[5];
	$f_ext =  $t1[6];
	$cat ="";
	$t ="";
	$min="";
	$max="";
	switch($t1[10])
	{
		case 0: $cat ="Premium";
			break;
		case 1: $cat ="Workshop";
			break;
		case 2: $cat ="Technical";
			break;
		case 3: $cat ="Management";
			break;
		case 4: $cat ="Informal";
			break;
		case 5: $cat ="Combos";
			break;
	}
	if($t1[7]==0)
		$t = "Variable";
	else
		$t=$t1[7];
	if($t1[8]==0)
		$min = "N/A";
	else
		$min = $t1[8];
	if($t1[9]==0)
		$max = "N/A";
	else
		$max=$t1[9];
	
	$file_name = "$event_name"."_Registered_Student_$d.xls";
	header( "Content-Type: application/vnd.ms-excel");
	header( "Content-disposition: attachment; filename=$file_name" );
	$data = "Event ID:\t $event_id\nEvent Name: \t $event_name\n Price:\t $price\nTotal Seats(Internals):\t $t_int \t Filled Seats(Internals):\t $f_int \n Total Seats(Externals):\t $t_ext \t Filled Seats(Externals): \t $f_ext \nCategory:\t $cat\n Team: \t $t \t Min:\t $min \t Max: \t $max";
	echo "Event ID:\t $event_id\nEvent Name: \t $event_name\n Price:\t $price\nTotal Seats(Internals):\t $t_int \t Filled Seats(Internals):\t $f_int \n Total Seats(Externals):\t $t_ext \t Filled Seats(Externals): \t $f_ext \nCategory:\t $cat\n Team: \t $t \t Min:\t $min \t Max: \t $max";

	$data.="\n ---Internal Participants---\n";
	echo"\n ---Internal Participants---\n";
	$q1 = "SELECT * FROM `internal_registration` WHERE `event_id`='$event_id' ";
	$r1= mysqli_query($mysqli,$q1);
	$data.="Name\tRegno\tEvent Name\tTeam Size\n\r";
	echo "Name\tRegno\tEvent Name\tTeam Size\n\r";
	while($t1=mysqli_fetch_array($r1))
	{
		$regno = $t1[1];
		$team = $t1[3];

		$q3 = "SELECT * FROM `internal_participants` WHERE `regno` ='$regno'";
		$r3= mysqli_query($mysqli,$q3);
		$t3 = mysqli_fetch_array($r3);
		$name = $t3[1];
		$data.= "$name\t$regno\t$event_name\t$team\r\n";
		echo "$name\t$regno\t$event_name\t$team\r\n";
	}
	
	$data.="\n ---External Participants--- \n";
	echo"\n ---External Participants--- \n";
	$q = "SELECT * FROM `external_registration` WHERE `paid_status` = '1' AND `event_id`='$event_id' ";
	$r = mysqli_query($mysqli,$q);
	$data.= "Name\tRegno\tEvent Name\tTeam Size\n\r";
	echo "Name\tRegno\tEvent Name\tTeam Size\n\r";
	while($t=mysqli_fetch_array($r))
	{
		$regno = $t[1];
		$team = $t[3];

		$q2 = "SELECT * FROM `external_participants` WHERE `id` ='$regno'";
		$r2 = mysqli_query($mysqli,$q2);
		$t2 = mysqli_fetch_array($r2);
		$name = $t2[2];
		$data.="$name \t $regno\t$event_name\t$team\r\n";
		echo "$name \t $regno\t$event_name\t$team\r\n";
	}
	file_put_contents("../example.xls",$data);
	print "$data";
}
else
{
		session_unset();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		session_destroy();
		header("Location:index.php");
}
?>