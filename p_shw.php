<?php 

session_start();
ob_start();
error_reporting(0);
setcookie("my",420);
ob_flush();

if(isset($_GET['prescid'])){
    $prescid = $_GET['prescid'];
    $_SESSION['PrescId'] = $prescid;
    echo $_SESSION['PrescId'];	
}else{

if(isset($_SESSION['PrescId'])){
$_SESSION['statusmsg']='Opening Previous Prescription';
}else{
$_SESSION['PrescId'] = "0";
}
}

if(isset($_GET['prepid'])){
$prepid = $_GET['prepid'];
$_SESSION['PrepId'] = $prepid;	
}

if(isset($_GET['langid'])){
$langid = $_GET['langid'];
$_SESSION['LangId'] = $langid;	
}

function getDescr($headid){
    $ssql = "SELECT Descr from ---- WHERE Id = $headid";	
    $resultf=mysqli_query($_SESSION['conn'],$ssql);
    if($rowf=mysqli_fetch_array($resultf)){
        $retDescr = $rowf[0];
    }
return $retDescr;
}

function getDescrL($headid){
$langid=$_SESSION['LangId'];
switch($langid){
	case 1036:
		$lang='Hindi';
		break;
	case 1037:
		$lang='Marathi';
		break;
	case 1038:
		$lang='Gujarathi';
		break;
	case 1039:
		$lang='Kannada';
		break;

	case 1046:
		$lang='heads';
		break;
	default:
		$lang='heads';
}

	
$ssql = "SELECT Descr from -- WHERE Id = $headid";	
$resultf=mysqli_query($_SESSION['conn'],$ssql);
if($rowf=mysqli_fetch_array($resultf)){
$retDescr = $rowf[0];
}
return $retDescr;
}

function ShowForm(){
echo '<form method="POST" action="p.php" id="clin">';


 $s="select * from --- where Id=".$_SESSION['PrescId'];
                                $r=mysqli_query($_SESSION['conn'],$s);
                                while($rw=mysqli_fetch_array($r)){
                                        $docId=$rw['DoctorId'];
                                        $patId=$rw['PatientId'];
                                        $prescDt=$rw['PrescDate'];
                                        $wt=$rw['Weight'];
                                }
                                $query="select * from ----- where ID=".$docId;
                                $res=mysqli_query($_SESSION['conn'],$query);
                                if($rows=mysqli_fetch_array($res)) {

                                        $dname = $rows['MEM_Fname']." ".$rows['MEM_Lname'];
                                        $qual = $rows['MEM_Quali'];
                                        $reg = $rows['MEM_RegNo'];
                                        $_SESSION['DoctorName'] = $dname;
                                        $_SESSION['qual'] = $qual;
                                        $_SESSION['reg'] = $reg;
                                }


                                $query1="select * from ----- where ID=".$_SESSION['HospId'];
                                $res1=mysqli_query($_SESSION['conn'],$query1);
                                if($rows1=mysqli_fetch_array($res1)) {

                                        $hospAddr=$rows1['haddr'];
                                        $htn = $rows1['hphone'];
                                        $hea = $rows1['hemail'];


                                        $_SESSION['haddr'] = $hospAddr;
                                        $_SESSION['htn'] = $htn;
                                        $_SESSION['hea'] = $hea;
                                }



 $sq="select * from ---- where Id=".$_SESSION['PrescId'];
                        $r=mysqli_query($_SESSION['conn'],$sq);
                        while($rw=mysqli_fetch_array($r)){
                                $docId=$rw['DoctorId'];
                                $patId=$rw['PatientId'];
                                $prescDt=$rw['PrescDate'];
                                $Dt = date('d/m/Y');
                                $wt=$rw['Weight'];
                        }

                        $s1 = "select * from ----- where Id=".$patId;
                        $r1 = mysqli_query($_SESSION['conn'],$s1);

                        if($row1 = mysqli_fetch_array($r1)) {
                                  $opd = $row1['OPDNO'];
                                  $add = $row1['HouseNo']." ".$row1['StreetAddr']." ".$row1['Landmark'] ;
                                  $area = $row1['Area'];
                                  $city = $row1['City'];
				  $pin = $row1['Pincode'];
                                  $pc = $row1['Pincode'];
				  $dob = $row1['BirthDate'];
				  $sex = $row1['SEX'];
                                  $name = $row1['FNAME']." ".$row1['MNAME']." ".$row1['LNAME'];
                        }

$age = (date('Y') - date('Y',strtotime($dob)));




$prescid = $_SESSION['PrescId'];	
//echo $prescid;
$patid = $_SESSION['PatId'];	
$ssql = "SELECT * from ----- WHERE PrescId = $prescid ORDER BY Id DESC";
$result=mysqli_query($_SESSION['conn'],$ssql);
$prepcnt=0;	


while($row=mysqli_fetch_array($result)){
$prepid = $row['Id'];	
$brandid=$row['PreparationId'];
$quant = $row['Quantity'];
$ssql = "SELECT Descr from ---- WHERE Id =".$brandid;
$resultb=mysqli_query($_SESSION['conn'],$ssql);
if($rowb=mysqli_fetch_array($resultb)){
$brandname = $rowb[0];
}
$drugstr='';	
$ssql = "SELECT * from ---- WHERE brandid = $brandid";
$resultc=mysqli_query($_SESSION['conn'],$ssql);
while($rowc=mysqli_fetch_array($resultc)){
if($drugstr!=''){$drugstr .= ' + ';}
$drugid = $rowc['drugid'];
$_SESSION['DrugId'] = $drugid;
$ssql = "SELECT Descr from ------ WHERE Id = $drugid";
//echo $ssql;
$resultd=mysqli_query($_SESSION['conn'],$ssql);
if($rowd=mysqli_fetch_array($resultd)){
$drugstr .= $rowd[0];
//echo 'drug';
//echo $drugstr;	
}	
}
	
?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
      $("#DD_Lang").on("change", function(){
        var selected = $(this).val();
        $("#mci").html(": " + selected);
        window.location.href = ".php?langid=" + selected;
      })
    </script>
<?php
	
}


require('fpdf.php');

//function genPDF1() {		

class ePDF extends FPDF {

		      function Header() {
				$width=$this->w;
				$height=$this->h;
				//echo $width; echo $height;
			
	
				$s="select * from ---- where Id=".$_SESSION['PrescId'];
				$r=mysqli_query($_SESSION['conn'],$s);
				while($rw=mysqli_fetch_array($r)){
					$docId=$rw['DoctorId'];
					$patId=$rw['PatientId'];
					$prescDt=$rw['PrescDate'];
					$wt=$rw['Weight'];
				}
       				$query="select * from ---- where ID=".$docId;
        			$res=mysqli_query($_SESSION['conn'],$query);
        			if($rows=mysqli_fetch_array($res)) {
				
					$dname = $rows['MEM_Fname']." ".$rows['MEM_Lname'];
					$qual = $rows['MEM_Quali'];
					$reg = $rows['MEM_RegNo'];
					$_SESSION['DoctorName'] = $dname;
					$_SESSION['qual'] = $qual;	
					$_SESSION['reg'] = $reg;
        			}


				$query1="select * from ----- where ID=".$_SESSION['HospId'];
                                $res1=mysqli_query($_SESSION['conn'],$query1);
                                if($rows1=mysqli_fetch_array($res1)) {

                                        $hospAddr=$rows1['haddr'];
                                        $htn = $rows1['hphone'];
                                        $hea = $rows1['hemail'];


					$_SESSION['haddr'] = $hospAddr;
                                        $_SESSION['htn'] = $htn;
                                        $_SESSION['hea'] = $hea;
                                }
		
			$margin = 10;
  			$this->Rect( $margin, $margin , $width - 2*$margin , $height - 2*$margin);

        		$this->SetFont('Arial','',14);
        		//$this->Image('MeDiWiND.bmp',10,10,-200);
//				echo $_SESSION['DoctorName'];
	
                        $this->SetFont('Arial','',22);
         		//$this->Cell(0,10,'Prescription Sheet',1,1,'C');
			$this->Ln();
     	  		$this->Cell(0,10,''.$_SESSION['DoctorName'].'',0,1,'C');

			$this->SetFont('Arial','',10);
		 	$this->Cell(0,5,''.$_SESSION['qual'].','.''.$_SESSION['reg'].'',0,1,'C');

			$this->SetFont('Arial','',14);
		        $this->Cell(0,5,''.$_SESSION['haddr'].'',0,1,'C');		
			$this->Cell(0,5,''.$_SESSION['htn'].','.''.$_SESSION['hea'].'',0,0,'C');

			$this->Ln();

        		//$this->Cell(120,10,''.$_SESSION['HospName'].','.$hospAddr.'',1,0,'C');
        		//$this->Cell(70,10,'Indoor No : '.$_SESSION['IpdId'],1,0,'C');
        //$this->Ln();
       // 		$pos=$this->GetY();

        		//$this->SetFont('Arial','',10);

//        $startdt=format_date($_POST['startdt']);
//        $enddt=format_date($_POST['enddt']);
//        $this->Cell(0,5,'From '.$startdt.' To '.$enddt,0,1,'C');

        		//$this->Ln(8.0);
      			}

      			function Footer() {

			$this->SetY(-55);

		        $this->SetFont('Arial','B',12);
                        if($this->isFinished){
			$this->Cell(110,5,'                  Pharmacist',0,0,'L');
                        $this->Cell(80,5,'Doctor',0,1,'L');

                        $this->SetFont('Arial','',11);
                        $this->Cell(110,5,'                    Signature',0,0,'L');
                        $this->Cell(80,5,'Signature',0,1,'L');
                        $this->Cell(110,5,'                    Name:',0,0,'L');
                        $this->Cell(110,5,'Date:',0,1,'L');
                        $this->Cell(110,5,'                    Address:',0,0,'L');
                        $this->Cell(110,5,'Rubber Stamp',0,1,'L');
                        $this->Cell(80,5,'                    Date:',0,1,'L');
                        $this->Cell(80,5,'                    Disp Info:',0,1,'L');
                        $this->Cell(80,5,'                    Rubber Stamp',0,0,'L');
			}
      			}
	}


function genPDF1() {

		 	$pdf = new ePDF();
    			echo "PDF";
   		 	$pdf->AddPage();


			$pdf->SetFont('Arial','',12);

			$sq="select * from ----- where Id=".$_SESSION['PrescId'];
                        $r=mysqli_query($_SESSION['conn'],$sq);
                        while($rw=mysqli_fetch_array($r)){
                        	$docId=$rw['DoctorId'];
                                $patId=$rw['PatientId'];
                                $prescDt=$rw['PrescDate'];
				$Dt = date('d/m/Y');
                                $wt=$rw['Weight'];
                        }

			$s1 = "select * from ----- where Id=".$patId;
                        $r1 = mysqli_query($_SESSION['conn'],$s1);

                        if($row1 = mysqli_fetch_array($r1)) {
                        	  $_SESSION['opd'] = $row1['OPDNO'];
				  $_SESSION['add'] = $row1['HouseNo']." ".$row1['StreetAddr']." ".$row1['Landmark'] ;
				  $_SESSION['area'] = $row1['Area'];
				  $_SESSION['city'] = $row1['City'];
				  $_SESSION['pin'] = $row1['Pincode'];	
				  $_SESSION['pc'] = $row1['Pincode'];
				  $name = $row1['FNAME']." ".$row1['MNAME']." ".$row1['LNAME'];	
				  $dob = $row1['BirthDate'];
				  $sex = $row1['SEX'];
			}
			
        		$age = (date('Y') - date('Y',strtotime($dob)));	
		
			 $pdf->Ln();
			echo "Contents";

			$address = substr($_SESSION['add'],0,40);
			$area = substr($_SESSION['area'],0,40);

                        $pdf->Cell(110,5,'                    Sr.No:'.''.$_SESSION['PrescId'].'',0,0,'L');
                        $pdf->Cell(110,5,'                    Date:'.''.$Dt.'',0,1,'L');
                        $pdf->Cell(110,5,'                    Patient Name:'.''.getFullName($_SESSION['PatId']).'',0,0,'L');
                        $pdf->Cell(110,5,'                    OPD No:'.''.$_SESSION['opd'].'',0,1,'L');
			//$pdf->Cell(40,5,'Age:'.''.$age.'',0,1,'L');
                        $pdf->Cell(110,5,'                    Address:'.''.$address.'',0,0,'L');
                        $pdf->Cell(110,5,'                    Age:'.''.$age.'',0,1,'L');
                        $pdf->Cell(110,5,'                    '.$area.'',0,0,'L');
                        $pdf->Cell(40,5,'                   Sex:'.''.$sex.'',0,1,'R');
                        $pdf->Cell(110,5,'                    City:'.''.$_SESSION['city'].''.'-'.''.$_SESSION['pin'].'',0,0,'L');
                        $pdf->Cell(110,5,'                    Weight:'.''.$wt.''.'Kg',0,1,'L');

                        $pdf->Ln(2.0);

			echo "Tab";
                        $pdf->Cell(50,10,'                    Rx',0,1,'L');

			//echo $_SESSION['PrescId'];
			$mquery="select * from ----- where PrescId=".$_SESSION['PrescId'];
			$mres=mysqli_query($_SESSION['conn'],$mquery);
		
			while($mrow=mysqli_fetch_array($mres)){
			$prepId=$mrow['PreparationId'];
			$form=$mrow['FormId']; 
			$strength=$mrow['StrengthId'];
			$unit=$mrow['UnitId'];
			$quant=$mrow['Quantity'];
			$dose=$mrow['PrepDoseId'];
			$freq=$mrow['FrequencyId'];
			$duration=$mrow['DurationId'];
			$instr=$mrow['InstructionId'];
			$route=$mrow['RouteId'];
			$advice = $mrow['AdviseId'];

			$ssql = "SELECT Descr from ----- WHERE Id =".$prepId;
			$resultb=mysqli_query($_SESSION['conn'],$ssql);
			if($rowb=mysqli_fetch_array($resultb)){
			$brandname = $rowb[0];
			}
			$drugstr='';
			$ssql = "SELECT * from ---- WHERE brandid = $prepId";
			$resultc=mysqli_query($_SESSION['conn'],$ssql);
			while($rowc=mysqli_fetch_array($resultc)){
			if($drugstr!=''){$drugstr .= ' + ';}
			$drugid = $rowc['drugid'];
			$_SESSION['DrugId'] = $drugid;
			$ssql = "SELECT Descr from ----- WHERE Id = $drugid";
			//echo $ssql;
			$resultd=mysqli_query($_SESSION['conn'],$ssql);
			if($rowd=mysqli_fetch_array($resultd)){
			$drugstr .= $rowd[0];
			//echo 'drug';
			//echo $drugstr;
				}
			}


			echo "Final";

			$pdf->SetFont('Arial','',11);

			$pdf->Cell(60,3,'                    '.$brandname.'',0,0,'L');
			$pdf->Cell(60,5,'                    '.getDescr($strength).''.''.getDescr($unit).'',0,0,'L');	
			$pdf->Cell(50,5,'('.''.$quant.''.')',0,1,'L');
                        $pdf->MultiCell(120,5,'                    ('.''.$drugstr.''.')',0,'L');
                        $pdf->Cell(40,5,'                    '.getDescr($dose).''.'             '.getDescrL($freq).'',0,0,'L');
			$pdf->Cell(100,5,'                               x'.getDescrL($duration).'',0,1,'L');
                        $pdf->Cell(50,5,'                    '.getDescr($route).'',0,0,'L');
			$pdf->Cell(70,5,'                    '.getDescr($instr).'',0,1,'L');
			 $pdf->Cell(100,5,'                   '.$advice.'',0,1,'L');	 $pdf->Ln();
			}
			$pdf->isFinished = true;

		
      			$pdf->Close();
			echo "Closed";

     			$pdffilename = 'p.pdf';

	  	   	$pdf->Output($pdffilename,'F');
			
			echo "Done";

}
	

function ActOnButtons() {
//x=&y= for coordinates of up/dn buttons
        if (isset($_POST['B_Back'])) {
                header("Location: p.php");
        }

        if (isset($_POST['B_Print'])) {
                //$prescid=$_SESSION['PrescId'];
                genPDF1();
                header("Location: p.pdf");
        }
}


MakeDBConnection();
ActOnButtons();
?>
