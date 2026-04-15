create table categorias (
    categoria_id int auto_increment primary key,
    nombre varchar(20) not null,
    descripcion varchar(100) not null
);

-- persona: ID (PK), nombre, apellidos, teléfono, categoría ID.
create table personas (
    id int auto_increment primary key,
    nombre varchar(20) not null,
    apellidos varchar(20) not null,
    telefono varchar(20) not null,
    categoria_id int,
    constraint fk_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(categoria_id)
);

insert categorias values(default,'Familiar','Contactos familiares');
insert categorias values(default,'Trabajo','Contactos del trabajo');
insert categorias values(default,'Personal','Contactos como amigos u otros');

INSERT INTO personas (nombre, apellidos, telefono, categoria_id) VALUES
('Juan', 'Pérez López', '600123456', (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('María', 'García Ruiz', '600234567',       (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Carlos', 'Martínez Soto', '600345678',    (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Ana', 'Rodríguez Vega', '600456789',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Luis', 'Sánchez Díaz', '600567890',       (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Laura', 'Fernández Castro', '600678901',  (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Pedro', 'González Ruiz', '600789012',     (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Sofía', 'Torres Molina', '600890123',     (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Miguel', 'Ramírez Vega', '601012345',     (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Elena', 'Moreno Blanco', '601123456',     (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('David', 'Jiménez Cruz', '601234567',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Carmen', 'Navarro Ortiz', '601345678',    (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('José', 'Ríos Herrera', '601456789',       (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Isabel', 'Cortes Silva', '601567890',     (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Antonio', 'Medina Gallego', '601678901',  (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Paula', 'Domínguez Cano', '601789012',    (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Raúl', 'Vázquez Prado', '601890123',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Sara', 'Guerrero Luna', '602012345',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Diego', 'Molina Bravo', '602123456',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Lucía', 'Alonso Prado', '602234567',      (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Luis', 'Martínez', '600123456',           (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Ana', 'Gómez', '611234567',               (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Carlos', 'Ruiz', '622345678',             (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('María', 'López', '633456789',             (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Jorge', 'Santos', '644567890',            (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Elena', 'Hernández', '655678901',         (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Pablo', 'Navarro', '666789012',           (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Lucía', 'Castro', '677890123',            (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Sergio', 'Vega', '688901234',             (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1)),
('Marta', 'Domínguez', '699012345',         (SELECT categoria_id FROM categorias ORDER BY RAND() LIMIT 1));
