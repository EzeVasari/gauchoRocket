use gauchorocket;

insert into lugar (codigo, nombre) values
(1, 'Buenos Aires'),
(2, 'Ankara'),
(3, 'EEI'),
(4, 'Orbiter Hotel'),
(5, 'Luna'),
(6, 'Marte'),
(7, 'Europa'),
(8, 'Io'),
(9, 'Encelado'),
(10, 'Titan'),
(11, 'Ganimedes'),
(12, 'Neptuno'),
(13, 'Shanghai');

insert into tipoDeViaje (codigo, descripcion) values
(1, 'Orbitales'),
(2, 'SubOrbitales');

insert into tipoDeEquipo (codigo, descripcion) values
(1, 'Baja aceleracion'),
(2, 'Alta aceleracion'),
(3, 'Orbitales')/*,
(4, 'SubOrbitales')*/;

insert into equipo (matricula, modelo, capacidadSuit, capacidadGeneral, capacidadFamiliar, fkCodigoTipoDeEquipo) values
('AA1', 'Aguila', 25, 200, 75, 2),
('AA5', 'Aguila', 25, 200, 75, 2),
('AA9', 'Aguila', 25, 200, 75, 2),
('AA13', 'Aguila', 25, 200, 75, 2),
('AA17', 'Aguila', 25, 200, 75, 2),
('BA8', 'Aguilucho', 10, 0, 50, 1),
('BA9', 'Aguilucho', 10, 0, 50, 1),
('BA10', 'Aguilucho', 10, 0, 50, 1),
('BA11', 'Aguilucho', 10, 0, 50, 1),
('BA12', 'Aguilucho', 10, 0, 50, 1),
('O1', 'Calandria', 25, 200, 75, 3),
('O2', 'Calandria', 25, 200, 75, 3),
('O6', 'Calandria', 25, 200, 75, 3),
('O7', 'Calandria', 25, 200, 75, 3),
('BA13', 'Canario', 10, 0, 70, 1),
('BA14', 'Canario', 10, 0, 70, 1),
('BA15', 'Canario', 10, 0, 70, 1),
('BA16', 'Canario', 10, 0, 70, 1),
('BA17', 'Canario', 10, 0, 70, 1),
('BA4', 'Carancho', 0, 110, 0, 1),
('BA5', 'Carancho', 0, 110, 0, 1),
('BA6', 'Carancho', 0, 110, 0, 1),
('BA7', 'Carancho', 0, 110, 0, 1),
('O3', 'Colibri', 2, 100, 18, 3),
('O4', 'Colibri', 2, 100, 18, 3),
('O5', 'Colibri', 2, 100, 18, 3),
('O8', 'Colibri', 2, 100, 18, 3),
('O9', 'Colibri', 2, 100, 18, 3),
('AA2', 'Condor', 40, 300, 10, 2),
('AA6', 'Condor', 40, 300, 10, 2),
('AA10', 'Condor', 40, 300, 10, 2),
('AA14', 'Condor', 40, 300, 10, 2),
('AA18', 'Condor', 40, 300, 10, 2),
('AA4', 'Guanaco', 100, 0, 0, 2),
('AA8', 'Guanaco', 100, 0, 0, 2),
('AA12', 'Guanaco', 100, 0, 0, 2),
('AA16', 'Guanaco', 100, 0, 0, 2),
('AA3', 'Halcon', 25, 150, 25, 2),
('AA7', 'Halcon', 25, 150, 25, 2),
('AA11', 'Halcon', 25, 150, 25, 2),
('AA15', 'Halcon', 25, 150, 25, 2),
('AA19', 'Halcon', 25, 150, 25, 2),
('BA1', 'Zorzal', 0, 50, 50, 1),
('BA2', 'Zorzal', 0, 50, 50, 1),
('BA3', 'Zorzal', 0, 50, 50, 1); 

insert into viaje (codigo, descripcion, precio, nombre, fecha, codigoLugarOrigen, codigoLugarDestino, codigoTipoDeViaje, matriculaEquipo) values
(1, 'Vuelo desde Ankara hasta Marte en 8hs. Trayectos : Ankara-EEI, EEI-OH, OH-Luna, etc.', 7000, 'Ankara - Marte', '2019.12.06 21:30:00', 2, 4, 2, 'O1'),
(2,'Vuelo desde Buenos Aires a Marte en 8hs.', 7000, 'Bs. As. - Marte', '2019.12.06 21:30:00', 1, 4, 2, 'AA1'),
(4,'Vuelo completo desde Buenos Aires hacia Titan en 77 hs.', 10000, 'Bs. As. - Titan', '2020.10.23 12:00:00', 1, 8, 1, 'BA10');
/* A LOS SIGUIENTES HAY QUE ESTABLECER 1 DÍA MÁS TARDE DESDE LA FECHA EN QUE SE DECIDA HACER LA PRIUEBA 
(7, 'img/prueba.jpg', 'VUELO DE PRUEBA 1.', 11000, 'Se abonó a tiempo',      '2019.11.20 18:00:00', 72, 2, 8, 1, 4444),/*pasar "listaDeEspera" a FALSE y "pago" a TRUE
(8, 'img/prueba.jpg', 'VUELO DE PRUEBA 2.', 11000, 'No se abonó a tiempo',   '2019.11.20 18:00:00', 72, 2, 8, 1, 4444),/*pasar "listaDeEspera" a FALSE
(9, 'img/prueba.jpg', 'VUELO DE PRUEBA 3.', 11000, 'Se hizo el checkin',     '2019.11.20 18:00:00', 72, 2, 8, 1, 4444),/*pasar "listaDeEspera" a FALSE, "pago" a TRUE y "checkin" a TRUE
(10, 'img/prueba.jpg', 'VUELO DE PRUEBA 4.', 11000, 'No se hizo el checkin', '2019.11.19 23:30:00', 72, 2, 8, 1, 4444);/*pasar "listaDeEspera" a FALSE y "pago" a TRUE
 AL SIGUIENTE HAY QUE PONER LA FECHA ACTUAL Y 2 HORAS MÁS (ES DECIR, SI SON LAS 20HS PONERLE 22HS) */ 

insert into trayecto (idTrayecto, nombreTrayecto, imagen, precio, duracion, fkCodigoLugarOrigen, fkCodigoLugarDestino) values 
(1, 'Ankara - EEI', 'img/EEI.jpg', 1200, 2, 2, 3),
(2, 'Bs. As. - EEI', 'img/EEI.jpg', 1300, 2, 1, 3),
(3, 'EEI - OrbitalHotel', 'img/OH.jpg', 1800, 1, 3, 4),
(4, 'OrbitalHotel - Luna', 'img/Luna.jpg', 1500, 2, 4, 5),
(5, 'Luna - Marte', 'img/Marte.jpg', 2500, 3, 5, 6),
(6, 'Ankara - OrbitalHotel', 'img/OH.jpg', 3000, 3, 2, 4),
(7, 'Ankara - Luna', 'img/Luna2.jpg', 4500, 5, 2, 5),
(8, 'Ankara - Marte', 'img/Marte2.jpg', 7000, 8, 2, 6),
(9, 'Bs. As. - OrbitalHotel', 'img/OH.jpg', 3100, 3, 1, 4),
(10, 'Bs. As. - Luna', 'img/Luna.jpg', 4600, 5, 1, 5),
(11, 'Bs. As. - Marte', 'img/Marte.jpg', 7100, 8, 1, 6),
(12, 'EEI - Luna', 'img/Luna2.jpg', 3300, 3, 3, 5),
(13, 'EEI - Marte', 'img/Marte2.jpg', 5800, 6, 3, 6),
(14, 'OrbitalHotel - Marte', 'img/Marte.jpg', 4000, 5, 4,6);

insert into relacionViajeTrayecto (fkCodigoViaje, fkIdTrayecto) values
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 12),
(1, 13),
(1, 14),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14);

insert into usuario (dni, rol, nombre, apellido, fechaDeNacimiento, email, active) values
(1, true, 'Ala','Cran', '1992.08.10', 'admin@gmail.com', true),
(1111, false, 'Susana','Oria', '2000.01.01', 'uno@gmail.com', true),
(2222, false, 'Cesar','Noso', '2000.02.02', 'dos@gmail.com', true),
(3333, false, 'Micho','Tito', '2000.03.03', 'tres@gmail.com', true),
(4444, false, 'Lola','Mento', '2000.04.04', 'cuatro@gmail.com', true),
(5555, false, 'Soila','Cerda', '2000.05.05', 'cinco@gmail.com', true),
(6666, false, 'Paca','Garte', '2000.06.06', 'seis@gmail.com', true),
(7777, false, 'Ana','Tomia', '2000.07.07', 'siete@gmail.com', true),
(8888, false, 'Helen','Chufe', '2000.08.08', 'ocho@gmail.com', true),
(9999, false, 'Marcia','Ana', '2000.09.09', 'nueve@gmail.com', true);

insert into login (pass, fkEmailUsuario) values
(md5('asd'), 'admin@gmail.com'),
(md5('asd'), 'uno@gmail.com'),
(md5('asd'), 'dos@gmail.com'),
(md5('asd'), 'tres@gmail.com'),
(md5('asd'), 'cuatro@gmail.com'),
(md5('asd'), 'cinco@gmail.com'),
(md5('asd'), 'seis@gmail.com'),
(md5('asd'), 'siete@gmail.com'),
(md5('asd'), 'ocho@gmail.com'),
(md5('asd'), 'nueve@gmail.com');

insert into centroMedico (codigo, turnos, codigoLugar, imagen) values
(1, 200, 1, 'img/centrosMedicos/buenosaires.jpg'),
(2, 200, 2, 'img/centrosMedicos/ankara.jpg'),
(3, 200, 13, 'img/centrosMedicos/shanghai.jpg');

insert into cliente (fkEmailUsuario, verifMedica, nivelVuelo, montoDecompras) values
('uno@gmail.com', true, 1, 0),
('dos@gmail.com', true, 2, 0),
('tres@gmail.com', true, 3, 0),
('cuatro@gmail.com', false, null, 0),
('cinco@gmail.com', false, null, 0),
('seis@gmail.com', false, null, 0),
('siete@gmail.com', false, null, 0),
('ocho@gmail.com', false, null, 0),
('nueve@gmail.com', false, null, 0);

insert into admin (fkEmailUsuario, id) values
('admin@gmail.com', 1);

insert into tipoDeServicio (codigoTipoDeServicio, descripcion, precio) values
(1, 'Standard', 500),
(2, 'Gourmet', 600),
(3, 'Spa', 800);

/* ====== NECESARIO INCLUIR EN LA BD PORQUE EL USUARIO 2 YA REALIZÓ SU TURNO MÉDICO ====== */
insert into turnoMedico (fkEmailCliente, fechaTurnoMedico, codigoLugar, nombreLugar) values
('uno@gmail.com', '2019.01.01 17:00:00', 1, 'Buenos Aires'),
('dos@gmail.com', '2019.01.01 17:00:00', 1, 'Buenos Aires'),
('tres@gmail.com', '2019.01.01 17:00:00', 1, 'Buenos Aires');
/* ======================================================================================= */

insert into servicio (codigoServicio, fkcodigoTipoDeServicio) values 
(1, 1),
(2, 2),
(3, 3);

insert into tipoDeCabina (codigoTipoDeCabina, descripcion, precio) values
(1, 'General', 350),
(2, 'Familiar', 550),
(3, 'Suite', 850);

insert into cabina (codigoCabina, fkCodigoTipoDeCabina) values 
(1, 1),
(2, 2),
(3, 3);

insert into relacionCabinaEquipo (fkCodigoCabina, fkMatriculaEquipo) values 
(1, 'O1'),
(2, 'O1'),
(3, 'O1');

/*
insert into ubicacion(idUbicacion, estado,fkCodigoVuelo, fkIdTrayecto, fkCodigoCabina) values
(1, false, 1, 1, 1),
(2, true, 1, 1, 1),
(3, true, 1, 1, 1),
(4, true, 1, 1, 1),
(5, true, 1, 1, 1),
(6, true, 1, 1, 1),
(7, true, 1, 1, 1),
(8, true, 1, 1, 1),
(9, true, 1, 1, 1),
(10, true, 1, 1, 1),
(11, true, 3, 1, 1),
(12, true, 3, 1, 1),
(13, true, 3, 1, 1),
(14, true, 3, 1, 1),
(15, true, 3, 1, 1),
(16, true, 3, 1, 1);
*/

SET GLOBAL event_scheduler = ON;

delimiter //
create event tareasDiarias on schedule every 1 day
starts '2019-01-01 00:00:00'
do
begin
	update centroMedico set turnos = 300 where codigo = 1;
    update centroMedico set turnos = 200 where codigo = 2;
    update centroMedico set turnos = 210 where codigo = 3;
end //
delimiter ;

/* ============================================================ */

delimiter //
create event vaciarAsientosSinCheckin on schedule every 5 minute
starts '2019-01-01 00:00:00'
do
begin
	delete from relacionClienteItemReserva where fkIdItemReserva in
	(select idItemReserva
	from itemReserva
	where checkin = false and fechaLimiteDeCheckin < now());

	delete from ubicacion where fkCodigoReserva in
	(select r.codigo
	from reserva as r
		inner join itemReserva as ir on r.codigo = ir.fkCodigoReserva
	where ir.checkin = false and ir.fechaLimiteDeCheckin < now());

	delete from relacionreservatrayecto where fkCodigoReserva in
	(select r.codigo
	from reserva as r
		inner join itemReserva as ir on r.codigo = ir.fkCodigoReserva
	where ir.checkin = false and ir.fechaLimiteDeCheckin < now());

	delete from itemReserva where checkin = false and fechaLimiteDeCheckin < now();

	delete from reserva where codigo not in
	(select fkCodigoReserva
	from itemReserva);
end //
delimiter ;

/* ============================================================ */

delimiter //
create event clientesEnListaDeEspera on schedule every 5 minute
starts '2019-01-01 00:00:00'
do
begin
	update itemReserva
	set listaDeEspera = false,
		fechaLimiteDeCheckin = date_add(fechaLimiteDeCheckin, interval 115 minute),/*Hay tiempo hasta 5 minutos de iniciar el viaje*/
		fechaInicioDeCheckin = date_add(fechaInicioDeCheckin, interval 2790 minute)/*Se puede abonar hasta hora y media antes del checkin*/
	where fechaLimiteDeCheckin < now() and listaDeEspera = true;
end //
delimiter ;


