/* Schema for the application database */
/* Note: SQLite applies auto_increment automatically for primary key fields of type INT */

CREATE TABLE user(
	id INTEGER,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,

	PRIMARY KEY(id)
);

CREATE TABLE message(
	id INTEGER,
	sender INT NOT NULL,
	content VARCHAR(1000) NOT NULL,
	date INT NOT NULL,

	FOREIGN KEY(sender) REFERENCES user(id),
	PRIMARY KEY(id)
);

