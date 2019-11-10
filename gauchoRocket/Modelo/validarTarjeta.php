<?php 

    include("conexion.php");

    session_start();


 if(isset($_GET["reserva"])){
        $codigoReserva = $_GET["reserva"];
    }

    $tarjeta = $_POST["nroTarjeta"];

    function luhn_check($number) {  /*algoritmo para tarjetas de 10 y 16 digitos*/

         //Strip any non-digits (useful for credit card numbers with spaces and hyphens)
          $number=preg_replace('/\D/', '', $number);

         //Set the string length and parity
          $number_length=strlen($number);
          $parity=$number_length % 2;

         //Loop through each digit and do the maths
          $total=0;
          for ($i=0; $i<$number_length; $i++) {
            $digit=$number[$i];
           //Multiply alternate digits by two
            if ($i % 2 == $parity) {
              $digit*=2;
             //If the sum is two digits, add them together (in effect)
              if ($digit > 9) {
                $digit-=9;
              }
            }
           //Total up the digits
            $total+=$digit;
          }

         //If the total mod 10 equals 0, the number is valid
          return ($total % 10 == 0) ? TRUE : FALSE;
    }


    $confirmacion = luhn_check($tarjeta); /*llamo a la funcion para validar una tarjeta por ejemplo 4111 1111 1111 1111 */

    if($confirmacion){
        $query="UPDATE itemReserva SET  itemReserva.pago = '1' WHERE fkCodigoReserva = '".$codigoReserva."'";

        $resultado = mysqli_query($conexion, $query);

    }else{
        header('Location: ../Vista/ingresoDePago.php');
    }

?>