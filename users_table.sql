CREATE TABLE users (
	id INT(11) AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	password CHAR(40) NOT NULL,
	email VARCHAR(255),
	role CHAR(5),
	PRIMARY KEY (id)
);
INSERT INTO users (username, password, email, role) VALUES ('admin_user', SHA('admin_pass'), 'admin@email.com', 'admin'), ('sherlock', SHA('holmes'), 'sherlock@email.com', 'user'), ('john', SHA('watson'), 'john@email', 'user');