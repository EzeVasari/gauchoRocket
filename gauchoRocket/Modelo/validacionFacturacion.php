 <?php
include('conexion.php');

/*
Oscar, para validar el tiempo que quieras en tus consultas, tendrías que usar la condición where que te detallo abajo.
en "...interval 1..." tendrías que reemplazar el 1 por lo que recibe de POST de la casilla de ANTIGÜEDAD y el day lo
reemplazás por lo que recibe de POST de período.
Este último lo podés reemplazar por: 
-day
-week (si lo probás en mysql no le cambia el color pero funciona)
-month
-year

select *
from relacionClienteItemReserva
where fecha between DATE_SUB(now(), interval 1 day) and now()
*/

?>
