drop database if exists gauchorocket;
create database gauchorocket;
use gauchorocket;

create table usuario(
nick varchar(64) primary key,
dni int,
rol boolean,
nombre varchar(50),
apellido varchar(50),
fechaDeNacimiento date
);

create table login(
email varchar(64) primary key,
pass varchar(40),
codigoUsuario varchar(64),
foreign key (codigoUsuario) references usuario(nick)
);

create table admin(
codigoUsuario varchar(64) primary key,
id int unique,
foreign key (codigoUsuario) references usuario(nick)
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

create table cliente(
codigoUsuario varchar(64) primary key,
verifMedica boolean,
nivelVuelo int,
codigoCentroMedico int,
foreign key (codigoUsuario) references usuario(nick),
foreign key (codigoCentroMedico) references centroMedico(codigo)
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
matricula int primary key,
modelo varchar(50),
capacidad int,
codigoTipoDeEquipo int,
foreign key (codigoTipoDeEquipo) references tipoDeEquipo(codigo)
);

create table viaje(
codigo int primary key,
imagen varchar(100),
descripcion varchar(100),
precio double,
nombre varchar(50),
fecha datetime,
duracion int,
codigoLugarOrigen int,
codigoLugarDestino int,
codigoTipoDeViaje int,
codigoEquipo int,
foreign key (codigoLugarOrigen) references lugar(codigo),
foreign key (codigoLugarDestino) references lugar(codigo),
foreign key (codigoTipoDeViaje) references tipoDeViaje(codigo),
foreign key (codigoEquipo) references equipo(matricula)
);

create table reserva(
codigo int primary key AUTO_INCREMENT,
codigoViaje int,
foreign key (codigoViaje) references viaje(codigo)
);

create table relacionClienteReserva(
codigoReserva int,
codigoCliente varchar(64),
checkin boolean,
pago boolean,
fechaLimite datetime,
fechaConfirmacion datetime,
primary key (codigoReserva, codigoCliente),
foreign key (codigoReserva) references reserva(codigo),
foreign key (codigoCliente) references cliente(codigoUsuario)
);

create table tipoDeServicio(
codigo int primary key,
descripcion varchar(50)
);

create table servicio(
codigo int primary key,
precio double,
codigoTipoDeServicio int,
foreign key (codigoTipoDeServicio) references tipoDeServicio(codigo)
);

create table relacionViajeServicio(
codigoServicio int,
codigoViaje int,
primary key(codigoServicio, codigoViaje),
foreign key (codigoServicio) references servicio(codigo),
foreign key (codigoViaje) references viaje(codigo)
);

create table tipoDeCabina(
codigo int primary key,
descripcion varchar(50)
);

create table cabina(
codigo int primary key,
asientos int,
ubicacion varchar(10),
codigoTipoDeCabina int,
foreign key (codigoTipoDeCabina) references tipoDeCabina(codigo)
);

create table relacionCabinaEquipo(
codigoCabina int,
codigoEquipo int,
primary key (codigoCabina, codigoEquipo),
foreign key (codigoCabina) references cabina(codigo),
foreign key (codigoEquipo) references equipo(matricula)
);

create table turnoMedico(
codigo int primary key AUTO_INCREMENT,
codigoCliente varchar(64),
codigoLugar int,
nombreLugar varchar(50),
foreign key (codigoCliente) references cliente(codigoUsuario),
foreign key (codigoLugar) references lugar(codigo)
);
