CREATE TABLE credentials (
	cred_key SERIAL PRIMARY KEY,
	username varchar NOT NULL,
	password varchar NOT NULL
);