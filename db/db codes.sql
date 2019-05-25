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

CREATE TABLE modifiers (
	modifier_id SERIAL PRIMARY KEY,
	modifier_name varchar NOT NULL,
	modifier_desc text NOT NULL
);

ALTER TABLE modifiers RENAME TO traits;

ALTER TABLE traits
RENAME COLUMN modifier_id TO trait_id;

ALTER TABLE traits
RENAME COLUMN modifier_name TO trait_name;

ALTER TABLE traits
RENAME COLUMN modifier_desc TO trait_desc;


CREATE TABLE material_attributes (
	mat_att_id SERIAL PRIMARY KEY,
	level int NOT NULL,
	material int NOT NULL references materials(material_id),
	attribute int NOT NULL references attributes(attribute_id)
);

ALTER TABLE material_attributes RENAME TO material_traits;

ALTER TABLE material_traits
RENAME COLUMN attribute TO trait;

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
INSERT INTO singularity_parents (singularity, parent1, parent2, parent3, parent4, parent5, parent6, parent7, parent8, parent9) VALUES
(80, 1, 2, 13, 3, 4, 14, 5, 12, 15),
(81, 16, 17, 22, 18, 19, 23, 20, 21, 24),
(82, 25, 26, 31, 27, 28, 32, 29, 30, 33),
(83, 34, 35, 6, 36, 37, 7, 38, 39, 8),
(84, 9, 10, 43, 11, 40, 44, 41, 42, 45),
(85, 46, 47, 52, 48, 49, 53, 50, 51, 54),
(86, 55, 56, 61, 57, 58, 62, 59, 60, 63),
(87, 64, 65, 70, 66, 67, 71, 68, 69, 72),
(88, 73, 74, 79, 75, 76, 90, 77, 78, 90),
(89, 80, 81, 82, 83, 84, 85, 86, 87, 88);

-- INSERTED
INSERT INTO singularities (singularity_name, compound, item_cost, item) VALUES
('Iron Singularity', FALSE, 36000, 2),
('Golden Singularity', FALSE, 32800, 3),
('Lapis Singularity', FALSE, 36000, 4),
('Redstone Singularity', FALSE, 37600, 5),
('Nether Quartz Singularity', FALSE, 34400, 6),
('Copper Singularity', FALSE, 36000, 7),
('Tin Singularity', FALSE, 36000, 8),
('Leaden Singularity', FALSE, 34400, 9),
('Silver Singularity', FALSE, 34400, 10),
('Nickel Singularity', FALSE, 36000, 11),
('Clay Singularity', FALSE, 32000, 12),
('Manganese Singularity', FALSE, 36000, 13),
('Eximite Singularity', FALSE, 36000, 14),
('Meutoite Singularity', FALSE, 36000, 15),
('Prometheum Singularity', FALSE, 36000, 16),
('DeepIron Singularity', FALSE, 36000, 17),
('Infuscolium Singularity', FALSE, 36000, 18),
('Oureclase Singularity', FALSE, 36000, 19),
('AstralSilver Singularity', FALSE, 36000, 20),
('Carmot Singularity', FALSE, 36000, 21),
('Rubracium Singularity', FALSE, 36000, 22),
('Orichalcum Singularity', FALSE, 36000, 23),
('Adamantine Singularity', FALSE, 36000, 24),
('Atlarus Singularity', FALSE, 36000, 25),
('Ignatius Singularity', FALSE, 36000, 26),
('ShadowIron Singularity', FALSE, 36000, 27),
('Lemurite Singularity', FALSE, 36000, 28),
('Midasium Singularity', FALSE, 36000, 29),
('Vyroxeres Singularity', FALSE, 36000, 30),
('Ceruclase Singularity', FALSE, 36000, 31),
('Alduorite Singularity', FALSE, 36000, 32),
('Kalendrite Singularity', FALSE, 36000, 33),
('Vulcanite Singularity', FALSE, 36000, 34),
('Sanguinite Singularity', FALSE, 36000, 35),
('Obsidian Singularity', FALSE, 36000, 36),
('Shadow Singularity', FALSE, 36000, 37),
('Thorium Singularity', FALSE, 36000, 38),
('Lithium Singularity', FALSE, 36000, 39),
('Boron Singularity', FALSE, 36000, 40),
('Platinum Singularity', FALSE, 30800, 41),
('Mithril Singularity', FALSE, 30000, 42),
('Signalum Singularity', FALSE, 31200, 43),
('Lumium Singularity', FALSE, 31040, 44),
('Enderium Singularity', FALSE, 30800, 45),
('Coal Singularity', FALSE, 31040, 46),
('Emerald Singularity', FALSE, 30896, 47),
('Diamond Singularity', FALSE, 30816, 48),
('Aluminum Singularity', FALSE, 31072, 49),
('Brass Singularity', FALSE, 30672, 50),
('Bronze Singularity', FALSE, 31040, 51),
('Charcoal Singularity', FALSE, 30896, 52),
('Electrum Singularity', FALSE, 31104, 53),
('Invar Singularity', FALSE, 31120, 54),
('Magnesium Singularity', FALSE, 30832, 55),
('Peridot Singularity', FALSE, 31120, 56),
('Ruby Singularity', FALSE, 31056, 57),
('Sapphire Singularity', FALSE, 30976, 58),
('Steel Singularity', FALSE, 31008, 59),
('Uranium Singularity', FALSE, 30800, 60),
('Zinc Singularity', FALSE, 30813, 61),
('Conductive Iron Singularity', FALSE, 30640, 62),
('Electrical Steel Singularity', FALSE, 31056, 63),
('Energetic Alloy Singularity', FALSE, 30928, 64),
('Dark Steel Singularity', FALSE, 30832, 65),
('Pulsating Iron Singularity', FALSE, 30784, 66),
('Redstone Alloy Singularity', FALSE, 31024, 67),
('Soularium Singularity', FALSE, 30768, 68),
('Vibrant Alloy Singularity', FALSE, 30784, 69),
('Bitumen Singularity', FALSE, 31088, 70),
('Potash Singularity', FALSE, 30960, 71),
('Saltpeter Singularity', FALSE, 30736, 72),
('Sulfur Singularity', FALSE, 30656, 73),
('Tartarite Singularity', FALSE, 30928, 74),
('Aluminum Brass Singularity', FALSE, 31008, 75),
('Alumite Singularity', FALSE, 30944, 76),
('Ardite Singularity', FALSE, 30976, 77),
('Cobalt Singularity', FALSE, 30672, 78),
('Ender Singularity', FALSE, 30784, 79),
('Manyullyn Singularity', FALSE, 30768, 80),
('Nitronic Singularity', TRUE, 9, 1),
('Psychotic Singularity', TRUE, 9, 1),
('Sphaghettic Singularity', TRUE, 9, 1),
('Pneumatic Singularity', TRUE, 9, 1),
('Cryptic Singularity', TRUE, 9, 1),
('Historic Singularity', TRUE, 9, 1),
('Meteoric Singularity', TRUE, 9, 1),
('Gastronomic Singularity', TRUE, 9, 1),
('Chromatic Singularity', TRUE, 7, 1),
('Eternal Singularity', TRUE, 9, 1),
('No Singularity', FALSE, 0, 1);

-- INSERTED
INSERT INTO items (item_name) VALUES
('No Item'),
('Block of Iron'),
('Block of Gold'),
('Lapis Lazuli Block'),
('Block of Redstone'),
('Block of Quartz'),
('Copper Block'),
('Tin Block'),
('Block of Lead'),
('Silver Block'),
('Ferrous Block'),
('Clay'),
('Manganese Block'),
('Eximite Block'),
('Meutoite Block'),
('Prometheum Block'),
('Deep Iron Block'),
('Infuscolium Block'),
('Oureclase Block'),
('Astral Silver Block'),
('Carmot Block'),
('Rubracium Block'),
('Orichalcum Block'),
('Adamantine Block'),
('Atlarus Block'),
('Ignatius Block'),
('Shadow Iron Block'),
('Lemurite Block'),
('Midasium Block'),
('Vyroxeres Block'),
('Ceruclase Block'),
('Alduorite Block'),
('Kalendrite Block'),
('Vulcanite Block'),
('Sanguinite Block'),
('Obsidian'),
('Block of Shadowmetal'),
('Thorium Block'),
('Lithiums Block'),
('Boron Block'),
('Platinum Block'),
('Mithril Block'),
('Signalum Block'),
('Lumium Block'),
('Enderium Block'),
('Block of Coal'),
('Block of Emerald'),
('Block of Diamond'),
('Block of Aluminum'),
('Brass Block'),
('Bronze Block'),
('Block of Charcoal'),
('Electrum Block'),
('Invar Block'),
('Magnesium Block'),
('Block of Peridot'),
('Block of Ruby'),
('Sapphire Block'),
('Steel Block'),
('Uranium Block'),
('Zinc Block'),
('Conductive Iron Block'),
('Electrical Steel Block'),
('Energetic Alloy Block'),
('Dark Steel Block'),
('Pulsating Iron Block'),
('Redstone Alloy Block'),
('Soularium Block'),
('Vibrant Alloy Block'),
('Bitumen Block'),
('Potash Block'),
('Saltpeter Block'),
('Sulfur Block'),
('Tartarite Block'),
('Block of Aluminum Brass'),
('Block of Alumite'),
('Block of Ardite'),
('Block of Cobalt'),
('Block of Solid Ender'),
('Block of Manyullyn');

-- INSERTED
INSERT INTO material_traits (level, material, trait) VALUES
(1, 22, 1),
(2, 36, 2),
(1, 35, 3),
(1, 34, 4),
(1, 33, 5),
(2, 31, 1),
(1, 30, 1),
(2, 27, 1),
(1, 25, 1),
(1, 39, 6),
(1, 40, 7),
(1, 40, 1),
(2, 41, 7),
(2, 41, 1),
(2, 42, 3),
(1, 43, 2),
(2, 44, 1),
(2, 47, 1),
(3, 59, 1),
(1, 56, 1),
(1, 55, 8),
(1, 50, 1),
(1, 60, 8),
(1, 61, 9),
(1, 69, 10),
(1, 75, 11),
(2, 62, 1),
(2, 63, 8),
(1, 66, 1),
(2, 67, 1),
(2, 68, 1),
(1, 70, 1),
(1, 71, 1),
(1, 72, 1),
(1, 73, 13),
(1, 74, 14),
(1, 76, 15),
(1, 77, 16),
(1, 77, 17),
(1, 78, 18),
(1, 79, 12);

-- INSERTED
INSERT INTO traits (trait_name, trait_desc) VALUES
('Reinforced', '10% chance per level of not using durability'),
('Poison', 'Poisons the enemy'),
('Ignite', 'Catches the enemy on fire'),
('Slowness', 'Causes the enemy to move slowly'),
('Life Steal', 'Steals a heart per level per hit'),
('Wither', 'Inflicts wither on the enemy'),
('Weakness', 'Causes weakness on the enemy'),
('Stonebound', 'The tool mines faster as it wears out, but does less damage'),
('Slimy Green', 'After block break or after hit, chance to spawn a Green slime'),
('Slimy Blue', 'After block break or after hit, chance to spawn a Blue slime'),
('Slimy Pink', 'After block break or after hit, chance to spawn a Pink slime'),
('Jagged', 'The tool does more damage as it wears out, but mines slower'),
('Modifiable', 'Gives 1 Modifier per piece or 8 total if only material'),
('Tough', 'Unknown effect, presumably similar to Reinforced'),
('Supermassive', 'Potentially Knockback'),
('Cosmic', 'Powers of the Universe, or maybe just some modifiers'),
('Unbreakable', 'The tools effective durability is infinite'),
('Thaumic', 'One extra modifier, two extra for 3 pieces or full tool');

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
