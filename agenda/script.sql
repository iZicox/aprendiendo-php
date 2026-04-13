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

INSERT INTO personas (nombre, apellidos, telefono, categoria_id) VALUES
('Luis', 'Martínez', '600123456', 'T'),
('Ana', 'Gómez', '611234567', 'P'),
('Carlos', 'Ruiz', '622345678', 'F'),
('María', 'López', '633456789', 'T'),
('Jorge', 'Santos', '644567890', 'P'),
('Elena', 'Hernández', '655678901', 'F'),
('Pablo', 'Navarro', '666789012', 'T'),
('Lucía', 'Castro', '677890123', 'P'),
('Sergio', 'Vega', '688901234', 'F'),
('Marta', 'Domínguez', '699012345', 'T');