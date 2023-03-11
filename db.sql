CREATE TABLE usuarios (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	senha VARCHAR(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (email)
);

CREATE TABLE produtos (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	descricao VARCHAR(255) NOT NULL,
	preco DECIMAL(10,2) NOT NULL,
	quantidade INT(11) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE vendas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  produto VARCHAR(50) NOT NULL,
  quantidade INT(11) NOT NULL,
	data_venda TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
