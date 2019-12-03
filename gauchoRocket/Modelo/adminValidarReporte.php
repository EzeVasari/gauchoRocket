<?php
include('conexion.php');

$queryReporteDos = "select sum(v.precio) as sumaViaje, sum(ts.precio) as sumaServicio, sum(tc.precio) as sumaCabina
                    from viaje as v
                        inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                        inner join reserva as r on u.fkCodigoReserva = r.codigo
                        inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                        inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                        inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                        inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                        inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                    where ir.fechaQuePidioReserva between date_sub(now(), interval 1 month) and now() and ir.pago = true;";
$resultadoReporteDos = mysqli_query($conexion, $queryReporteDos);


$queryReporteTres = "select count(c.codigoCabina) as cantidad, tc.descripcion
                     from itemReserva as ir
                        inner join cabina as c on ir.fkCodigoCabina = c.codigoCabina
                        inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                     group by fkCodigoCabina
                     order by cantidad desc;";
$resultadoReporteTres = mysqli_query($conexion, $queryReporteTres);


$queryReporteCuatro = "select rel.fkEmailCliente as clientes, sum(v.precio) as sumaViaje, sum(ts.precio) as sumaServicio, sum(tc.precio) as sumaCabina
                       from viaje as v
                            inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                            inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                            inner join relacionClienteItemReserva as rel on rel.fkIdItemReserva = ir.idItemReserva
                       where ir.pago = true
                       group by clientes;";
$resultadoReporteCuatro = mysqli_query($conexion, $queryReporteCuatro);




?>
