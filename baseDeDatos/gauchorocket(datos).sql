use gauchorocket;

insert into lugar (codigo, nombre) values
(1, 'Buenos Aires'),
(2, 'Ankara'),
(3, 'Luna'),
(4, 'Marte'),
(5, 'Europa'),
(6, 'Io'),
(7, 'Encelado'),
(8, 'Titan'),
(9, 'Orbiter Hotel'),
(10, 'EEI'),
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

insert into equipo (matricula, modelo, capacidad, codigoTipoDeEquipo) values
(1111, 'Calandria', 100, 4),
(2222, 'Colibri', 200, 4),
(3333, 'Modelo Uno', 300, 1),
(4444, 'Guanaco', 400, 2);

insert into viaje (codigo, imagen, descripcion, precio, nombre, fecha, duracion, codigoLugarOrigen, codigoLugarDestino, codigoTipoDeViaje, codigoEquipo) values
(1, 'img/Luna.jpg', '', 4000, 'Ankara - Luna', '2019.10.21 12:00:00', 8, 2, 3, 2, 1111),
(2, 'img/Luna2.jpg', '', 4000, 'Bs. As. - Luna', '2019.10.22 12:00:00', 8, 1, 3, 2, 2222),
(3, 'img/Marte.jpg', 'Vuelo desde Buenos Aires a Marte en 8hs.', 7000, 'Bs. As. - Marte', '2019.10.22 12:00:00', 8, 1, 4, 2, 2222),
(4, 'img/titan.jpg', 'Vuelo completo desde Buenos Aires hacia Titan en 77 hs.', 10000, 'Bs. As. - Titan', '2019.10.23 12:00:00', 72, 1, 8, 1, 4444),
(5, 'img/marte2.jpg', 'Vuelo desde Ankara hasta Marte en 8hs.', 6300, 'Ankara - Marte', '2019.10.25 12:00:00', 8, 2, 4, 2, 2222),
(6, 'img/titan2.jpg', 'Vuelo desde Ankara hasta Titan en 72hs.', 11000, 'Ankara - Titan', '2019.10.27 12:00:00', 72, 2, 8, 1, 4444);

insert into usuario (nick, dni, rol, nombre, apellido, fechaDeNacimiento, email) values
('Uno', 1234, false, 'Susana','Oria', '2000.01.01', 'uno@gmail.com'),
('Dos', 2345, false, 'Cesar','Noso', '2000.01.01', 'dos@gmail.com'),
('Admin', 1, true, 'Ala','Cran', '1992.08.10', 'admin@gmail.com');

insert into login (pass, fkNickUsuario) values
(md5('asd'), 'Uno'),
(md5('asd'), 'Dos'),
(md5('asd'), 'Admin');

insert into centroMedico (codigo, turnos, codigoLugar, imagen) values
(1, 200, 1, 'img/centrosMedicos/buenosaires.jpg'),
(2, 200, 2, 'img/centrosMedicos/ankara.jpg'),
(3, 200, 13, 'img/centrosMedicos/shanghai.jpg');

insert into cliente (codigoUsuario, verifMedica, nivelVuelo, codigoCentroMedico) values
('Uno', false, 1, 1),
('Dos', true, 1, 1);

insert into admin (codigoUsuario, id) values
('Admin', 1);














