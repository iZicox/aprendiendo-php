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
('Juan', 'Pérez López', '600123456', 'T'),
('María', 'García Ruiz', '600234567', 'P'),
('Carlos', 'Martínez Soto', '600345678', 'F'),
('Ana', 'Rodríguez Vega', '600456789', 'T'),
('Luis', 'Sánchez Díaz', '600567890', 'P'),
('Laura', 'Fernández Castro', '600678901', 'F'),
('Pedro', 'González Ruiz', '600789012', 'T'),
('Sofía', 'Torres Molina', '600890123', 'P'),
('Miguel', 'Ramírez Vega', '601012345', 'F'),
('Elena', 'Moreno Blanco', '601123456', 'T'),
('David', 'Jiménez Cruz', '601234567', 'P'),
('Carmen', 'Navarro Ortiz', '601345678', 'F'),
('José', 'Ríos Herrera', '601456789', 'T'),
('Isabel', 'Cortes Silva', '601567890', 'P'),
('Antonio', 'Medina Gallego', '601678901', 'F'),
('Paula', 'Domínguez Cano', '601789012', 'T'),
('Raúl', 'Vázquez Prado', '601890123', 'P'),
('Sara', 'Guerrero Luna', '602012345', 'F'),
('Diego', 'Molina Bravo', '602123456', 'T'),
('Lucía', 'Alonso Prado', '602234567', 'P');