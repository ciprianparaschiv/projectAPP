<?php
require('fpdf.php');

class Report extends FPDF
{
	var $title="";
	var $footer="";
	
	function setTitle($txt, $isUTF8 = false) {
		$this->title=$txt;
	}
	function setFooter($txt) {
		$this->footer=$txt;
	}
	
	function Header()
	{		
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Move to the right		
		//Title
		$this->Cell(0,10,$this->title,0,0,'C');
		//Line break
		$this->Ln(20);
	}

	//Page footer
	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}'. $this->footer,0,0,'C');
	}

	//Colored table
	function FancyTable($header,$data,$total=-1)
	{
		//Colors, line width and bold font
		$this->SetFillColor(255,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(128,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		//Header
		$num=count($header);
		for($i=0;$i<count($header);$i++) {
			$this->Cell($header[$i]['size'],7,$header[$i]['name'],1,0,'C',true);
			$tw+=$header[$i]['size'];
		}
		$this->Ln();
		//Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Data
		$fill=false;
		foreach($data as $row)
		{	
			$i=0;
			if(count($row)==1) {
				$this->Cell($tw,6,$row[0],'LRBT',0,'L',0);
				$fill=false;
			} else {
				foreach($row as $key=>$cell)
				{
						if($i>=$num) continue;
						$this->Cell($header[$i]['size'],6,$cell,'LR',0,$header[$i]['align'],$fill);
										$i++;
				}		
			}			
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell($tw,0,'','T');
		$this->Ln();
		if($total>-1) {
			$this->Cell($tw,6,'Total: '.$total.'$','LRB',0,'R',0);
		}
		
	}
}
/*
$pdf=new PDF();
//Column titles
$header=array('Country','Capital','Area (sq km)','Pop. (thousands)');
//Data loading
$data=$pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
*/
?>