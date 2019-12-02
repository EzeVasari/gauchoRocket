use gauchorocket;
/*Vista/checkin.php?vuelo=1&cabina=1&origen=2&destino=3*/

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
WHERE v.codigo = 1 and c.codigoCabina = 1 and t.fkCodigoLugarOrigen = 2 and t.fkCodigoLugarDestino = 3;


SELECT ir.fkCodigoReserva AS codigo, v.imagen AS img, v.nombre AS nombre,
	v.descripcion AS descripcion, v.precio AS precio, idItemReserva as cod,
	ir.pago as pago, ir.checkin as checki, ir.listaDeEspera as espera,
	ir.fechaInicioDeCheckin as fechaI, ir.fechaLimiteDeCheckin as fechaL, now() as ahora
FROM relacionClienteItemReserva AS rcr
INNER JOIN itemReserva AS ir 
	ON rcr.fkIdItemReserva = ir.idItemReserva
INNER JOIN Reserva AS r 
	ON ir.fkCodigoReserva = r.codigo
INNER JOIN relacionReservaTrayecto as rrt 
	ON r.codigo = rrt.fkCodigoReserva
INNER JOIN trayecto as t 
	ON rrt.fkIdTrayecto = t.idTrayecto
INNER JOIN relacionViajeTrayecto as rvt 
	ON t.idTrayecto = rvt.fkIdTrayecto
INNER JOIN viaje AS v 
	ON rvt.fkCodigoViaje = v.codigo
WHERE fkEmailCliente = 'uno@gmail.com';


SELECT * 
FROM trayecto as t
INNER JOIN relacionViajeTrayecto as rvt
	ON t.idTrayecto = rvt.fkIdTrayecto
WHERE t.fkCodigoLugarOrigen = 2 and fkCodigoLugarDestino = 3 and fkCodigoViaje = 1;


INSERT INTO relacionReservaTrayecto (fkCodigoReserva, fkIdTrayecto) VALUES 
('0qgskx', 1);

update tipoDeCabina as tc INNER JOIN cabina as c
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
SET c.asientos = c.asientos - 1
WHERE v.codigo = 1 and c.codigoCabina = 1 and t.fkCodigoLugarOrigen = 2 and t.fkCodigoLugarDestino = 3;


SELECT *
FROM ubicacion as u INNER JOIN trayecto as t
	ON u.fkIdTrayecto = t.idTrayecto
WHERE estado = false and fkCodigoCabina = 1 and fkCodigoViaje = 1 and t.fkCodigoLugarOrigen =2 and t.fkCodigoLugarDestino =3;


SELECT t.fkCodigoLugarOrigen AS origen, t.fkCodigoLugarDestino AS destino
FROM reserva AS r INNER JOIN relacionReservaTrayecto AS rrt
	ON r.codigo = rrt.fkCodigoReserva
INNER JOIN trayecto AS t
	ON rrt.fkIdTrayecto = t.idTrayecto
WHERE r.codigo = 'bsu5wj';

UPDATE ubicacion as u
SET estado = false
WHERE CONCAT(u.filaUbicacion, u.columnaUbicacion) = 'A2';

SELECT CONCAT(u.filaUbicacion, u.columnaUbicacion) as id, u.estado
FROM ubicacion as u
WHERE CONCAT(u.filaUbicacion, u.columnaUbicacion) = 'A2';

SELECT count(idUbicacion) as asientosReservados
FROM ubicacion as u
	INNER JOIN trayecto as t ON u.fkIdTrayecto = t.idTrayecto
WHERE fkCodigoCabina = 1 and fkCodigoViaje = 1 and t.fkCodigoLugarOrigen = 2 and t.fkCodigoLugarDestino = 3;

SELECT * 
FROM trayecto as t
	INNER JOIN relacionViajeTrayecto as rvt ON t.idTrayecto = rvt.fkIdTrayecto
WHERE t.fkCodigoLugarOrigen = 2 and t.fkCodigoLugarDestino = 3 and fkCodigoViaje = 1;

SELECT *
FROM viaje as v
	inner join equipo as e on v.matriculaEquipo = e.matricula
WHERE v.codigo = 1;
select v.nombre as viaje, t.fkCodigoLugarOrigen as tOrigen, t.fkCodigoLugarDestino as tDestino, t.nombreTrayecto as tNombre,
	i.fkCodigoReserva as reserva, i.idItemReserva as item, i.pago as pago
from ItemReserva as i
	inner join reserva as r on i.fkcodigoReserva = r.codigo
	inner join relacionReservaTrayecto as rela on r.codigo = rela.fkCodigoReserva
    inner join trayecto as t on rela.fkIdTrayecto = t.idTrayecto
    inner join relacionViajeTrayecto as rvt on t.idTrayecto = rvt.fkIdTrayecto
    inner join viaje as v on rvt.fkCodigoViaje = v.codigo
    inner join lugar as l on l.codigo = t.fkCodigoLugarOrigen
    inner join relacionClienteItemReserva as rel on i.idItemReserva = rel.fkIdItemReserva
where rel.fkEmailCliente like 'dos@gmail.com';

select *
from viaje as v
	inner join equipo as e on v.matriculaEquipo = e.matricula
where v.codigo = 1;

select *
from ubicacion;

select *
from itemReserva;

SELECT ir.fkCodigoReserva AS codigo, v.imagen AS img, v.nombre AS nombre,
	v.descripcion AS descripcion, v.precio AS precio, idItemReserva as cod,
	ir.pago as pago, ir.checkin as checki, ir.listaDeEspera as espera, v.codigo as codViaje, 
    c.codigoCabina as cabina, t.fkCodigoLugarOrigen as origen, t.fkCodigoLugarDestino as destino,
	ir.fechaInicioDeCheckin as fechaI, ir.fechaLimiteDeCheckin as fechaL, now() as ahora
FROM relacionClienteItemReserva AS rcr
	INNER JOIN itemReserva AS ir ON rcr.fkIdItemReserva = ir.idItemReserva
	INNER JOIN Reserva AS r ON ir.fkCodigoReserva = r.codigo
	INNER JOIN relacionReservaTrayecto as rrt ON r.codigo = rrt.fkCodigoReserva
	INNER JOIN trayecto as t ON rrt.fkIdTrayecto = t.idTrayecto
	INNER JOIN relacionViajeTrayecto as rvt ON t.idTrayecto = rvt.fkIdTrayecto
	INNER JOIN viaje AS v ON rvt.fkCodigoViaje = v.codigo
    INNER JOIN ubicacion as u on u.fkCodigoReserva = r.codigo
    INNER JOIN cabina as c on c.codigoCabina = u.fkCodigoCabina
WHERE fkEmailCliente = 'dos@gmail.com';

SELECT * 
FROM ubicacion as u
	INNER JOIN trayecto as t ON u.fkIdTrayecto = t.idTrayecto
WHERE fkCodigoCabina = 1
	and fkCodigoViaje = 1
    and t.fkCodigoLugarOrigen = 2
    and t.fkCodigoLugarDestino = 3
    and u.fkCodigoReserva like 'jdy0cf';

/* CAPACIDAD MÁXIMA */
select (e.capacidadSuit + e.capacidadGeneral + e.capacidadFamiliar + 1) as asientosTotales
from reserva as r
	inner join ubicacion as u on u.fkCodigoReserva = r.codigo
    inner join viaje as v on u.fkCodigoViaje = v.codigo
    inner join equipo as e on v.matriculaEquipo = e.matricula
where r.codigo like 'jdy0cf';
/* ================ */

select *
from itemReserva;

select *
from ubicacion;

select *
from relacionClienteItemReserva;

select *
from relacionReservaTrayecto;

insert into relacionClienteItemReserva (fkIdItemReserva, fkEmailCliente, fecha) values
(5450, 'tres@gmail.com', '2019-11-30 19:57:50');

/* ========================================================================================== */
select count(*) as resultado
from relacionClienteItemReserva as rel
	inner join itemReserva as ir on rel.fkIdItemReserva = ir.idItemReserva
	inner join reserva as r on ir.fkcodigoReserva = r.codigo
where r.codigo like '7rvxbj';
/* ========================================================================================== */





/* ===================================================================================================================================== */
/* ============================================================= REPORTES ============================================================== */
/* ===================================================================================================================================== */

/* ================================================== VUELOS ================================================== */
/* ========== Cantidad de veces que fue reservado ========== */
select count(v.codigo) as cantidad, v.nombre as nombre
from viaje as v
	inner join relacionViajeTrayecto as relu on v.codigo = relu.fkCodigoViaje
	inner join trayecto as t on relu.fkIdTrayecto = t.idTrayecto
    inner join relacionReservaTrayecto as reld on t.idTrayecto = reld.fkIdTrayecto
    inner join reserva as r on reld.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and v.codigo = 1
;

/* ========== Cabina más solicitada en este viaje ========== */
select count(c.codigoCabina) as cantidad, t.descripcion as tipoCabina
from viaje as v
	inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as t on c.fkCodigoTipoDeCabina = t.codigoTipoDeCabina
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and v.codigo = 1
group by c.codigoCabina
order by cantidad desc
LIMIT 1;/* 4 - general */

/* ========== Servicio más solicitado en este viaje ========== */
select count(ir.fkCodigoServicio) as cantidad, ts.descripcion as tipoServicio
from viaje as v
	inner join relacionViajeTrayecto as relu on v.codigo = relu.fkCodigoViaje
	inner join trayecto as t on relu.fkIdTrayecto = t.idTrayecto
    inner join relacionReservaTrayecto as reld on t.idTrayecto = reld.fkIdTrayecto
    inner join reserva as r on reld.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and v.codigo = 1
group by ir.fkCodigoServicio
order by cantidad desc
LIMIT 1
;

/* ================================================= SERVICIO ================================================= */
/* Cuantas veces se solicitó */
/* Que vuelo más lo solicitó */
/* En qué cabinas más se solicitó */
/* En que equipos más se solicitó */
select count(s.fkcodigoTipoDeServicio) as cantidad, v.nombre as vuelo, tc.descripcion as tipoCabina,
	te.descripcion as equipoTipo, e.modelo as equipoModelo, ts.descripcion as tipoServicio
from servicio as s
	inner join itemReserva as ir on s.codigoServicio = ir.fkCodigoServicio
    inner join reserva as r on ir.fkcodigoReserva = r.codigo
    inner join ubicacion as u on r.codigo = u.fkCodigoReserva
    inner join viaje as v on u.fkCodigoViaje = v.codigo
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
    inner join equipo as e on v.matriculaEquipo = e.matricula
    inner join tipoDeEquipo as te on e.fkcodigoTipoDeEquipo = te.codigo
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and s.fkcodigoTipoDeServicio = 1
group by s.fkcodigoTipoDeServicio
order by cantidad desc
LIMIT 1;

/* ================================================== CABINAS ================================================= */
/* ========== Cantidad de veces que fue solicitado ========== */
select count(c.fkCodigoTipoDeCabina) as cantidad, tc.descripcion as tipoCabina
from cabina as c
	inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
	inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join viaje as v on u.fkCodigoViaje = v.codigo
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and c.fkCodigoTipoDeCabina = 1
group by c.fkCodigoTipoDeCabina;/* 9 */

/* ========== Vuelos que más solicitaron la cabina ========== */
select count(v.codigo) as cantidad, v.nombre as nombre
from cabina as c
	inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
	inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join viaje as v on u.fkCodigoViaje = v.codigo
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and c.fkCodigoTipoDeCabina = 1
group by v.codigo
order by cantidad desc
LIMIT 1;

/* ========== Servicio más solicitado para esta cabina ========== */
select count(s.codigoServicio) as cantidad, ts.descripcion as nombre
from cabina as c
	inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
	inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and c.fkCodigoTipoDeCabina = 1
group by s.codigoServicio
order by cantidad desc
LIMIT 1;

/* ========== Equipo en el que más se encuentra la cabina ========== */
select count(e.fkcodigoTipoDeEquipo) as cantidad, te.descripcion as nombre
from cabina as c
	inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
	inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join viaje as v on u.fkCodigoViaje = v.codigo
    inner join equipo as e on v.matriculaEquipo = e.matricula
    inner join tipoDeEquipo as te on e.fkcodigoTipoDeEquipo = te.codigo
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and c.fkCodigoTipoDeCabina = 1
group by e.fkcodigoTipoDeEquipo
order by cantidad desc
LIMIT 1;

/* ================================================== EQUIPOS ================================================= */
/* Cuantas veces fue utilizado el tipo de equipo */
/* En que vuelos más se encuentra*/
/* Con cuántos asientos cuenta*/
/* Servicio más utilizado*/
select count(v.matriculaEquipo) as cantidad, e.modelo as modelo, v.nombre as vuelo,
	e.capacidadSuit as suit, e.capacidadGeneral as gral, e.capacidadFamiliar as familiar,
	te.descripcion as servi, te.descripcion as desEquipo
from equipo as e
	inner join tipoDeEquipo as te on e.fkcodigoTipoDeEquipo = te.codigo
    inner join viaje as v on e.matricula = v.matriculaEquipo
    inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and e.fkcodigoTipoDeEquipo = 3
group by e.matricula
order by cantidad desc
LIMIT 1;







/* ===================================================================================================================================== */
/* ============================================================ FACTURACIÓN ============================================================ */
/* ===================================================================================================================================== */

/* Total facturado */
select sum(v.precio) as sumaViaje, sum(ts.precio) as sumaServicio, sum(tc.precio) as sumaCabina
from viaje as v
	inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now();

/* Total facturado de viajes */
select sum(v.precio) as cantidad, v.nombre as nombre
from viaje as v
	inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and v.codigo = 1;

/* Total facturado de servicios */
select sum(ts.precio) as cantidad, ts.descripcion as nombre
from viaje as v
	inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and s.fkcodigoTipoDeServicio = 1;

/* Total facturado de cabinas */
select sum(tc.precio) as cantidad, tc.descripcion as nombre
from viaje as v
	inner join ubicacion as u on v.codigo = u.fkCodigoViaje
    inner join reserva as r on u.fkCodigoReserva = r.codigo
    inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
    inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
    inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
    inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
where ir.fechaQuePidioReserva between date_sub(now(), interval 2 day) and now() and c.fkCodigoTipoDeCabina = 1;

SELECT rce.fkCodigoCabina as codigoCabina
FROM viaje as v
INNER JOIN equipo as e 
	ON v.matriculaEquipo = e.matricula
INNER JOIN relacionCabinaEquipo as rce 
	ON e.matricula = rce.fkMatriculaEquipo
WHERE v.codigo = 1;

SELECT t.fkCodigoLugarOrigen as origen, t.fkCodigoLugarDestino as destino
FROM reserva as r INNER JOIN relacionReservaTrayecto as rrt
	ON r.codigo = rrt.fkCodigoReserva 
INNER JOIN trayecto as t 
	ON rrt.fkIdTrayecto = t.idTrayecto
WHERE r.codigo = '09es0g';






























































