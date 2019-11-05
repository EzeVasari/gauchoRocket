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











































