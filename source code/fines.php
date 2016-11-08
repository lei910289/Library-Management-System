<?php 
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "library";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if(mysqli_connect_errno()){
		echo "Failed to connect to MYSQL:".mysqli_connect_error()."<br/>";
	}
	
	date_default_timezone_set("America/Chicago");
	$today = date("Y-m-d");
	$sql="SELECT Due_date, Date_in, Loan_id from BOOK_LOANS where (Date_in is null and Due_date<'".$today."') or Date_in > Due_date";
	$result = mysqli_query($conn,$sql);

	if (mysqli_num_rows($result) > 0) {
    	while($row =mysqli_fetch_assoc($result)) {
        	$Due_date=$row["Due_date"];
        	$Date_in=$row["Date_in"];
        	$Loan_id=$row["Loan_id"];
        	$sql2="SELECT * from FINES where loan_id='".$Loan_id."'";
        	$result2 = mysqli_query($conn,$sql2);
        	if (mysqli_num_rows($result2)==0){
        		$sql3="INSERT into FINES (loan_id) VALUES ('".$Loan_id."')";
        		if ($conn->query($sql3) !== TRUE) {
   					echo "Error: " . $sql3 . "<br>" . $conn->error;
				}
        	}
        	if($Date_in==null){
        		$today1=date_create($today);
				$Due_date1=date_create($Due_date);
        		$diff=date_diff($today1,$Due_date1);
				$days=$diff->format("%a");
        		$fine=0.25*$days;
        	}else{
        		$Date_in2=date_create($Date_in);
				$Due_date2=date_create($Due_date);
        		$diff=date_diff($Date_in2,$Due_date2);
				$days=$diff->format("%a");
				$fine=0.25*$days;
        	}
        	
        	$sql4="UPDATE FINES SET fine_amt='".$fine."' where loan_id='".$Loan_id."'";
        	mysqli_query($conn,$sql4);


		}
		echo "Update complete!<br>";
		echo "<a href='library.html'><button>Go Back!</button></a>";
	} else {
     	echo "0 results";
	}

?>