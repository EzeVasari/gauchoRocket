use gauchorocket;

select distinct l.nombre as nombre, v.codigoLugarOrigen as codigo
from viaje as v inner join lugar as l on v.codigoLugarOrigen = l.codigo;
select distinct l.nombre as codigo, v.codigoLugarOrigen as nombre from viaje as v inner join lugar as l on v.codigoLugarOrigen = l.codigo;

select *
from viaje
where codigoLugarOrigen = 1 and codigoLugarDestino = 3;
select * from viaje where codigoLugarOrigen = 1 and codigoLugarDestino = 3;

select l.codigoUsuario as usuario, l.pass as pass
from usuario as u inner join login as l on u.nick = l.codigoUsuario
where u.nick = 'Uno';
select l.codigoUsuario as usuario, l.pass as pass from usuario as u inner join login as l on u.nick = l.codigoUsuario where u.nick = 'Uno';

insert into reserva(codigoviaje, nombreusuario, checkin, pago, fechaLimite, fechaConfirmacion) values
();

select *
from viaje
where date(fecha) = '2019.10.27';
select * from viaje where date(fecha) = '2019.10.27';

select date_sub(fecha, interval 2 hour) as fechaLimite
from viaje
where codigo = 1;
select date_sub(fecha, interval 2 hour) as fechaLimite from viaje where codigo = 1;

insert into relacionClienteReserva(codigoReserva, codigoCliente, checkin, pago, fechaLimite, fechaConfirmacion) values
(1, 'Uno', false, false, '2019.10.27 10:00:00', null);

select c.codigo as codigo, c.turnos as turno, l.nombre as lugar, c.img as imagen
from centroMedico as c
	inner join lugar as l on c.lugar = l.codigo;

select nombre
from lugar as l
	inner join reserva as r on l.codigo
where codigo = 1;

insert into turnoMedico(codigoCliente, codigoLugar, nombreLugar) values
('Uno', 1, 'Buenos Aires');

select *
from turnoMedico;
/*

select rvc.codigo as codigo, v.imagen as imagen, v.nombre as nombre, v.descripcion as descripcion, v.precio as precio
from reserva as r
	inner join viaje as v on r.codigoViaje = v.codigo
    inner join relacionClienteReserva as rcr on r.codigo = rcr.codigoReserva
where rcr.codigoCliente like 'Uno';
*/

select verifMedica
from cliente
where codigoUsuario like 'Uno';


select fkEmailUsuario as user, verifMedica as medico, i.idItemReserva as cod, v.precio as precio, tcab.precio as precioCabina
from relacionClienteItemReserva as rel
	inner join cliente as c on rel.fkEmailCliente = c.fkEmailUsuario
	inner join itemReserva as i on rel.fkIdItemReserva = i.idItemReserva
    inner join reserva as r on i.fkCodigoReserva = r.codigo
    inner join viaje as v on r.codigoViaje = v.codigo
    inner join cabina as cab on i.fkCodigoCabina = cab.codigoCabina
    inner join tipoDeCabina as tcab on cab.fkCodigoTipoDeCabina = tcab.codigoTipoDeCabina
where fkIdItemReserva = 6695;

select * from turnomedico where fkEmailCliente like 'dos%';

select turnos
from centroMedico
where codigo = 1;

select *
from turnoMedico
where fkEmailCliente like '%uno%';

select c.turnos as turnos, l.nombre as nombre
from centroMedico as c
	inner join lugar as l on c.codigoLugar = l.codigo
where c.codigo = 1;

select t.fechaTurnoMedico as fecha, c.verifMedica as medico
from turnoMedico as t
	inner join cliente as c on t.fkEmailCliente = c.fkEmailUsuario
where t.fkEmailCliente like '%dos%';

select *
from cliente;

select *
from turnoMedico;

update cliente
set codigoCentroMedico = 1
where fkEmailUsuario like 'uno@gmail.com';

select fechaTurnoMedico from turnomedico;

SELECT DATE_SUB(fecha, INTERVAL 2 HOUR) as fl, DATE_SUB(fecha, INTERVAL 2 DAY) as fi, curtime()
FROM viaje WHERE codigo = 1;

select distinct tv.descripcion as nombre, tv.codigo as codigo
from viaje as v
	inner join tipoDeViaje as tv on v.codigoTipoDeViaje = tv.codigo;
select distinct tv.descripcion as nombre, tv.codigo as codigo from viaje as v inner join tipoDeViaje as tv on v.codigoTipoDeViaje = tv.codigo;



/* ========================================================================================== */
/* ========================================================================================== */
/* ========================================================================================== */



update itemReserva set pago = true where idItemReserva = 5407;
update itemReserva set checkin = true where idItemReserva = 5407;
update itemReserva set listaDeEspera = false where idItemReserva = 5407;

update cliente set verifMedica = true where fkEmailUsuario like 'uno@gmail.com';

select count(*) as cantidad
from itemReserva as ir
	inner join relacionClienteItemReserva as rel on ir.idItemReserva = rel.fkIdItemReserva
where (now() > ir.fechaInicioDeCheckin and ir.pago = false)
	or (now() > ir.fechaLimiteDeCheckin and ir.checkin = false)
    and (listaDeEspera = false);

/* 
select *
from itemReserva as ir
	inner join relacionClienteItemReserva as rel on ir.idItemReserva = rel.fkIdItemReserva
where now() > ir.fechaInicioDeCheckin and ir.pago = false;
			
select *
from itemReserva as ir
	inner join relacionClienteItemReserva as rel on ir.idItemReserva = rel.fkIdItemReserva
where now() > ir.fechaLimiteDeCheckin and ir.checkin = false;

select *
from itemReserva;

select *
from relacionClienteItemReserva;
*/

select codigoTipoDeCabina, descripcion
from tipoDeCabina;

select codigoTipoDeServicio, descripcion
from tipoDeServicio;

select codigo, descripcion
from tipoDeEquipo;

select u.active as estado, u.nombre as nombre, u.apellido as apellido, u.email as user, c.verifMedica as medico, c.nivelVuelo as nivel, u.dni as dni
from cliente as c
	inner join usuario as u on c.fkEmailUsuario = u.email
where u.email like 'uno@gmail.com';

select i.idItemReserva as item, i.fkCodigoReserva as reserva, i.pago as pago, v.nombre
from ItemReserva as i
	inner join reserva as r on i.fkcodigoReserva = r.codigo
	inner join viaje as v on r.codigoViaje = v.codigo
    inner join relacionClienteItemReserva as rel on i.idItemReserva = rel.fkIdItemReserva
where rel.fkEmailCliente like 'uno@gmail.com'
;



select count(v.codigo) as contadorVuelo, count(i.fkCodigoServicio) as contadorServicio, count(i.fkCodigoCabina) as contadorCabina, count(t.codigo) as contadorEquipo 
from itemReserva as i inner join reserva as r on r.codigo = i.fkcodigoReserva inner join viaje as v on
    v.codigo= r.codigoViaje inner join equipo as e on e.matricula=v.codigoEquipo inner join tipodeequipo as t on t.codigo = e.codigoTipoDeEquipo
where v.codigo=1;

select *
from relacionClienteItemReserva
where fecha between DATE_SUB(now(), interval 1 year) and now()
;

select t.fechaTurnoMedico as fecha, c.verifMedica as medico
from turnoMedico as t
                    inner join cliente as c on t.fkEmailCliente = c.fkEmailUsuario
                where t.fkEmailCliente like '%uno%';

update cliente set verifMedica = true, nivelVuelo = 1
where fkEmailUsuario like 'uno@gmail.com';

select *
from turnoMedico;



SELECT DISTINCT t.nombreTrayecto as trayecto
FROM trayecto as t INNER JOIN relacionViajeTrayecto as rvt 
	ON t.idTrayecto = rvt.fkIdTrayecto
WHERE rvt.fkCodigoViaje = 1;

SELECT * 
FROM trayecto 
WHERE fkCodigoLugarOrigen = 1 and fkCodigoLugarDestino = 3;


SELECT c.asientos
FROM tipoDeCabina as tc INNER JOIN cabina as c
	ON tc.codigoTipoDeCabina = c.fkCodigoTipoDeCabina
INNER JOIN relacionCabinaEquipo as rec
	ON c.codigoCabina = rec.fkCodigoCabina
INNER JOIN equipo as e
	ON rec.fkMatriculaEquipo = e.matricula
INNER JOIN viaje as v
	ON e.matricula = v.matriculaEquipo
INNER JOIN relacionViajeTrayecto as rvt
	ON v.codigo = rvt.fkCodigoViaje
INNER JOIN trayecto as t
	ON rvt.fkIdTrayecto = t.idTrayecto
WHERE v.codigo = 1 and c.codigoCabina = 1;




























