-- Crear tabla para el menú de desayuno
CREATE TABLE menu_desayuno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    subcategoria VARCHAR(50),
    opciones TEXT
);

-- Crear tabla para el menú de comida rápida
CREATE TABLE menu_comida_rapida (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    subcategoria VARCHAR(50)
);

-- Insertar datos de desayuno
-- PAILAS
INSERT INTO menu_desayuno (nombre, precio, categoria, subcategoria) VALUES
('Huevo', 2000, 'Pailas', 'Pailas'),
('Huevo tocino', 3000, 'Pailas', 'Pailas'),
('Huevo queso', 3000, 'Pailas', 'Pailas'),
('Huevo jamón', 3000, 'Pailas', 'Pailas');

-- EMPANADAS
INSERT INTO menu_desayuno (nombre, precio, categoria, subcategoria) VALUES
('Queso', 2300, 'Empanadas', 'Empanadas'),
('Camarón queso', 2800, 'Empanadas', 'Empanadas'),
('Pulpo queso', 2800, 'Empanadas', 'Empanadas'),
('Mechada queso', 2800, 'Empanadas', 'Empanadas'),
('Napolitana', 2500, 'Empanadas', 'Empanadas');

-- JUGOS
INSERT INTO menu_desayuno (nombre, precio, categoria, subcategoria, opciones) VALUES
('Maracuyá', 3000, 'Jugos', 'Jugos', 'Agua'),
('Maracuyá', 3500, 'Jugos', 'Jugos', 'Leche'),
('Mango', 3000, 'Jugos', 'Jugos', 'Agua'),
('Mango', 3500, 'Jugos', 'Jugos', 'Leche'),
('Frutilla', 3000, 'Jugos', 'Jugos', 'Agua'),
('Frutilla', 3500, 'Jugos', 'Jugos', 'Leche'),
('Guayaba', 3000, 'Jugos', 'Jugos', 'Agua'),
('Guayaba', 3500, 'Jugos', 'Jugos', 'Leche'),
('Piña', 3000, 'Jugos', 'Jugos', 'Agua'),
('Plátano', 3500, 'Jugos', 'Jugos', 'Leche'),
('Melón tuna', 3000, 'Jugos', 'Jugos', 'Agua'),
('Melón calameño', 3000, 'Jugos', 'Jugos', 'Agua');

-- SANDWICH
INSERT INTO menu_desayuno (nombre, precio, categoria, subcategoria) VALUES
('Completo', 2000, 'Sandwich', 'Sandwich'),
('Ave Mayo', 3800, 'Sandwich', 'Sandwich'),
('Churrasco', 4000, 'Sandwich', 'Sandwich'),
('Aliado', 3200, 'Sandwich', 'Sandwich'),
('Queso caliente', 3000, 'Sandwich', 'Sandwich'),
('Barros luco', 4000, 'Sandwich', 'Sandwich'),
('Barros jarpa', 3500, 'Sandwich', 'Sandwich'),
('Diputado', 4000, 'Sandwich', 'Sandwich'),
('Ave luco', 4000, 'Sandwich', 'Sandwich'),
('Ave palta', 4000, 'Sandwich', 'Sandwich'),
('Chacarero', 4800, 'Sandwich', 'Sandwich');

-- BEBESTIBLES
INSERT INTO menu_desayuno (nombre, precio, categoria, subcategoria) VALUES
('Lata', 1600, 'Bebestibles', 'Bebestibles'),
('Café', 1200, 'Bebestibles', 'Bebestibles'),
('Té de hoja', 1000, 'Bebestibles', 'Bebestibles'),
('Chocolate caliente', 2500, 'Bebestibles', 'Bebestibles'),
('Café de máquina', 2000, 'Bebestibles', 'Bebestibles');

-- Insertar datos de comida rápida
-- PAPAS
INSERT INTO menu_comida_rapida (nombre, precio, categoria, subcategoria) VALUES
('Salchipapas', 4000, 'Papas', 'Papas'),
('Papas fritas', 3500, 'Papas', 'Papas'),
('Papas bravas', 4000, 'Papas', 'Papas'),
('Papas rústicas', 4000, 'Papas', 'Papas');

-- TABLAS
INSERT INTO menu_comida_rapida (nombre, precio, categoria, subcategoria) VALUES
('Pichanga 2 personas', 11000, 'Tablas', 'Tablas'),
('Pichanga 4 personas', 16000, 'Tablas', 'Tablas'),
('Pichanga 6 personas', 23000, 'Tablas', 'Tablas'),
('Chorrillana 2 pers.', 12000, 'Tablas', 'Tablas'),
('Chorrillana 4 pers.', 18000, 'Tablas', 'Tablas'),
('Chorrillana 6 pers.', 25000, 'Tablas', 'Tablas');

-- TABLA MIXTA
INSERT INTO menu_comida_rapida (nombre, precio, categoria, subcategoria) VALUES
('Mixta 2 pers.', 13000, 'Tabla Mixta', 'Tabla Mixta'),
('Mixta 4 pers.', 18000, 'Tabla Mixta', 'Tabla Mixta'),
('Mixta 6 pers.', 25000, 'Tabla Mixta', 'Tabla Mixta');

-- CHAMPI POLLO
INSERT INTO menu_comida_rapida (nombre, precio, categoria, subcategoria) VALUES
('Champi Pollo 2 pers.', 11000, 'Champi Pollo', 'Champi Pollo'),
('Champi Pollo 4 pers.', 16000, 'Champi Pollo', 'Champi Pollo'),
('Champi Pollo 6 pers.', 22000, 'Champi Pollo', 'Champi Pollo');

-- CHAMPI CARNE
INSERT INTO menu_comida_rapida (nombre, precio, categoria, subcategoria) VALUES
('Champi Carne 2 pers.', 12000, 'Champi Carne', 'Champi Carne'),
('Champi Carne 4 pers.', 17000, 'Champi Carne', 'Champi Carne'),
('Champi Carne 6 pers.', 23000, 'Champi Carne', 'Champi Carne');

-- SANDWICHS
INSERT INTO menu_comida_rapida (nombre, precio, categoria, subcategoria) VALUES
('Churrasco', 5000, 'Sandwichs', 'Sandwichs'),
('A lo pobre', 6000, 'Sandwichs', 'Sandwichs'),
('Barros luco', 4800, 'Sandwichs', 'Sandwichs'),
('Chacarero', 5500, 'Sandwichs', 'Sandwichs'),
('Rucaso', 6000, 'Sandwichs', 'Sandwichs'),
('Diputado', 4800, 'Sandwichs', 'Sandwichs'),
('Brasileño', 5000, 'Sandwichs', 'Sandwichs'),
('Lucaso queso huevo', 6500, 'Sandwichs', 'Sandwichs'),
('Lucaso huevo', 6000, 'Sandwichs', 'Sandwichs'),
('Lucaso queso', 6000, 'Sandwichs', 'Sandwichs'),
('La ruca de los monos', 7000, 'Sandwichs', 'Sandwichs'),
('Ave completa', 5000, 'Sandwichs', 'Sandwichs'),
('Ave luco', 5500, 'Sandwichs', 'Sandwichs'),
('Americano', 6000, 'Sandwichs', 'Sandwichs'),
('Mechada completa', 6000, 'Sandwichs', 'Sandwichs'),
('Mechada luco', 6000, 'Sandwichs', 'Sandwichs'),
('Hamburguesa casera', 5500, 'Sandwichs', 'Sandwichs'),
('Hamburguesa criolla', 7500, 'Sandwichs', 'Sandwichs'),
('Hamburguesa luco', 6000, 'Sandwichs', 'Sandwichs'),
('Gordita', 5000, 'Sandwichs', 'Sandwichs'),
('Tortuga', 4800, 'Sandwichs', 'Sandwichs'),
('Rucana', 6000, 'Sandwichs', 'Sandwichs'),
('Sandwich de pescado', 7000, 'Sandwichs', 'Sandwichs'),
('Vegetariano', 4800, 'Sandwichs', 'Sandwichs'),
('Hamburguesa vegana', 6000, 'Sandwichs', 'Sandwichs'); 