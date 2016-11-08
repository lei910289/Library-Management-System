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

	$Fname = $_POST['Fname'];
	$Lname = $_POST['Lname'];
	$Address = $_POST['Address'];
	$Phone = $_POST['Phone'];
	//echo $Fname,$Lname,$Address,$Phone;

	if($Fname=="" || $Lname=="" || $Address==""){
		echo "<hr>Please enter your full name and address!</br>";
		echo "<a href='library.html'><button>Go back to register!</button></a><hr>";
	}else{
		$isExist=false;
		$sql = "SELECT Fname,Lname,Address FROM library.BORROWER";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
    		while($row =mysqli_fetch_assoc($result)) {
        		if($Fname==$row["Fname"] && $Lname==$row["Lname"] && $Address==$row["Address"]){
       				$isExist=true;
        				break;
       			}
     		}
		}


		if($isExist){
			echo "<hr>Borrower with same full name and address has existed!</br>";
			echo "<a href='library.html'><button>Go back to register!</button></a><hr>";
		}else{
		$sql = "select card_no from BORROWER";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
			$Loop=true;
			while($Loop){
				$isUnique=true;
				$Id=(rand(1,100000));
				$result = mysqli_query($conn,$sql);
    			while($row =mysqli_fetch_assoc($result)) {
       				if($Id==$row["card_no"]){
        				$isUnique=false;
        				break;
        			}
     			}
     			if($isUnique){
     				$Loop=false;
   				}else{
     				$Loop=true;
     			}
     		}
		} else {
   			$Id=(rand(1,100000));
		}

		$sql = "INSERT into library.BORROWER values ('".$Id."','".$Fname."','".$Lname."','".$Address."','".$Phone."')";
		if ($conn->query($sql) === TRUE) {
    		echo "<hr>New record created successfully!</br>Your card number is ".$Id."!</br><hr>";
    		echo "<a href='library.html'><button>Start looking for books!</button></a>";
		} else {
   			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

	mysqli_close($conn);
?>