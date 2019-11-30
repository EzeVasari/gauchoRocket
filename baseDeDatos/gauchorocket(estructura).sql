drop database if exists gauchorocket;
create database gauchorocket;
use gauchorocket;

create table usuario(
email varchar(64) primary key,
dni int,
rol boolean,
nombre varchar(50),
apellido varchar(50), 
fechaDeNacimiento date,
codigoHash varchar(32),
active boolean
);

create table login(
fkEmailUsuario varchar(64) primary key,
pass varchar(40),
foreign key (fkEmailUsuario) references usuario(email)
);

create table admin(
fkEmailUsuario varchar(64) primary key,
id int unique,
foreign key (fkEmailUsuario) references usuario(email)
);

create table cliente(
fkEmailUsuario varchar(64) primary key,
verifMedica boolean,
nivelVuelo int,
montoDecompras int,
foreign key (fkEmailUsuario) references usuario(email)
);

create table lugar(
codigo int primary key,
nombre varchar(50)
);

create table centroMedico(
codigo int primary key,
turnos int,
codigoLugar int,
imagen varchar(100),
foreign key (codigoLugar) references lugar(codigo)
);

create table turnoMedico(
codigo int primary key AUTO_INCREMENT,
fkEmailCliente varchar(64),
fechaTurnoMedico datetime,
codigoLugar int,
nombreLugar varchar(50),
foreign key (fkEmailCliente) references cliente(fkEmailUsuario),
foreign key (codigoLugar) references centroMedico(codigoLugar)
);

create table tipoDeViaje(
codigo int primary key,
descripcion varchar(20)
);

create table tipoDeEquipo(
codigo int primary key,
descripcion varchar(30)
);

create table equipo(
matricula varchar(15) primary key,
modelo varchar(50),
capacidadSuit int,
capacidadGeneral int,
capacidadFamiliar int,
fkcodigoTipoDeEquipo int,
foreign key (fkcodigoTipoDeEquipo) references tipoDeEquipo(codigo)
);

create table viaje(
codigo int primary key,
imagen varchar(100),
descripcion varchar(100),
precio int,
nombre varchar(50),
fecha datetime,
codigoLugarOrigen int,
codigoLugarDestino int,
codigoTipoDeViaje int,
matriculaEquipo varchar(15),
foreign key (codigoLugarOrigen) references lugar(codigo),
foreign key (codigoLugarDestino) references lugar(codigo),
foreign key (codigoTipoDeViaje) references tipoDeViaje(codigo),
foreign key (matriculaEquipo) references equipo(matricula)
);

create table reserva(
codigo varchar(6) primary key
);

create table trayecto(
idTrayecto int primary key,
nombreTrayecto varchar(50),
precio int,
duracion int,
fkCodigoLugarOrigen int,
fkCodigoLugarDestino int,
foreign key (fkCodigoLugarOrigen) references lugar(codigo),
foreign key (fkCodigoLugarDestino) references lugar(codigo)
);

create table tipoDeCabina(
codigoTipoDeCabina int primary key,
descripcion varchar(50),
precio int
);

create table cabina(
codigoCabina int primary key,
fkCodigoTipoDeCabina int,
foreign key (fkCodigoTipoDeCabina) references tipoDeCabina(codigoTipoDeCabina)
);

create table ubicacion(
idUbicacion int auto_increment primary key,
estado boolean,
fkIdTrayecto int,
fkCodigoViaje int,
fkCodigoCabina int,
fkCodigoReserva varchar (6),
foreign key (fkIdTrayecto) references trayecto(idTrayecto),
foreign key (fkCodigoViaje) references viaje(codigo),
foreign key (fkCodigoCabina) references cabina(codigoCabina),
foreign key (fkCodigoReserva) references reserva(codigo)
);

create table relacionReservaTrayecto(
fkCodigoReserva varchar(6),
fkIdTrayecto int,
primary key (fkCodigoReserva, fkIdTrayecto),
foreign key (fkCodigoReserva) references reserva(codigo),
foreign key (fkIdTrayecto) references trayecto(idTrayecto)
);

create table relacionViajeTrayecto(
fkIdTrayecto int,
fkCodigoViaje int,
primary key (fkIdTrayecto, fkCodigoViaje),
foreign key (fkIdTrayecto) references trayecto(idTrayecto),
foreign key (fkCodigoViaje) references viaje(codigo)
);

create table tipoDeServicio(
codigoTipoDeServicio int primary key,
precio double,
descripcion varchar(50)
);

create table servicio(
codigoServicio int primary key,
fkcodigoTipoDeServicio int,
foreign key (fkcodigoTipoDeServicio) references tipoDeServicio(codigoTipoDeServicio)
);

create table itemReserva(
idItemReserva int primary key,
fkCodigoReserva varchar(6),
fkCodigoServicio int,
fkCodigoCabina int,
checkin boolean,
pago boolean,
fechaLimiteDeCheckin datetime,
fechaInicioDeCheckin datetime,
fechaConfirmacion datetime,
fechaQuePidioReserva datetime,
listaDeEspera boolean,
foreign key (fkcodigoReserva) references reserva(codigo),
foreign key (fkCodigoServicio) references servicio(codigoServicio),
foreign key (fkCodigoCabina) references cabina(codigoCabina)
);

create table relacionClienteItemReserva(
fkIdItemReserva int,
fkEmailCliente varchar(64),
fecha datetime,
primary key (fkIdItemReserva, fkEmailCliente),
foreign key (fkIdItemReserva) references itemReserva (idItemReserva),
foreign key (fkEmailCliente) references cliente (fkEmailUsuario)
);

/*create table relacionItemReservaUbicacion(
fkIdUbicacion varchar(2),
fkidItemReserva varchar(6),
foreign key (fkIdUbicacion) references ubicacion(idUbicacion),
foreign key (fkidItemReserva) references itemReserva(idItemReserva),
primary key (fkIdUbicacion, fkidItemReserva)
);*/

create table relacionCabinaEquipo(
fkCodigoCabina int,
fkMatriculaEquipo varchar(15),
primary key (fkCodigoCabina, fkMatriculaEquipo),
foreign key (fkCodigoCabina) references cabina(codigoCabina),
foreign key (fkMatriculaEquipo) references equipo(matricula)
);
