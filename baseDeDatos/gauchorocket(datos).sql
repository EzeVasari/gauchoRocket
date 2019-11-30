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
(3, 'Orbitales'),
(4, 'SubOrbitales');

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

insert into viaje (codigo, imagen, descripcion, precio, nombre, fecha, codigoLugarOrigen, codigoLugarDestino, codigoTipoDeViaje, matriculaEquipo) values
(1, 'img/marte2.jpg', 'Vuelo desde Ankara hasta Marte en 8hs. Trayectos : Ankara-EEI, EEI-OH, OH-Luna, etc.', 7000, 'Ankara - Marte', '2020.10.25 12:00:00', 2, 4, 2, 'O1'),
(2, 'img/Marte.jpg', 'Vuelo desde Buenos Aires a Marte en 8hs.', 7000, 'Bs. As. - Marte', '2020.10.22 12:00:00', 1, 4, 2, 'O1'),
(4, 'img/titan.jpg', 'Vuelo completo desde Buenos Aires hacia Titan en 77 hs.', 10000, 'Bs. As. - Titan', '2020.10.23 12:00:00', 1, 8, 1, 'O1');
/* A LOS SIGUIENTES HAY QUE ESTABLECER 1 DÍA MÁS TARDE DESDE LA FECHA EN QUE SE DECIDA HACER LA PRIUEBA 
(7, 'img/prueba.jpg', 'VUELO DE PRUEBA 1.', 11000, 'Se abonó a tiempo',      '2019.11.20 18:00:00', 72, 2, 8, 1, 4444),/*pasar "listaDeEspera" a FALSE y "pago" a TRUE
(8, 'img/prueba.jpg', 'VUELO DE PRUEBA 2.', 11000, 'No se abonó a tiempo',   '2019.11.20 18:00:00', 72, 2, 8, 1, 4444),/*pasar "listaDeEspera" a FALSE
(9, 'img/prueba.jpg', 'VUELO DE PRUEBA 3.', 11000, 'Se hizo el checkin',     '2019.11.20 18:00:00', 72, 2, 8, 1, 4444),/*pasar "listaDeEspera" a FALSE, "pago" a TRUE y "checkin" a TRUE
(10, 'img/prueba.jpg', 'VUELO DE PRUEBA 4.', 11000, 'No se hizo el checkin', '2019.11.19 23:30:00', 72, 2, 8, 1, 4444);/*pasar "listaDeEspera" a FALSE y "pago" a TRUE
 AL SIGUIENTE HAY QUE PONER LA FECHA ACTUAL Y 2 HORAS MÁS (ES DECIR, SI SON LAS 20HS PONERLE 22HS) */ 

insert into trayecto (idTrayecto, nombreTrayecto, precio, duracion, fkCodigoLugarOrigen, fkCodigoLugarDestino) values 
(1, 'Ankara - EEI', 1200, 2, 2, 3),
(2, 'Bs. As. - EEI', 1300, 2, 1, 3),
(3, 'EEI - OrbitalHotel', 1800, 1, 3, 4),
(4, 'OrbitalHotel - Luna', 1500, 2, 4, 5),
(5, 'Luna - Marte', 2500, 3, 5, 6),
(6, 'Ankara - OrbitalHotel', 3000, 3, 2, 4),
(7, 'Ankara - Luna', 4500, 5, 2, 5),
(8, 'Ankara - Marte', 7000, 8, 2, 6),
(9, 'Bs. As. - OrbitalHotel', 3100, 3, 1, 4),
(10, 'Bs. As. - Luna', 4600, 5, 1, 5),
(11, 'Bs. As. - Marte', 7100, 8, 1, 6),
(12, 'EEI - Luna', 3300, 3, 3, 5),
(13, 'EEI - Marte', 5800, 6, 3, 6),
(14, 'OrbitalHotel - Marte', 4000, 5, 4,6);

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
(1234, false, 'Susana','Oria', '2000.01.01', 'uno@gmail.com', true),
(2345, false, 'Cesar','Noso', '2000.01.01', 'dos@gmail.com', true),
(10, false, 'Micho','Tito', '1992.08.10', 'tres@gmail.com', true),
(1, true, 'Ala','Cran', '1992.08.10', 'admin@gmail.com', true);

insert into login (pass, fkEmailUsuario) values
(md5('asd'), 'uno@gmail.com'),
(md5('asd'), 'dos@gmail.com'),
(md5('asd'), 'tres@gmail.com'),
(md5('asd'), 'admin@gmail.com');


insert into centroMedico (codigo, turnos, codigoLugar, imagen) values
(1, 200, 1, 'img/centrosMedicos/buenosaires.jpg'),
(2, 200, 2, 'img/centrosMedicos/ankara.jpg'),
(3, 200, 13, 'img/centrosMedicos/shanghai.jpg');

insert into cliente (fkEmailUsuario, verifMedica, nivelVuelo, montoDecompras) values
('uno@gmail.com', false, null, 0),
('dos@gmail.com', true, 1, 0),
('tres@gmail.com', false, null, 0);

insert into admin (fkEmailUsuario, id) values
('admin@gmail.com', 1);

insert into tipoDeServicio (codigoTipoDeServicio, descripcion, precio) values
(1, 'Standard', 500),
(2, 'Gourmet', 600),
(3, 'Spa', 800);

/* ====== NECESARIO INCLUIR EN LA BD PORQUE EL USUARIO 2 YA REALIZÓ SU TURNO MÉDICO ====== */
insert into turnoMedico (fkEmailCliente, fechaTurnoMedico, codigoLugar, nombreLugar) values
('dos@gmail.com', '2019.01.01 17:00:00', 1, 'Buenos Aires');
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

/* ========== */
/*
delimiter //
create event tareasDiarias2 on schedule every 1 minute
starts '2019-01-01 00:00:00'
do
begin
	select count(*) as cantidad
	from itemReserva as ir
		inner join relacionClienteItemReserva as rel on ir.idItemReserva = rel.fkIdItemReserva
	where (now() > ir.fechaInicioDeCheckin and ir.pago = false)
		or (now() > ir.fechaLimiteDeCheckin and ir.checkin = false)
		and (listaDeEspera = false);
	
    update centroMedico set turnos = cantidad where codigo = 1;
end //
delimiter ;
*/
/* DATOS CARGADOS "A LA FUERZA" PARA HACER PRUEBAS */
/* Los comento sólo para poder ejecutar todo de arriba a abajo */

/*
insert into relacionClienteItemReserva (fkIdItemReserva, fkEmailCliente) values
(1675, 'dos@gmail.com');
*/

/*
insert into centroMedico (codigo, turnos, codigoLugar, imagen) values
(4, 0, 1, 'img/centrosMedicos/buenosaires.jpg');

insert into turnoMedico (fkEmailCliente, fechaTurnoMedico, codigoLugar, nombreLugar) values
('uno@gmail.com', curtime(), 1, 'caca1');

insert into turnoMedico (fkEmailCliente, fechaTurnoMedico, codigoLugar, nombreLugar) values
('uno@gmail.com', date_add(curtime(), interval 60 day), 1, 'caca2');

insert into turnoMedico (fkEmailCliente, fechaTurnoMedico, codigoLugar, nombreLugar) values
('uno@gmail.com', date_add(curtime(), interval 10 minute), 1, 'caca3');
*/























