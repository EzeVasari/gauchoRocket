<?php

require('../help/fpdf181/fpdf.php');

include('../Modelo/conexion.php');
    $servicio = $_GET['servicio'];

     

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

    $this->Cell(30,10,'facturacion por Servicio');
    $this->Ln(20);
}

function table($servicio)
{

include('../Modelo/conexion.php');

$query = "select count(i.fkCodigoServicio) as vendido, t.descripcion as descripcion, count(i.fkCodigoServicio)*t.precio as total
from itemreserva as i inner join servicio as s on s.codigoServicio= i.fkCodigoServicio inner join tipodeservicio as t on t.codigoTipoDeServicio= s.fkCodigoTipoDeServicio 
     where t.codigoTipoDeServicio like '".$servicio."'";
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
$pdf->table($servicio);
$pdf->Output();


?>