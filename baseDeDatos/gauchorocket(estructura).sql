drop database if exists gauchorocket;
create database gauchorocket;
use gauchorocket;

create table usuario(
nick varchar(64) primary key,
dni int,
rol boolean,
nombre varchar(50),
apellido varchar(50),
fnac date
);

create table login(
email varchar(64) primary key,
pass varchar(40),
fknick varchar(64),
foreign key (fknick) references usuario(nick)
);

create table admin(
usuario varchar(64) primary key,
id int unique,
foreign key (usuario) references usuario(nick)
);

create table lugar(
codigo int primary key,
nombre varchar(50)
);

create table centroMedico(
codigo int primary key,
turnos int,
lugar int,
img varchar(100),
foreign key (lugar) references lugar(codigo)
);

create table cliente(
usuario varchar(64) primary key,
verifMedica boolean,
nivelVuelo int,
lugarMedico int,
foreign key (usuario) references usuario(nick),
foreign key (lugarMedico) references centroMedico(codigo)
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
tipoDeEquipo int,
foreign key (tipoDeEquipo) references tipoDeEquipo(codigo)
);

create table viaje(
codigo int primary key,
img varchar(100),
descripcion varchar(100),
precio double,
nombre varchar(50),
fecha datetime,
duracion int,
origen int,
destino int,
tipoDeViaje int,
codigoEquipo int,
foreign key (origen) references lugar(codigo),
foreign key (destino) references lugar(codigo),
foreign key (tipoDeViaje) references tipoDeViaje(codigo),
foreign key (codigoEquipo) references equipo(matricula)
);

create table relacionViajeCliente(
codigo int AUTO_INCREMENT,
codigoviaje int,
nombreusuario varchar(64),
checkin boolean,
pago boolean,
fechaLimite datetime,
fechaConfirmacion datetime,
primary key (codigo, codigoviaje, nombreusuario),
foreign key (codigoviaje) references viaje(codigo),
foreign key (nombreusuario) references cliente(usuario)
);

create table tipoDeServicio(
codigo int primary key,
descripcion varchar(50)
);

create table servicio(
codigo int primary key,
precio double,
tipoDeServicio int,
foreign key (tipoDeServicio) references tipoDeServicio(codigo)
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
tipoDeCabina int,
foreign key (tipoDeCabina) references tipoDeCabina(codigo)
);

create table relacionCabinaEquipo(
codigoCabina int,
matriculaEquipo int,
primary key (codigoCabina, matriculaEquipo),
foreign key (codigoCabina) references cabina(codigo),
foreign key (matriculaEquipo) references equipo(matricula)
);

create table turnoMedico(
codigo int primary key AUTO_INCREMENT,
cliente varchar(64),
codigolugar int,
nombrelugar varchar(50),
foreign key (cliente) references cliente(usuario),
foreign key (codigolugar) references lugar(codigo)
);

















