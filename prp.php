<?php

session_start();
ob_start();
error_reporting(0);
setcookie("my",420);
ob_flush();

if(isset($_GET['brprep'])){
$brprep=$_GET['brprep'];
$_SESSION['BrPrep']=$brprep;	
}

if(isset($_GET['formid'])){
$formid = $_GET['formid'];
$_SESSION['FormId'] = $formid;	
}else{
if(isset($_SESSION['FormId'])){

}else{
$_SESSION['FormId'] = "0";
}
}

if(isset($_GET['routid'])){
$routid = $_GET['routid'];
$_SESSION['RoutId'] = $routid;	
}else{
if(isset($_SESSION['RoutId'])){

}else{
$_SESSION['RoutId'] = "0";
}
}


if(isset($_GET['freqid'])){
$freqid = $_GET['freqid'];
$_SESSION['FreqId'] = $freqid;	
}else{
if(isset($_SESSION['FreqId'])){

}else{
$_SESSION['FreqId'] = "0";
}
}


if(isset($_GET['instid'])){
$instid = $_GET['instid'];
$_SESSION['InstId'] = $instid;	
}else{
if(isset($_SESSION['InstId'])){

}else{
$_SESSION['InstId'] = "0";
}
}


if(isset($_GET['duraid'])){
$duraid = $_GET['duraid'];
$_SESSION['DuraId'] = $duraid;	
}else{
if(isset($_SESSION['DuraId'])){

}else{
$_SESSION['DuraId'] = "0";
}
}

if(isset($_GET['doseid'])){
$doseid = $_GET['doseid'];
$_SESSION['DoseId'] = $doseid;	
}else{
if(isset($_SESSION['DoseId'])){

}else{
$_SESSION['DoseId'] = "0";
}
}

if(isset($_GET['strid'])){
$strid = $_GET['strid'];
$_SESSION['StrId'] = $strid;	
}else{
if(isset($_SESSION['StrId'])){

}else{
$_SESSION['StrId'] = "0";
}
}

if(isset($_GET['prepid'])){
$prepid = $_GET['prepid'];
$_SESSION['BrandId'] = $prepid;	
}else{
if(isset($_SESSION['BrandId'])){

}else{
$_SESSION['BrandId'] = "0";
}
}

if(isset($_GET['drugid'])){
$drugid = $_GET['drugid'];
$_SESSION['DrugId'] = $drugid;	
}else{
if(isset($_SESSION['DrugId'])){

}else{
$_SESSION['DrugId'] = "0";
}
}

if(isset($_GET['unitid'])){
$unitid = $_GET['unitid'];
$_SESSION['UnitId'] = $unitid;	
}else{
if(isset($_SESSION['UnitId'])){

}else{
$_SESSION['UnitId'] = "0";
}
}

if(isset($_GET['presconid'])){
$presconid = $_GET['presconid'];
$_SESSION['PresconId'] = $presconid;	
}else{
$_SESSION['PresconId'] = "0";
}
//echo $_SESSION['SESS_USER_ID'];
$_SESSION['SESS_USER_ID']=0;
	

function ShowForm(){
echo '<form method="POST" action="Prp.php" id="clin">';

//echo  $_SESSION['PrescId'];
if($_SESSION['PresconId']!=0){
//echo  $_SESSION['PrescId'];	
$presconid = $_SESSION['PresconId'];	
$ssql="SELECT * from ---- WHERE Id = $presconid";
//echo $ssql;
$result=mysqli_query($_SESSION['conn'],$ssql);
if($row=mysqli_fetch_array($result)){
//echo 'Inside : ';
//echo  $_SESSION['PrescId'];
$_SESSION['BrandId']= $row['PreparationId']; 	
$_SESSION['FormId']= $row['FormId']; 
$_SESSION['StrId']= $row['StrengthId']; 	
$_SESSION['UnitId']= $row['UnitId']; 	
$qty = $row['Quantity']; 	
$_SESSION['DoseId']= $row['PrepDoseId']; 	
$_SESSION['FreqId']= $row['FrequencyId']; 	
$_SESSION['DuraId']= $row['DurationId']; 	
$_SESSION['RoutId']= $row['RouteId']; 	
$_SESSION['InstId']= $row['InstructionId']; 	
$adv = $row['AdviseId'];
}	
}
echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h66" align="center">';
echo '<img src="MeDiWiND.bmp" width="50%"></div>';
echo '<div class="col-3 h5"></div>';    
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h66" align="center"><strong>Prescription Drugs<br>Preparation Id :  <input type="text" readonly ="readonly" name="presconid" value="'.$presconid.'" style="width:50px"></strong></div>';    
echo '<div class="col-6 h5"></div>';    
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center">';
$brprep="MY";
if(isset($_SESSION['BrPrep'])){
$brprep= $_SESSION['BrPrep'];
}	
if((isset($brprep)) and $brprep=="MY"){$checked="checked";}
else {$checked="";} 
echo 'Select <input type="radio" name="R_Br" id="R_My" value="MY" '.$checked.'>My ';
if((isset($brprep)) and $brprep=="HO"){$checked="checked";}
else {$checked="";} 
echo '<input type="radio" name="R_Br" id="R_Hosp" value="HO" '.$checked.'>Hosp ';
if((isset($brprep)) and $brprep=="AL"){$checked="checked";}
else {$checked="";}
echo '<input type="radio" name="R_Br" id="R_All" value="AL" '.$checked.'>ALL Brands';
echo '</div>';
echo '<div class="col-3 h5"></div>';    
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center">';
echo '<b>OR</b> Preparations linked to selected Drug';
echo '</div>';    
echo '<div class="col-6 h5"></div>';    
echo '</div>';
	
?>


 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>	

      $("#R_My").on("change", function(){
        	var selected = $(this).val();
        	$("#B_Brand").html(": " + selected);
        	window.location.href = "Prp.php?brprep=" + selected;
      })


      $("#R_Hosp").on("change", function(){
        	var selected = $(this).val();
        	$("#B_Brand").html(": " + selected);
        	window.location.href = "Prp.php?brprep=" + selected;
      })

      $("#R_All").on("change", function(){
        	var selected = $(this).val();
        	$("#B_Brand").html(": " + selected);
        	window.location.href = "Prp.php?brprep=" + selected;
      })
	  
    </script>

<?php

	
echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text" readonly="readonly" value="Drug Name" style="width:100px"><select ID="DD_drug" name="drug" style="width:100px">';
$ssql = "SELECT * FROM ----";
$result = mysqli_query($_SESSION['conn'],$ssql);  
echo '<option value="0" style="width=100px">....................</option>';
while($row=mysqli_fetch_array($result))
{
       showSelval($_SESSION['DrugId'],$row['Id'], $row['Descr']);
}

?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_drug").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "Prp.php?brprep=DR&drugid=" + selected;
      })
    </script>
<?php	
echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text"  value="Preparation(Brands)" style="width:100px"><select ID="DD_prep" name="prep" style="width:100px">';
	
	if (isset($_SESSION['DoctId'])){
$doctid = $_SESSION['DoctId'];	
	}
echo $doctid;	
$drugid=0;
if(isset($_SESSION['DrugId'])){
$drugid=$_SESSION['DrugId']; 
}


        $brprep=$_SESSION['BrPrep'];
$userid=$_SESSION['UserId'];
echo $brprep;
switch ($brprep){
        case 'DR':
$ssql = "SELECT brands.Id, brands.Descr FROM brands, brand2drug WHERE brands.Id = brand2drug.brandid AND brand2drug.drugid= $drugid ORDER BY brands.Descr";
                break;
        
        case 'MY':
$ssql = "SELECT brands.Id, brands.Descr FROM brands, brands4users WHERE brands.Id = brands4users.brandid AND brands4users.userid= $doctid ORDER BY brands.Descr";
                break;
        
        case 'HO':
$ssql = "SELECT DISTINCT brands.id, brands.Descr FROM brands, brands4users, mw_Doctor, mw_Hospitals, mwDoctorHospital, UserTable WHERE brands.id = brands4users.brandid and brands4users.userid = mw_Doctor.Id AND mw_Doctor.Id = mwDoctorHospital.DoctorId and mwDoctorHospital.HospitalId = mw_Hospitals.id and mw_Hospitals.id = UserTable.HospitalID AND UserTable.Id = $userid ORDER BY brands.Descr";

                break;
        case 'AL':
$ssql = "SELECT brands.Id, brands.Descr FROM brands";
                break;
        
        default:
$ssql = "SELECT brands.Id, brands.Descr FROM brands, brands4users WHERE brands.Id = brands4users.brandid AND brands4users.userid= $doctid ORDER BY brands.Descr";
}
//	echo $ssql;	
	$result1 = mysqli_query($_SESSION['conn'],$ssql);  
	echo '<option value="0" style="width=100px">....................</option>';
	while($row1=mysqli_fetch_array($result1)){
       		showSelval($_SESSION['BrandId'],$row1['Id'], $row1['Descr']);
	}
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_prep").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "Prp.php?prepid=" + selected;
      })
    </script>
<?php
echo '</select></div>';	
echo '<div class="col-6 h5"></div>';
echo '</div>';

	
	
echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text"  value="Form (401)" style="width:100px"><select ID="DD_form"  name="form" style="width:100px">';
//
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = --- order by Descr";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['FormId'],$row['Id'], $row['Descr']);
       }

    echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="qty" value="Quantity" style="width:100px"><input type="text" name="quant" value="'.$qty.'" style="width:100px"></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text"  value="Strength(430)" style="width:100px"><select ID="DD_str" name="str" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = -";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['StrId'],$row['Id'], $row['Descr']);
       }

echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text"  value="Unit" style="width:100px"><select ID="DD_unit" name="unit" style="width:100px">';
echo '<option value="0" style="width=100px">....................</option>';
       $ssql = "Select * from ----- where UID = ---";
       $resultu = mysqli_query($_SESSION['conn'],$ssql);  
       while($rowu=mysqli_fetch_array($resultu)){                               
       		showSelval($_SESSION['UnitId'],$rowu['Id'], $rowu['Descr']);
       }
echo '</select></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text"  value="Dose(488)" style="width:100px"><select ID="DD_dose" name="dose" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = ---";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       showSelval($_SESSION['DoseId'],$row['Id'], $row['Descr']);
       }

echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text" value="Frequency(546)" style="width:100px"><select ID="DD_freq" name="freq" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ---- where UID = ---";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['FreqId'],$row['Id'], $row['Descr']);
       }
    
echo '</select></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text" value="Duration(575)" style="width:100px"><select ID="DD_durn" name="durn" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['DuraId'],$row['Id'], $row['Descr']);
       }

echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text" value="Route(517) " style="width:100px"><select ID="DD_route" name="route" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['RoutId'],$row['Id'], $row['Descr']);
       }

echo '</select></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text"  value="Instruction(604)" style="width:100px"><select ID="DD_inst" name="inst" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['InstId'],$row['Id'], $row['Descr']);
       }

echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type ="text" style="width:100px" readonly="readonly" value="Advise:"> <input type="text" name="advice" value="'.$adv.'"  style="width:100px"></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';
	
echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="submit" name="B_Cust" value="Customize Drug Database" style="width:200px"></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="submit" name="B_Add" value="Add to Prescription" style="width:150px"><input type="submit" name="B_Exit" value="Exit" style="width:50px"></div>';	
	
echo '</body></table>';

}


function saveData() {
	$drugid= $_POST['drug'];
	$prepid= $_POST['prep'];
	$formid = $_POST['form'];
	$strid = $_POST['str'];
	$unitid = $_POST['unit'];
$quanti = $_POST['quant'];	
$doseid = $_POST['dose'];
$freqid = $_POST['freq'];
$durnid = $_POST['durn'];
$routeid = $_POST['route'];
$instid = $_POST['inst'];
$adv = $_POST['advice'];	
//$diagn='';
$prescid = $_SESSION['PrescId'];
//echo $prescid;
//$prescdt = date('Y-m-d');
if(isset($_POST['presconid'])){
	$presconid = $_POST['presconid'];
}else{
	$presconid=0;
}
	if($presconid==0){	
		//PrescDate, PatientId, Diagnosis,  removed as transferred to prescinfo
$ssql = "INSERT INTO ----- (PrescId, PreparationId, FormId, StrengthId, UnitId, Quantity, PrepDoseId, FrequencyId, DurationId, RouteId, InstructionId, AdviseId, DelFlag ) VALUES ('$prescid', '$prepid', '$formid', '$strid', '$unitid', '$quanti', '$doseid', '$freqid', '$durnid', '$routeid', '$instid', '$adv', 'N')";
}else{
$ssql = "UPDATE ----- SET 
PrescId = '$prescid',    
PreparationId = '$prepid', 
FormId = '$formid', 
StrengthId ='$strid',  
UnitId = '$unitid', 
Quantity = '$quanti', 
PrepDoseId = '$doseid', 
FrequencyId = '$freqid', 
DurationId = '$durnid', 
RouteId = '$routeid', 
InstructionId = '$instid', 
AdviseId = '$adv', 
DelFlag = 'N' WHERE Id = $presconid";	
}
//	echo $ssql;
	$result = mysqli_query($_SESSION['conn'],$ssql);	

}


function ActOnButtons(){
	if (isset($_POST['B_Add'])) {
		saveData();
		unset($_SESSION['DrugId']);
		header("Location: PContent.php");
	}

	if (isset($_POST['B_Cust'])) {
		header("Location: PContent.php");
	}

	if (isset($_POST['B_Exit'])) {
		header("Location: PContent.php");
	}
}



MakeDBConnection();
ActOnButtons();
ShowForm();
?>
