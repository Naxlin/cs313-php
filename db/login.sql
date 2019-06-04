CREATE TABLE credentials (
	cred_key SERIAL PRIMARY KEY,
	user varchar NOT NULL,
	pass varchar NOT NULL
);