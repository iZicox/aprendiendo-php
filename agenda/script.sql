create table categorias (
    categoria_id int auto_increment primary key,
    nombre varchar(20) not null,
    descripcion varchar(100) not null
);

create table personas (
    id int auto_increment primary key,
    nombre varchar(20) not null,
    apellidos varchar(20) not null,
    telefono varchar(20) not null,
    categoria_id int,
    constraint fk_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
);


-- datos de prueba 

insert categorias values(default,'Familiar','Contactos familiares');
insert categorias values(default,'Trabajo','Contactos del trabajo');
insert categorias values(default,'Personal','Contactos como amigos u otros');

INSERT INTO personas (nombre, apellidos, telefono, categoria_id) VALUES
('Juan', 'Pérez López', '600123456',        (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('María', 'García Ruiz', '600234567',       (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Carlos', 'Martínez Soto', '600345678',    (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Ana', 'Rodríguez Vega', '600456789',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Luis', 'Sánchez Díaz', '600567890',       (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1));

