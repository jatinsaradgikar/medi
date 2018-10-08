
<?php 

session_start();
ob_start();
error_reporting(0);
setcookie("my",420);
ob_flush();

function saveData() {
    $res = $_POST['res'];
    $mod = $_POST['mod'];
    $surg = $_POST['surg'];
    $anaem = $_POST['anaem'];
    $vent = $_POST['vent'];
    $unplvent = $_POST['unplvent'];
    $event = $_POST['event'];
    $anaevent = $_POST['anaevent'];
    $mort = $_POST['mort'];
    $anaemort = $_POST['anaemort'];
    $poremk = $_POST['poremk'];
    $anid = $_SESSION['AnId'];
	
    $ssql = "Update ----- set Surg = '$res', AnaeMod = '$mod', SuR = '$surg', AnMod= '$anaem', UnplVent = '$vent', UnVent  = '$unplvent', AdveEvent = '$event', AdveDrug = '$anaevent', AnaeMo  = '$mort', AnM = '$anaemort', PostO = '$poremk' WHERE Id =".$anid;

    //$_SESSION['statusmsg']= $ssql;

    $result = mysqli_query($_SESSION['conn'],$ssql);	
    $entrydate = date('Y-m-d H:i:s');
    $prcid = 20;
    $ptid = $_SESSION['PatId'];
    $sno = $anasid;
    $pgs = 'Anesthesia record completed';	
    $dbi = $_SESSION['DbId']; 		
    $dbn = AddToDash($entryd, $prcid, $ptid, $srn, $pgs, $dbi);	
    //$_SESSION['AnId']= $anid; 	
    $_SESSION['DbI']= $dbn; 		
}


require('fpdf.php');

//function genPDF1() {

class ePDF extends FPDF {

            function Header() {
                $width=$this->w;
                $height=$this->h;

                                //echo $width; echo $height;
				 $this->setFillColor(0,0,0);
				 $this->SetFont('Arial','B',12);
			         $this->setTextColor(255,255,255);
	                         $this->Cell(0,10,'ANAESTHESIA RECORD',1,1,'R',1);
			}


			 function Footer() {
                       		}

		
			     function BasicTable($header, $data)
			     {
                    // Header
    				foreach($header as $col)
        				$this->Cell(24,7,$col,1,0,'C');
    				    $this->Ln();
                    // Data
    				foreach($data as $row)
    				{
					   echo $row;
        				foreach($row as $col)
					   {
						  echo $col;
						  //echo "inner for";
						  //echo "col:".$col;
                          //$this->Cell(24,6,$col,1,0,'C');
					   }	
        				//$this->Ln();
					//echo $row;
    				}
			     }    
        }
        //}



function genPDF1() {

            $pdf = new ePDF();
			$header = array('T pm/am','P/min','BP mmHg','SaO2','Urine','IV fluids','IV Druges','Remarks');
			$data = array(

					array()

				);
                        $pdf->AddPage();
                        $pdf->SetFont('Arial','',12);
                        $pdf->Ln();


			$sql = "select * from ----- where Id=--";
			$result = mysqli_query($_SESSION['conn'],$sql);

		        if($row = mysqli_fetch_array($result)) {

				$preopc = $row['PreO'];

				//$name = $row['FN'];
				$age = $row['PatA'];
				$sex = $row['PatS'];
				$wt = $row['PatW'];
				$sdt = $row['SurgDT'];

				$sdate = date('d/m/Y',$sdt);

				$bps = $row['BpSyst1'];
				$bpd = $row['BpDiast1'];

				$bps1 = $row['BpSyst2'];
				$bpd1 = $row['BpDiast2'];

				$hb = $row['Hemoglobin'];
				
				$ecg = $row['Ecg1'];
				$xrc = $row['Xray'];
			

				$histsurganae = $row['HistSurgAnae'];
				$hallergy = $row['HistAllergy'];
				$hmedi = $row['HistMedi'];

				$bht = $row['Bht'];

				$urine = $row['Urine'];

				$bslF = $row['BslF'];
				$bslPP = $row['BslPP'];
				$bul = $row['BldUrea'];

				$oc = $row['OralCavity'];
				$nc = $row['NasalCavity'];

				$cns = $row['CNS'];
				$systemic = $row['systemic'];

				$rf = $row['RiskFact'];

				$SurgProc = $row['SurgProc'];
				
				$asa = $row['AsaGrade'];
				$consent = $row['Consent'];
				$nbm = $row['NbmState'];
				$premed = $row['PreMed'];
				$position = $row['Position'];
				$induction = $row['Induction'];
				$saelc = $row['SaELC'];
				$drug = $row['Drug'];
				$maint = $row['Maint'];
				$space = $row['Space'];
				$level = $row['Level'];
				$lpneedle = $row['LpNeedle'];	


			}
	
			$sql="select * from ----- where Id=".$_SESSION['PtId'];
			$res=mysqli_query($_SESSION['conn'],$sql);
			while($rw=mysqli_fetch_Array($res)){
			$dob=$rw['BirthDate'];
			}
			$age = (date('Y') - date('Y',strtotime($dob)));
		                       


			$pdf->Cell(60,10,'Name:',1,0,'L');
			$pdf->Cell(32,10,'Age:'.''.$age.'',1,0,'L');
		        $pdf->Cell(32,10,'Sex:'.''.$sex.'',1,0,'L');
			$pdf->Cell(33,10,'Wt:'.''.$wt.'',1,0,'L');
			$pdf->Cell(33,10,'IndNo:',1,1,'L');


			$pdf->Cell(92,10,'Surg:     1)',1,0,'L');
			$pdf->Cell(98,10,'Anaesth:     1)',1,1,'L');

			$pdf->Cell(92,10,'              2)',1,0,'L');
			$pdf->Cell(98,10,'                   2)',1,1,'L');



			 $pdf->Cell(63,10,'On Date:'.''.$sdate.'',1,0,'L');
			 $pdf->Cell(63,10,'Time:',1,0,'L');
			 $pdf->Cell(64,10,'Operation:'.''.$SurgProc.'',1,1,'L');


			 $pdf->Cell(92,10,'Pre Op Comments:'.''.$preopc.'',0,0,'L');
			 $pdf->Cell(63,10,'Investigation',0,1,'L');



			 $pdf->Cell(92,7,'H          Sur/Anae:'.''.$histsurganae.''.'/'.''.$histallergy.'',0,0,'L');
                         $pdf->Cell(63,7,'HB:'.''.$hb.''.'                        Urine:'.''.$urine.'',0,1,'L');
			 $pdf->Cell(92,7,'             Illness:',0,0,'L');
		         $pdf->Cell(63,7,'BSL:'.''.$bslF.''.'/'.''.$bslPP.''.'                       BUL:'.''.$bul.'',0,1,'L');	
                         $pdf->Cell(92,7,'             Allergy:'.''.$hallergy.'',0,0,'L');
			 $pdf->Cell(63,7,'ECG:'.''.$ecg.'',0,1,'L');
			 $pdf->Cell(92,7,'             Medication:'.''.$hmedi.'',0,0,'L');
			 $pdf->Cell(63,8,'XRC:'.''.$xrc.'',0,1,'L');
			 $pdf->Cell(190,0.2,'',1,1,'L');
			 $pdf->Ln(2.0);

                         $pdf->Cell(63,7,'E           P:',0,0,'L');
			 $pdf->Cell(63,7,'BP:'.''.$bps.''.'/'.''.$bpd.'',0,0,'L');
		         $pdf->Cell(63,7,'CVS:'.''.$systemic.'',0,1,'L');	
		         $pdf->Cell(63,7,'             OC/NC:'.''.$oc.''.'/'.''.$nc.'',0,0,'L');
                         $pdf->Cell(63,7,'BHT:'.''.$bht.'',0,0,'L');
			 $pdf->Cell(63,7,'RS:',0,1,'L');
			 $pdf->Cell(63,7,'             BP:'.''.$bps1.''.'/'.''.$bpd1.'',0,0,'L');
			 $pdf->Cell(63,7,'CNS:'.''.$cns.'',0,0,'L');
 			 $pdf->Cell(63,7,'PA:',0,1,'L');
			 $pdf->Cell(63,7,'            Other:',0,1,'L');
			 $pdf->Cell(190,0.2,'',1,1,'L');


                         $pdf->Cell(92,20,'Risk Factor:'.''.$asa.''.' A S A GR:'.''.$rf.'',0,0,'L');
			 $pdf->Cell(0.2,30,'',1,0,'C');
  			 $pdf->Cell(93,20,'Consent/Informed:'.''.$consent.'',0,1,'L');
                         $pdf->Cell(118,5,'NBM Status:'.''.$nbm.'',0,1,'R');
			 $pdf->Cell(190,0.2,'',1,1,'L');	
			 $pdf->Ln();


			  $pdf->Cell(92,10,'Premedication:'.''.$premed.'',0,0,'L');
			  $pdf->Cell(0.2,15,'',1,0,'C');
                          $pdf->Cell(118,10,'Position:'.''.$position.'',0,1,'L');
			  $pdf->Cell(190,0.2,'',1,1,'L');
			  $pdf->Ln();


			  $pdf->Cell(92,10,'General Anaesthesia Induction:'.''.$induction.'',0,0,'L');
			  $pdf->Cell(0.2,60,'',1,0,'C');

                         $pdf->Cell(118,10,'SA/Epidural/Local/Combination:'.''.$sealc.'',0,1,'L');

			
			  $pdf->Cell(33,10,'Pento:       Ketamine:        Scoline:    ',0,0,'L');

			$pdf->Ln();	

                         $pdf->Cell(198,10,'Drug:'.''.$drug.''.' Lignocaine/Bupivacane:       %         cc ',0,1,'R');



			 $pdf->Cell(63,10,'Maintainance:'.''.$maint.'',0,1,'L');
                         $pdf->Cell(92,10,'O2      N20      Halothane      Ether      Trilene',0,0,'L');


			  $pdf->Cell(110,10,'Space:'.''.$space.''.'            L P No:'.''.$lpneedle.'',0,1,'R');
                          $pdf->Cell(133,10,'Sensory Level:'.''.$level.'',0,1,'R');
			  $pdf->Cell(190,0.2,'',1,1,'L');
			  $pdf->Ln();


			  $pdf->Cell(33,10,'Intubation: Naso/Orotracheal                No:',0,0,'L');
                         //$pdf->Cell(63,10,'No:',0,1,'L');



			 $pdf->Cell(118,10,'Pain/Cuff:     Air Entry:     Fixed',0,1,'R');
                         //$pdf->Cell(63,10,'Air Entry',0,1,'L');

                         //$pdf->Cell(63,10,'Fixed',0,1,'L');


	//		$pdf->Cell(0,10,'Name:                                                  Age:               Sex;               Wt:               Ind No:',1,1,'L');

			$pdf->Ln();


			$pdf->AddPage();
		
			 $pdf->Ln();

			$pdf->BasicTable($header,$data);


                        $pdf->Ln();
		
		         $pdf->Cell(190,0.2,'',1,1,'L');
			 $pdf->Cell(90,7,'Reversal with:      Neostigmine         mg',0,0,'L');
			 $pdf->Cell(0.2,7,'',1,1,'C');
			  
			 $pdf->Cell(90,7,'                             Atropine               mg',0,0,'L');
			 $pdf->Cell(0.2,65,'',1,0,'C');

			 $pdf->Cell(50,7,'Anaesthesia Post Operative Orders',0,1,'L');

		         $pdf->Cell(0,7,'Extubation:           Under vision',0,1,'L');
			 $pdf->Cell(0,7,'                             Reflexes',0,1,'L');	
			 $pdf->Cell(0,7,'                             Respiration',0,1,'L');
			 $pdf->Cell(0,7,'                             Consciousness',0,1,'L');

			 $pdf->Cell(0,10,'Post Operative     Pulse    BP    SaO2',0,1,'L');
			 $pdf->Cell(0,10,'ECG',0,1,'L');

			  $pdf->Cell(0,10,'Charges',0,1,'L');
			 $pdf->Cell(190,0.2,'',1,1,'L');

                        //echo $_SESSION['PrescId'];
                        
                        $pdf->isFinished = true;

                        $pdf->Close();

                        $pdffilename = 'AnaesthesiaSheet1.pdf';

                        $pdf->Output($pdffilename,'F');
}

function ActOnButtons(){
    //x=&y= for coordinates of up/dn buttons
	if (isset($_POST['B_Reve'])) {
        saveData();
		header("Location: mwAnaeR.php");
    }

	if (isset($_POST['B_Print'])) {
		saveData();	
	 	genPDF1();
		header("Location: AnaestheS.pdf");	
	}
	
	
	if (isset($_POST['B_Save'])) {
        saveData();
//		header("Location: Dbd.php");
    }

	if (isset($_POST['B_DB'])) {
        saveData();
		header("Location: Dbd.php");
    }
	
	if (isset($_POST['B_Resch'])) {
        saveData();
        $_SESSION['CameFrom']='Ap.php';
		$eveid = 93;
		header("Location: Event_Dtls.php?eveid=".$eveid."&ipdidn=".$_SESSION['IpdId']);

	}

	if (isset($_POST['B_AnModi'])) {
        saveData();
        $_SESSION['CameFrom']='Anae_Post.php';
		$eveid = 94;
		header("Location: Event_Dtls.php?eveid=".$eveid."&ipdidn=".$_SESSION['IpdId']);
	}

	if (isset($_POST['B_UnplVent'])) {
        saveData();
        $_SESSION['CameFrom']='AnaeP.php';
		$eveid = 95;
		header("Location: Event.php?evid=".$eveid."&ipidn=".$_SESSION['IpId']);
    }
	
	

	if (isset($_POST['B_AnEvent'])) {
        saveData();
        $_SESSION['CameFrom']='mwAnaeP.php';
		$eveid = 96;
		header("Location: EventDtls.php?eveid=".$eveid."&ipdidn=".$_SESSION['IpId']);
    }

	if (isset($_POST['B_AnMort'])) {
        saveData();
        $_SESSION['CameFrom']='mwAnaeP.php';
		$eveid = 125;
		header("Location: EventD.php?eveid=".$eveid."&ipdidn=".$_SESSION['IpId']);
    }
	
}

MakeDBConnection();
ActOnButtons();

?>
