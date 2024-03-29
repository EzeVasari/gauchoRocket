<?php
require('../help/fpdf181/fpdf.php');

include('../Modelo/conexion.php');
    $reserva = $_GET['reserva'];
     $cliente = $_GET['cliente'];
    


     

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

    $this->Cell(30,10,'Facturacion');
    $this->Ln(20);
}

function table($reserva, $cliente)
{

include('../Modelo/conexion.php');


	$query = "select v.nombre as viaje, i.fkCodigoReserva as reserva, i.idItemReserva as item, i.pago as pago
        from ItemReserva as i
                                                                   inner join reserva as r on i.fkcodigoReserva = r.codigo
                                                                   inner join relacionReservaTrayecto as rrt on r.codigo= rrt.fkCodigoReserva
                                                                   inner join relacionViajeTrayecto as rvt on rvt.fkIdTrayecto= rrt.fkIdTrayecto
                                                                   inner join viaje as v on v.codigo= rvt.fkCodigoViaje
                                                                   inner join relacionClienteItemReserva as rci on i.idItemReserva = rci.fkIdItemReserva
                                                              where i.idItemReserva like '".$reserva."'and rci.fkEmailCliente like'".$cliente."';";
                                 $resultado = mysqli_query($conexion, $query);
                                 while($row = mysqli_fetch_assoc($resultado)){
                                 	$this->cell(30,1,'Su destino:');
                                 	$this->Cell(10,1,$row['viaje']);
                                 	$this->Ln(10);
                                 	$this->cell(30,1,'Su reserva:');
                                 	$this->Cell(10,1,$row['reserva']);
                                 	$this->Ln(10);
                                 	$this->cell(30,1,'Su monto:');
                                 	$this->Cell(10,1,$row['item']);
                                 	$this->Ln(10);
                                 	$this->cell(30,1,'Su id:');
                                 	$this->Cell(10,1,$row['pago']);
                                 	$this->Ln(10);


}

}


}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->table($reserva, $cliente);
$pdf->Output();


?>
