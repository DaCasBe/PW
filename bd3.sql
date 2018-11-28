create table actor(
  id int(3) primary key,
  n_tbb varchar(50) not null,
  nombre varchar(50) not null,
  edad int(2) not null,
  nacionalidad varchar(50) not null,
  sexo varchar(10) not null,
  Otras_series varchar(256) not null,
  imagen varchar(50) not null,
  stcivil varchar(10) not null,
  coche tinyint(1) not null,
  bici tinyint(1) not null,
  moto tinyint(1) not null,
  picaporte tinyint(1) not null
);

create table user(
  nick varchar(50) primary key,
  password varchar(50) not null,
  nombre varchar(50) not null,
  apellidos varchar(50),
  sexo varchar(50) not null,
  email varchar(50) not null,
  telefono int(9),
  beber tinyint(1),
  tiza tinyint(1),
  otras tinyint(1),
  imagen varchar(50) not null,
  admin tinyint(1) not null
);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (1, 'Dr. Leonard Hofstadter', 'Johnny Galecki', 43, 'Estadounidense', 'Varon', 'Batman Beyon - My name is Earl -  Roseanne - The Conners', 'Johnny_Galecki.jpg', 'Soltero/a', 1, 0, 0, 0);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (2, 'Penny', 'Kaley Cuoco', 32, 'Estadounidense', 'Mujer', 'Prison Break - The Help - Charmed', 'Kaley_Cuoco.jpg', 'Casado/a', 1, 0, 0, 0);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (3, 'Howard Wolowitz', 'Simon Helberg', 37, 'Estadounidense', 'Varon', 'Joey - Unscripteed - El gafe', 'Simon_Helberg.jpg', 'Soltero/a', 1, 0, 1, 0);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (4, 'Dr. Rajesh \"Raj\" Koothrappali', 'Kunal Nayyar', 37, 'Britanico', 'Varon', 'Fantasy Hospital - Sanjay y Craig - The Mindy Project', 'Kunal_Nayyar.jpg', 'Casado/a', 1, 0, 0, 0);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (5, 'Dra. Amy Farrah Fowler', 'Mayim Bialik', 42, 'Estadounidense', 'Mujer', 'Johnny Bravo - Recess - Katbot', 'Mayim_Bialik.jpg', 'Casado/a', 1, 0, 0, 0);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (6, 'Dra. Bernadette Rostenkowski', 'Melissa Rauch', 38, 'Estadounidense', 'Mujer', 'Kath & Kim - True Blood - Best Week Ever', 'Melissa_Rauch.jpg', 'Casado/a', 1, 0, 0, 0);

insert into actor (id, n_tbb, nombre, edad, nacionalidad, sexo, Otras_series, imagen, stcivil, coche, bici, moto, picaporte) 
values (7, 'Jim Parsons', 'Dr. Sheldon Cooper', 45, 'Estadounidense', 'Varon', 'SuperMansion - Eureka - iCarly', 'Jim_Parsons.jpg', 'Casado/a', 0, 0, 1, 0);

insert into user (nick,password,nombre,apellidos,sexo,email,telefono,beber,tiza,otras,imagen,admin)
values ('Kasol','admin','Daniel','Castillo Bello','Hombre','realmentenohaymas@gmail.com',888888888,0,1,0,'picaporte.jpg',1);

insert into user (nick,password,nombre,apellidos,sexo,email,telefono,beber,tiza,otras,imagen,admin)
values ('NNCREEPY','admin','Diego','Canela','Hombre','realmentesihaymas@gmail.com',888888888,1,1,1,'',1);