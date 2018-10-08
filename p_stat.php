<?php 

session_start();
ob_start();
error_reporting(0);
setcookie("my",420);
ob_flush();

if(isset($_GET['visiid'])){
    $visiid = $_GET['visiid'];
    $_SESSION['VisiId'] = $visiid;	
}else{
if(isset($_SESSION['VisiId'])){
}else{
    $_SESSION['VisiId'] = "0";
}
}


if(isset($_GET['counid'])){
    $counid = $_GET['counid'];
    $_SESSION['CounId'] = $counid;	
}else{
if(isset($_SESSION['CounId'])){

}else{
    $_SESSION['CounId'] = "0";
}
}

if(isset($_GET['servid'])){
    $servid = $_GET['servid'];
    $_SESSION['ServId'] = $servid;	
}else{
if(isset($_SESSION['ServId'])){

}else{
    $_SESSION['ServId'] = "0";
}
}



if(isset($_GET['abusid'])){
    $abusid = $_GET['abusid'];
    $_SESSION['AbusId'] = $abusid;	
}else{
if(isset($_SESSION['AbusId'])){

}else{
$_SESSION['AbusId'] = "0";
}
}

if(isset($_GET['alleid'])){
$alleid = $_GET['alleid'];
$_SESSION['AlleId'] = $alleid;	
}else{
if(isset($_SESSION['AlleId'])){

}else{
$_SESSION['AlleId'] = "0";
}
}


if(isset($_GET['disaid'])){
$disaid = $_GET['disaid'];
$_SESSION['DisaId'] = $disaid;	
}else{
if(isset($_SESSION['DisaId'])){

}else{
$_SESSION['DisaId'] = "0";
}
}

if(isset($_GET['riskid'])){
$riskid = $_GET['riskid'];
$_SESSION['RiskId'] = $riskid;	
}else{
if(isset($_SESSION['RiskId'])){

}else{
$_SESSION['RiskId'] = "0";
}
}
?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_disa").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "mwStatus.php?disaid=" + selected;
      })
    </script>

<?php
	echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text" name="str" value="Risk factors" style="width:100px"><select ID="DD_risk" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = ---";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       showSelval($_SESSION['RiskId'],$row['Id'], $row['Descr']);
       }
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_risk").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "mwStatus.php?riskid=" + selected;
      })
    </script>
<?php

echo '</select></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text" name="dose" value="Allergy" style="width:100px"><select ID="DD_alle" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       showSelval($_SESSION['AlleId'],$row['Id'], $row['Descr']);
       }
//echo '</select></td>';
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_alle").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "mwStatus.php?alleid=" + selected;
      })
    </script>
<?php


echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text" name="freq" value="Abuse" style="width:100px"><select ID="DD_abus" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ----- where UID = ---";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       		showSelval($_SESSION['AbusId'],$row['Id'], $row['Descr']);
       }
//echo '</select></td>';
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_abus").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "mwStatus.php?abusid=" + selected;
      })
    </script>
<?php


echo '</select></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text" name="durn" value="Counselling" style="width:100px"><select ID="DD_coun" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ---- where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       showSelval($_SESSION['CounId'],$row['Id'], $row['Descr']);
       }
//echo '</select></td>';
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_coun").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "Status.php?counid=" + selected;
      })
    </script>
<?php

echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="text" name="route" value="Type of service" style="width:100px"><select ID="DD_serv" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ---- where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       showSelval($_SESSION['ServId'],$row['Id'], $row['Descr']);
       }
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_serv").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "Status.php?servid=" + selected;
      })
    </script>
<?php

	echo '</select></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';

echo '<div class="row">';
echo '<div class="col-1 h5"></div>';
echo '<div class="col-2 h33" align="center"><input type="text" name="visit" value="Type of visit" style="width:100px"><select ID="DD_visi" style="width:100px">';
echo '<option value="0" style="width=200px">....................</option>';
       $ssql = "Select * from ------ where UID = --";
       $result3 = mysqli_query($_SESSION['conn'],$ssql);  
       while($row=mysqli_fetch_array($result3)){                               
       showSelval($_SESSION['VisiId'],$row['Id'], $row['Descr']);
       }
//echo '</select></td>';
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_visi").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = "Status.php?visiid=" + selected;
      })
    </script>
<?php

echo '</select></div>';
echo '<div class="col-3 h5"></div>';
echo '<div class="col-4 h5"></div>';
echo '<div class="col-5 h33" align="center"><input type="submit" name="B_Exit" value="Exit" style="width:100px"><input type="submit" name="B_Save" value="Save Status" style="width:100px"></div>';
echo '<div class="col-6 h5"></div>';
echo '</div>';
	echo '</body></table>';
	
}

function saveData(){

		$dbuser = $_SESSION['dbuser'];
                $dbpass = $_SESSION['dbpass'];
                $dbname = $_SESSION['dbname'];

                //echo $dbuser; echo $dbpass; echo $dbname;

                $_SESSION['conn'] = mysqli_connect("localhost","$dbuser","$dbpass","$dbname");

                $pid = $_SESSION['PatId'];
                $disability = $_POST['form'];
                $allergy = $_POST['dose'];
                $counselling = $_POST['durn'];
                $tov = $_POST['visit'];
                $rf = $_POST['str'];
                $abuse = $_POST['freq'];
                $tos = $_POST['route'];


  $sql = "insert into -----(pid,disability,allergy,counselling,tov,rf,abuse,tos) values ($pid,'$disability','$allergy','$counselling','$tov','$rf','$abuse','$tos')";
                //echo $sql;

           $res = mysqli_query($_SESSION['conn'],$sql);

}

function ActOnButtons(){
//x=&y= for coordinates of up/dn buttons
	if (isset($_POST['B_Save'])) {
		saveData();
		header("Location: Pat.php");
	}

	if (isset($_POST['B_Exit'])) {
        header("Location: Pat.php");
    }   
	
}

MakeDBConnection();
ActOnButtons();
?>
