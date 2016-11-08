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
	$Book_id = trim($_POST['Book_id']);
	$Card_num = trim($_POST['Card_num']);
	$Fname = trim($_POST['Fname']);
	$Lname = trim($_POST['Lname']);
	
	if($Book_id=="" && $Card_num=="" && $Fname=="" && $Lname==""){
		echo "<hr>";
		echo "Please enter any search condition!<br>";
		echo "<a href='library.html'><button>Go Back!</button></a>";
		echo "<hr>";
	}else{
		if($Book_id!="" && $Card_num=="" && $Fname=="" && $Lname==""){
			
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and Date_in is null";
		}else if($Book_id=="" && $Card_num!="" && $Fname=="" && $Lname==""){
			
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and BORROWER.Card_no='".$Card_num."' and Date_in is null";
		}else if($Book_id=="" && $Card_num=="" && $Fname!="" && $Lname==""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Fname like '%".$Fname."%' and Date_in is null";
			
		}else if($Book_id=="" && $Card_num=="" && $Fname=="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Lname like '%".$Lname."%' and Date_in is null";
			
		}else if($Book_id!="" && $Card_num!="" && $Fname=="" && $Lname==""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and BORROWER.Card_no='".$Card_num."' and Date_in is null";
			
		}else if($Book_id!="" && $Card_num=="" && $Fname!="" && $Lname==""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and Fname like '%".$Fname."%' and Date_in is null";
			
		}else if($Book_id!="" && $Card_num=="" && $Fname=="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and Lname like '%".$Lname."%' and Date_in is null";
			
		}else if($Book_id=="" && $Card_num!="" && $Fname!="" && $Lname==""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and BOOK_LOANS.Card_no='".$Card_num."' and Fname like '%".$Fname."%' and Date_in is null";
			
		}else if($Book_id=="" && $Card_num!="" && $Fname=="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and BOOK_LOANS.Card_no='".$Card_num."' and Lname like '%".$Lname."%' and Date_in is null";
			
		}else if($Book_id=="" && $Card_num=="" && $Fname!="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Fname like '%".$Fname."%' and Lname like '%".$Lname."%' and Date_in is null";
			
		}else if($Book_id!="" && $Card_num!="" && $Fname!="" && $Lname==""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and BOOK_LOANS.Card_no='".$Card_num."' and Fname like '%".$Fname."%' and Date_in is null";
			
		}else if($Book_id!="" && $Card_num!="" && $Fname=="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and BOOK_LOANS.Card_no='".$Card_num."' and Lname like '%".$Lname."%' and Date_in is null";
			
		}else if($Book_id!="" && $Card_num=="" && $Fname!="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and Fname like '%".$Fname."%' and Lname like '%".$Lname."%' and Date_in is null";
			
		}else if($Book_id=="" && $Card_num!="" && $Fname!="" && $Lname!=""){
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and BOOK_LOANS.Card_no='".$Card_num."' and Fname like '%".$Fname."%' and Lname like '%".$Lname."%' and Date_in is null";
			
		}else{
			$sql="SELECT BORROWER.Card_no, Fname, Lname, Book_id, Branch_id, Date_out, Due_date, Loan_id from BOOK_LOANS, BORROWER where BORROWER.Card_no=BOOK_LOANS.Card_no and Book_id='".$Book_id."' and BOOK_LOANS.Card_no='".$Card_num."' and Fname like '%".$Fname."%' and Lname like '%".$Lname."%' and Date_in is null";
			
		}

		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
			
			$table = "<table border='4'>
				<tr><td>Card Number</td><td>First Name</td><td>Last Name</td><td>Book_id</td><td>Branch_id</td><td>Date_out</td><td>Due_date</td><td>Check In</td></tr>";
    		while($row =mysqli_fetch_assoc($result)) {
    			$Loan_id=$row["Loan_id"];
        		$string = "<tr><td>".$row["Card_no"]."</td><td>".$row["Fname"]."</td><td>".$row["Lname"]."</td><td>".$row["Book_id"]."</td><td>".$row["Branch_id"]."</td><td>".$row["Date_out"]."</td><td>".$row["Due_date"]."</td><td><form action='checkInResult.php' method='post' style='display: inline'><input type='hidden' name='Loan_id' value='$Loan_id'><input type='submit' value='checkin'></form></td></tr>";
        		$table = $table.$string;
     		}
     		$table = $table."</table>";
     		echo $table;
		}else{
			echo "No book records!";
			echo "<a href='library.html'><button>Go Back!</button></a>";
		}

	}


?>