create table usuarios (
    id_usuario int PRIMARY KEY auto_increment,
    nombre varchar(20) not null,
    contrasenna varchar(50) not null,
    cookie varchar(200)
);

create table tareas (
    id_tarea int PRIMARY KEY auto_increment,
    descripcion varchar(200) not null,
    completada boolean default 0,
    id_usuario int,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);