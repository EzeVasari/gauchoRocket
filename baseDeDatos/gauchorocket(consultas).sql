use gauchorocket;

SELECT distinct l.nombre as codigo, v.origen as nombre
FROM viaje as v inner join lugar as l on v.origen = l.codigo;
SELECT distinct l.nombre as codigo, v.origen as nombre FROM viaje as v inner join lugar as l on v.origen = l.codigo;

SELECT *
FROM viaje
WHERE origen = 1 and destino = 3;
SELECT * FROM viaje WHERE origen = 1 and destino = 3;

SELECT l.fknick as usuario, l.pass as pass
FROM usuario as u inner join login as l on u.nick = l.fknick
WHERE u.nick = 'usuarioUno';
SELECT * FROM usuario as u inner join login as l on u.nick = l.fknick WHERE l.fknick = 'usuarioUno';

insert into relacionViajeCliente(codigoviaje, nombreusuario, checkin, pago, fechaLimite, fechaConfirmacion) values
();

SELECT *
FROM viaje
WHERE DATE(fecha) = '2019.10.27';

SELECT DATE_SUB(fecha, INTERVAL 5 HOUR) as fl
FROM viaje
WHERE codigo = 1;
SELECT DATE_SUB(fecha, INTERVAL 5 HOUR) as fl FROM viaje WHERE codigo = 1;

insert into relacionViajeCliente(codigoviaje, nombreusuario, checkin, pago, fechaLimite, fechaConfirmacion) values
(1, 'usuarioUno', false, false, '2019.10.27 07:00:00', null);

select*
from relacionViajeCliente;

select c.codigo as codigo, c.turnos as turno, l.nombre as lugar, c.img as imagen
from centroMedico as c
	inner join lugar as l on c.lugar = l.codigo;
select c.codigo as codigo, c.turnos as turno, l.nombre as lugar, c.img as imagen from centroMedico as c inner join lugar as l on c.lugar = l.codigo;

select nombre
from lugar
where codigo = 1;
select nombre from lugar where codigo = 1;

insert into turnoMedico(cliente, codigolugar, nombrelugar) values
('usuarioUno', 1, 'Buenos Aires');

select *
from turnoMedico;

select rvc.codigo as codigo, v.img as imagen, v.nombre as nombre, v.descripcion as descripcion, v.precio as precio
from relacionViajeCliente as rvc
	inner join viaje as v on rvc.codigoviaje = v.codigo
where rvc.nombreusuario like 'usuarioUno';

select verifMedica
from cliente
where usuario like 'usuarioUno';
select verifMedica from cliente where usuario like 'usuarioUno';



























