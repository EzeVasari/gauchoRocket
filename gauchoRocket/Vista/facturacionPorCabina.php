<?php

require('../help/fpdf181/fpdf.php');

include('../Modelo/conexion.php');
    $cabina = $_GET['cabina'];

     

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/cohete.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'GauchoRocket ');
    // Salto de línea
    $this->Ln(20);

    $this->Cell(30);

    $this->Cell(30,10,'facturacion por Cabina');
    $this->Ln(20);
}

function table($cabina)
{

include('../Modelo/conexion.php');

$query = "select count(i.fkCodigoCabina) as vendido, t.descripcion as descripcion, count(i.fkCodigoCabina)*t.precio as total
from itemreserva as i inner join cabina as c on c.codigoCabina= i.fkCodigoCabina inner join tipoDeCabina as t on t.codigoTipoDeCabina= c.fkCodigoTipoDeCabina 
     where t.codigoTipoDeCabina like '".$cabina."'";
                                 $resultado = mysqli_query($conexion, $query);
                                 while($row = mysqli_fetch_assoc($resultado)){
                                 	$this->cell(30,1,'Vendidos:'.$row['vendido']);
                                 	$this->Ln(10);
                                 	$this->cell(30,1,'descripcion:');
                                 	$this->Cell(10,1,$row['descripcion']);
                                 	$this->Ln(10);
                                    $this->cell(30,1,'facturacion ToTal: '.$row['total']);
                                    $this->Ln(10);

                                 	


}

}


}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->table($cabina);
$pdf->Output();


?>