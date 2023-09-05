<?

//connect.php
//將sqli改成sql

$location="localhost";//連到本機
$account="root";
$password="a1075504";

$link=mysql_pconnect($location,$account,$password);


//$connect = mysql_connect("localhost", "root", "12345678", "ors");

//$EP=1002;
$EP=$_GET["EP"];
//echo $EP;
$sql_query="SELECT * FROM receipt WHERE receipt_No='". $EP ."'";
$result=mysql_query($sql_query);


require("fpdf183/fpdf.php");

$pdf = new FPDF('p', 'mm', 'A4');

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->cell(180, 10, "WELCOME TO NUK", 0, 2, 'C');

$pdf->SetFont('Arial', '', 12);

while($row = mysql_fetch_array($result))
{
    $pdf->cell(180, 10, "Receipt Number: " .$row["receipt_No"], 0, 2, 'C');
    $pdf->cell(180, 10, "Name: " .$row["account_belong"], 0, 2, 'C');
    $pdf->cell(180, 10, "Barbeque Place: " .$row["c_Num"], 0, 2, 'C');
    $pdf->cell(180, 10, "Tent Place: " .$row["b_Num"], 0, 2, 'C');
    $pdf->cell(180, 10, "Number of People: " .$row["person_Num"], 0, 2, 'C');
    $pdf->cell(180, 10, "Tax ID Number: " .$row["tax_ID"], 0, 2, 'C');
    $pdf->cell(180, 10, "Time: " .$row["time"], 0, 2, 'C');
}

$pdf->SetFont('Arial', 'B', 14);
$pdf->cell(180, 10, "WISH YOU AN AWESOME DAY", 0, 2, 'C');

$pdf->OutPut();
?>