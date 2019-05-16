
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
	stat_name varchar NOT NULL,
	stat_desc text NOT NULL
);

CREATE TABLE tinkers (
	tinkers_id SERIAL PRIMARY KEY,
	level int NOT NULL,
	material int NOT NULL references materials(material_id),
	stat int NOT NULL references stat_types(stat_id),
	part int NOT NULL references part_types(part_id)
);







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
