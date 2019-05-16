-- The database structure:
CREATE TABLE aspects (
	aspect_id SERIAL PRIMARY KEY,
	aspect_name varchar NOT NULL,
	compound BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE items (
	item_id SERIAL PRIMARY KEY,
	item_name varchar NOT NULL
);

CREATE TABLE emc (
	emc_Id SERIAL PRIMARY KEY,
	item int NOT NULL references items(item_id),
	amount int NOT NULL
);

CREATE TABLE aspect_parents (
	asp_par_key SERIAL PRIMARY KEY,
	aspect int NOT NULL references aspects(aspect_id),
	father int NOT NULL references aspects(aspect_id),
	mother int NOT NULL references aspects(aspect_id)
);

CREATE TABLE thaumcraft (
	thaum_key SERIAL PRIMARY KEY,
	item int NOT NULL references items(item_id),
	aspect int NOT NULL references aspects(aspect_id),
	amount int NOT NULL
);

CREATE TABLE singularities (
	singularity_id SERIAL PRIMARY KEY,
	singularity_name varchar NOT NULL,
	compound BOOLEAN NOT NULL DEFAULT FALSE,
	item_cost int NOT NULL,
	item int NOT NULL references items(item_id)
);

CREATE TABLE singularity_parents (
	sing_par_key SERIAL PRIMARY KEY,
	singularity int NOT NULL references singularities(singularity_id),
	parent1 int NOT NULL references singularities(singularity_id),
	parent2 int NOT NULL references singularities(singularity_id),
	parent3 int NOT NULL references singularities(singularity_id),
	parent4 int NOT NULL references singularities(singularity_id),
	parent5 int NOT NULL references singularities(singularity_id),
	parent6 int NOT NULL references singularities(singularity_id),
	parent7 int NOT NULL references singularities(singularity_id),
	parent8 int NOT NULL references singularities(singularity_id),
	parent9 int NOT NULL references singularities(singularity_id)
);

CREATE TABLE materials (
	material_id SERIAL PRIMARY KEY,
	material_name varchar NOT NULL
);

CREATE TABLE attributes (
	attribute_id SERIAL PRIMARY KEY,
	attribute_name varchar NOT NULL,
	attribute_desc text NOT NULL
);

CREATE TABLE material_attributes (
	mat_att_id SERIAL PRIMARY KEY,
	level int NOT NULL,
	material int NOT NULL references materials(material_id),
	attribute int NOT NULL references attributes(attribute_id)
);

CREATE TABLE part_types (
	part_id SERIAL PRIMARY KEY,
	part_name varchar NOT NULL
);

CREATE TABLE stat_types (
	stat_id SERIAL PRIMARY KEY,
	stat_name varchar NOT NULL
);

CREATE TABLE tinkers (
	tinkers_id SERIAL PRIMARY KEY,
	level int NOT NULL,
	material int NOT NULL references materials(material_id),
	stat int NOT NULL references stat_types(stat_id),
	part int NOT NULL references part_types(part_id)
);


-- The database insertions:
-- INSERTED
INSERT INTO aspect_parents (aspect, father, mother) VALUES 
(7, 3, 5),
(8, 1, 3),
(9, 1, 4),
(10, 4, 5),
(11, 3, 4),
(12, 1, 2),
(13, 1, 5),
(14, 2, 5),
(15, 2, 6),
(16, 4, 6),
(17, 9, 15),
(18, 13, 15),
(19, 6, 15),
(20, 9, 6),
(21, 2, 15),
(22, 6, 16),
(23, 5, 15),
(24, 11, 13),
(25, 4, 15),
(26, 8, 13),
(27, 9, 5),
(28, 1, 9),
(29, 26, 13),
(30, 1, 19),
(31, 1, 24),
(32, 17, 23),
(33, 23, 9),
(34, 23, 15),
(35, 5, 24),
(36, 18, 13),
(37, 3, 24),
(38, 13, 28),
(39, 3, 34),
(40, 1, 34),
(41, 34, 27),
(42, 32, 18),
(43, 17, 39),
(44, 18, 40),
(45, 43, 4),
(46, 18, 43),
(47, 19, 43),
(48, 43, 6),
(49, 43, 45),
(50, 45, 9),
(51, 45, 47),
(52, 17, 45),
(53, 45, 3),
(54, 45, 6),
(55, 3, 53);

-- INSERTED
INSERT INTO aspects (aspect_name, compound) VALUES 
('Aer', FALSE),
('Aqua', FALSE),
('Ignis', FALSE),
('Ordo', FALSE),
('Perditio', FALSE),
('Terra', FALSE),
('Gelum', TRUE),
('Lux', TRUE),
('Motus', TRUE),
('Permutatio', TRUE),
('Potentia', TRUE),
('Tempestas', TRUE),
('Vacuos', TRUE),
('Venenum', TRUE),
('Victus', TRUE),
('Vitreus', TRUE),
('Bestia', TRUE),
('Fames', TRUE),
('Herba', TRUE),
('Iter', TRUE),
('Limus', TRUE),
('Metallum', TRUE),
('Mortuus', TRUE),
('Praecantatio', TRUE),
('Sano', TRUE),
('Tenebrae', TRUE),
('Vinculum', TRUE),
('Volatus', TRUE),
('Alienis', TRUE),
('Arbor', TRUE),
('Auram', TRUE),
('Corpus', TRUE),
('Examinis', TRUE),
('Spiritus', TRUE),
('Vitium', TRUE),
('Gula', TRUE),
('Infernus', TRUE),
('Superbia', TRUE),
('Cognitio', TRUE),
('Sensus', TRUE),
('Desidia', TRUE),
('Luxuria', TRUE),
('Humanus', TRUE),
('Invidia', TRUE),
('Instrumentum', TRUE),
('Lucrum', TRUE),
('Messis', TRUE),
('Perfodio', TRUE),
('Fabrico', TRUE),
('Machina', TRUE),
('Meto', TRUE),
('Pannus', TRUE),
('Telum', TRUE),
('Tutamen', TRUE),
('Ira', TRUE);

-- INSERTED
INSERT INTO stat_types (stat_name) VALUES 
('Attack'),
('Durability'),
('Durability Modifier'),
('Mining Speed'),
('Mining Level'),
('Usage Speed'),
('Break Chance'),
('Accuracy'),
('Draw Speed'),
('Arrow Speed'),
('Weight');

-- INSERTED
INSERT INTO materials (material_name) VALUES 
('Oureclase'),
('Prometheum'),
('Mystic Silver'),
('Tartarite'),
('Desichalkos'),
('Eximite'),
('Certus Quartz'),
('Ender Amethyst'),
('Manasteel'),
('Terrasteel'),
('Elementium'),
('Amethyst'),
('Peridot'),
('Ruby'),
('Sapphire'),
('Dark Steel'),
('Void Metal'),
('Draconium'),
('Awakened Draconium'),
('Glue'),
('Tear Jerker'),
('Enderium'),
('Signalum'),
('Lumium'),
('Constantan'),
('Angmallen'),
('Damascus Steel'),
('Hepatizon'),
('Brass'),
('Electrum'),
('Platinum'),
('Silver'),
('Amordrine'),
('Ceruclase'),
('Ignatius'),
('Inolashite'),
('Kalendrite'),
('Midasium'),
('Sanguinite'),
('Shadow Iron'),
('Shadow Steel'),
('Vulcanite'),
('Vyroxeres'),
('Adamantine'),
('Astral Silver'),
('Atlarus'),
('Black Steel'),
('Carmot'),
('Celenegil'),
('Deep Iron'),
('Haderoth'),
('Mithril'),
('Orichalcum'),
('Wooden'),
('Stone'),
('Iron'),
('Flint'),
('Bone'),
('Obsidian'),
('Netherrack'),
('Green Slime'),
('Cobalt'),
('Ardite'),
('Manyullyn'),
('Copper'),
('Bronze'),
('Alumite'),
('Steel'),
('Blue Slime'),
('Lead'),
('Ferrous'),
('Invar'),
('Magical Wooden'),
('Plastic'),
('Pink Slime'),
('Neutronium'),
('Infinity'),
('Thaumium');

-- INSERTED
INSERT INTO part_types (part_name) VALUES 
('Tool Rod'),
('Tool Binding'),
('Tough Rod'),
('Tough Binding'),
('Pickaxe Head'),
('Shovel Head'),
('Axe Head'),
('Scythe Head'),
('Hammer Head'),
('Excavator Head'),
('Broadaxe Head'),
('Large Plate'),
('Pan'),
('Wide Board'),
('Chisel Head'),
('Knife Blade'),
('Sword Blade'),
('Large Blade'),
('Crossbar'),
('Hand Guard'),
('Wide Guard'),
('Arrowhead'),
('Fletching'),
('Bow Limb'),
('Bowstring'),
('Crossbow Limb'),
('Crossbow Body'),
('Shuriken');



-- EXAMPLES:
-- INSERT INTO users (name)
-- 	VALUES ('naxlin')

-- INSERT INTO conferences (conferenceName)
-- 	VALUES ('April 2019')

-- INSERT INTO talks (talkTitle, speaker, conference, session)
-- 	VALUES ('How Can I Understand?', 1, 1, 1),
-- 	('The Sustaining of Church Officers', 2, 1, 2),
-- 	('Abound with Blessings', 3, 1, 3);

-- INSERT INTO notes (noteText, userfk, talk)
-- 	VALUES ('How Can I Understand?', 1, 1),
-- 	('How Can I Understand?', 1, 1),
-- 	('The Sustaining of Church Officers', 1, 2),
-- 	('The Sustaining of Church Officers', 1, 2),
-- 	('Abound with Blessings', 1, 3),
-- 	('Abound with Blessings', 1, 3);

-- ALTER TABLE talks
-- 	ADD COLUMN talkTitle varchar NOT NULL;
