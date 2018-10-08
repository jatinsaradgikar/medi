<?php
ob_start();
session_start();

function ActOnButtons() {
      $_SESSION['statusmessage'] = ' ';

   if (isset($_POST['B_Save'])) {
    
      $hn  = $_POST['hname'];
      $had   = $_POST['haddr'];
      $email  = $_POST['hemail'];
      $cont  = $_POST['hphone'];
      $contper  = $_POST['hcontper'];
//      $mobno  = $_POST['mobileno'];
      $dbn = $_POST['hdbname'];
      $dbu  = $_POST['hdbuser'];
      $dbp = $_POST['hdbpass'];
	
      $rdate  = date('Y-m-d');
      $status = $_POST['status'];	

   
      if (trim($hname) == '' || trim($haddr) == '' || trim($email) == '' || 
      	 trim($dbname) == '' || trim($dbuser) == '' || trim($dbpass) == '') {
         $_SESSION['statusmessage'] = 'Error: All fields are compulsory, please re-enter';
	 echo $_SESSION['statusmessage'];
      } 
      else {
	 //echo "Hello!!";
         if ($pswd1 != $pswd2) {
            $_SESSION['statusmessage'] = 'Error: The two passwords do not match, please re-enter';
         } 
         else {
            $_SESSION['statusmessage'] = '';
            $sql = "select * from mw_Hospitals where id=".$_SESSION['HospId'];
	    ///echo $sql;
            $result = mysqli_query($_SESSION['conn'],$sql);
          
            if ($row=mysqli_fetch_assoc($result)) {
//		echo "Update";	

	 $sqlu = "update ----- set hn = '$hn', ha = '$ha', hemail = '$email', hphone = '$cont', hcontper = '$contper', hdbname = '$dbn', hdbuser = '$dbu', hdbpass = '$dbp', regdate = '$rdate', status = '$status'  where id=".$_SESSION['HosId'];
//	echo $sqlu;

		$resultu = mysqli_query($_SESSION['conn'],$sqlu);
		
		if($resultu)
	        	 $_SESSION['statusmessage'] = 'Login ID has been successfully updated.';		

               //$_SESSION['statusmessage'] = 'Error: The login ID is already used by another user, please re-enter';
            } else {
               $sql = "insert into ----- (hname,haddr,hemail,hphone,hcontper,hdbname,hdbuser,hdbpass,regdate) 
                       values ('$hn','$ha','$email','$cont','$contper','$dbn','$dbu','$dbp','$rdate')";
               $result = mysqli_query($_SESSION['conn'],$sql);
               if ($result) {
                 $_SESSION['HospId']= mysqli_insert_id($_SESSION['conn']);
		 $newdata="create database ".$dbname;
		 $cr=mysqli_query($_SESSION['conn'],$newdata);
		 if ($cr) { 
			echo "db created!!!!!!!";
			$_SESSION['conndb']=mysqli_connect("localhost",$dbuser,$dbpass,$dbname);
			$dbconnect=mysqli_select_db($_SESSION['conn'],$dbname);
		 
			$s1 = "create table ----- like -----";
			$r1= mysqli_query($_SESSION['conn'],$s1);
			
			$s2 = "create table ----- like -----";
			$r2 = mysqli_query($_SESSION['conn'],$s2);

			$s3 = "create table ----- like -----";
                        $r3 = mysqli_query($_SESSION['conn'],$s3);

			$s4 = "create table ------ like -----";
                        $r4 = mysqli_query($_SESSION['conn'],$s4);

			
			$s5 = "create table ----- like -----";
                        $r5 = mysqli_query($_SESSION['conn'],$s5);


			$s6 = "create table ----- like -----";
                        $r6 = mysqli_query($_SESSION['conn'],$s6);

		       
			$s7 = "create table ----- like ------";
                        $r7 = mysqli_query($_SESSION['conn'],$s7);


			$s8 = "create table ----- like -----";
                        $r8 = mysqli_query($_SESSION['conn'],$s8);


			$s9 = "create table ----- like -----";
                        $r9 = mysqli_query($_SESSION['conn'],$s9);


			$s10 = "create table ----- like -----";
                        $r10 = mysqli_query($_SESSION['conn'],$s10);
		}
		  
                 $_SESSION['statusmessage'] = 'Your new login ID has been successfully registered.';
                  $msg = "Dear $fname $lname (userid: $login), Thank you for registering with ------. Please complete remaining information on your profile.";
                  $ch = curl_init($smsurl);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  $curl_scraped_page = curl_exec($ch);
                  curl_close($ch);

               }
            }
         } 
      }
   }
 
}

MakeDBConnection();
ActOnButtons();
?>
