create table categorias (
    categoria_id VARchar(5) primary key,
    categorianombre varchar(20)
);

-- persona: ID (PK), nombre, apellidos, teléfono, categoría ID.
create table personas (
    id int auto_increment primary key,
    nombre varchar(20) not null,
    apellidos varchar(20) not null,
    telefono varchar(20) not null,
    categoria_id VARCHAR(5),
    constraint fk_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
);

insert categorias values('F','Familiar');
insert categorias values('T','Trabajo');
insert categorias values('P','Personal');