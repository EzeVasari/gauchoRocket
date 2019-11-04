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
(1, 'img/Luna.jpg', 'Vuelo desde Ankara hasta la Luna en 8hs.', 4000, 'Ankara - Luna', '2019.10.21 12:00:00', 8, 2, 3, 2, 1111),
(2, 'img/Luna2.jpg', 'Vuelo desde Buenos Aires a Luna en 8hs.', 4000, 'Bs. As. - Luna', '2019.10.22 12:00:00', 8, 1, 3, 2, 2222),
(3, 'img/Marte.jpg', 'Vuelo desde Buenos Aires a Marte en 8hs.', 7000, 'Bs. As. - Marte', '2019.10.22 12:00:00', 8, 1, 4, 2, 2222),
(4, 'img/titan.jpg', 'Vuelo completo desde Buenos Aires hacia Titan en 77 hs.', 10000, 'Bs. As. - Titan', '2019.10.23 12:00:00', 72, 1, 8, 1, 4444),
(5, 'img/marte2.jpg', 'Vuelo desde Ankara hasta Marte en 8hs.', 6300, 'Ankara - Marte', '2019.10.25 12:00:00', 8, 2, 4, 2, 2222),
(6, 'img/titan2.jpg', 'Vuelo desde Ankara hasta Titan en 72hs.', 11000, 'Ankara - Titan', '2019.10.27 12:00:00', 72, 2, 8, 1, 4444);


insert into usuario (dni, rol, nombre, apellido, fechaDeNacimiento, email) values
(1234, false, 'Susana','Oria', '2000.01.01', 'uno@gmail.com'),
(2345, false, 'Cesar','Noso', '2000.01.01', 'dos@gmail.com'),
(1, true, 'Ala','Cran', '1992.08.10', 'admin@gmail.com');

insert into login (pass, fkEmailUsuario) values
(md5('asd'), 'uno@gmail.com'),
(md5('asd'), 'dos@gmail.com'),
(md5('asd'), 'admin@gmail.com');


insert into centroMedico (codigo, turnos, codigoLugar, imagen) values
(1, 200, 1, 'img/centrosMedicos/buenosaires.jpg'),
(2, 200, 2, 'img/centrosMedicos/ankara.jpg'),
(3, 200, 13, 'img/centrosMedicos/shanghai.jpg');

insert into cliente (fkEmailUsuario, verifMedica, nivelVuelo, codigoCentroMedico) values
('uno@gmail.com', false, 1, 1),
('dos@gmail.com', true, 1, 1);

insert into admin (fkEmailUsuario, id) values
('admin@gmail.com', 1);

insert into tipoDeServicio (codigoTipoDeServicio, descripcion) values
(1, 'Standard'),
(2, 'Gourmet'),
(3, 'Spa');

insert into servicio (codigoServicio, precio, fkcodigoTipoDeServicio) values 
(1, 500, 1),
(2, 600, 2),
(3, 800, 3);
















