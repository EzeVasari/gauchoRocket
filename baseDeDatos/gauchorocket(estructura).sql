drop database if exists gauchorocket;
create database gauchorocket;
use gauchorocket;

create table usuario(
email varchar(64) primary key,
dni int,
rol boolean,
nombre varchar(50),
apellido varchar(50), 
fechaDeNacimiento date
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
fkEmailUsuario varchar(64) primary key,
verifMedica boolean,
nivelVuelo int,
codigoCentroMedico int,
foreign key (fkEmailUsuario) references usuario(email),
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
codigo varchar(6) primary key,
codigoViaje int,
foreign key (codigoViaje) references viaje(codigo)
);

create table tipoDeServicio(
codigoTipoDeServicio int primary key,
descripcion varchar(50)
);

create table servicio(
codigoServicio int primary key,
precio double,   
fkcodigoTipoDeServicio int,
foreign key (fkcodigoTipoDeServicio) references tipoDeServicio(codigoTipoDeServicio)
);

create table tipoDeCabina(
codigoTipoDeCabina int primary key,
descripcion varchar(50)
);

create table cabina(
codigoCabina int primary key,
asientos int,
ubicacion varchar(10),
fkCodigoTipoDeCabina int,
foreign key (fkCodigoTipoDeCabina) references tipoDeCabina(codigoTipoDeCabina)
);

create table itemReserva(
fkCodigoReserva varchar(6),
fkEmailCliente varchar(64),
fkCodigoServicio int,
fkCodigoCabina int,
checkin boolean,
pago boolean,
fechaLimite datetime,
fechaConfirmacion datetime,
primary key (fkCodigoReserva, fkEmailCliente),
foreign key (fkcodigoReserva) references reserva(codigo),
foreign key (fkEmailCliente) references cliente(fkEmailUsuario),
foreign key (fkCodigoServicio) references servicio(codigoServicio),
foreign key (fkCodigoCabina) references cabina(codigoCabina)
);

create table relacionCabinaEquipo(
fkCodigoCabina int,
fkCodigoEquipo int,
primary key (fkCodigoCabina, fkCodigoEquipo),
foreign key (fkCodigoCabina) references cabina(codigoCabina),
foreign key (fkCodigoEquipo) references equipo(matricula)
);

create table turnoMedico(
codigo int primary key AUTO_INCREMENT,
fkEmailCliente varchar(64),
codigoLugar int,
nombreLugar varchar(50),
foreign key (fkEmailCliente) references cliente(fkEmailUsuario),
foreign key (codigoLugar) references lugar(codigo)
);
