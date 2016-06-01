CREATE TABLE headquarters
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) NOT NULL,
	x DOUBLE NOT NULL,
	y DOUBLE NOT NULL,
    UNIQUE(name)
	
);

CREATE TABLE associations
(
  id INT UNSIGNED AUTO_INCREMENT,
  acronym varchar(16) NOT NULL,
  name varchar(70) NOT NULL,
  headquarter_id INT UNSIGNED NOT NULL,
  
  PRIMARY KEY(id),
  FOREIGN KEY(headquarter_id) REFERENCES headquarters(id),

  UNIQUE(name, acronym)

);

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    state INT DEFAULT 0,
    name varchar(128) NOT NULL,
    last_name_1 varchar(30) NOT NULL,
    last_name_2 varchar(30),
    association_id INT UNSIGNED NOT NULL, 

    FOREIGN KEY(association_id) REFERENCES associations(id),

    UNIQUE(username)
);

CREATE TABLE roles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name varchar(128) NOT NULL,
    UNIQUE(name)
);

CREATE TABLE users_roles(
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     user_id INT UNSIGNED NOT NULL,
     role_id  INT UNSIGNED NOT NULL,
     FOREIGN KEY(user_id) REFERENCES users(id),
     FOREIGN KEY(role_id) REFERENCES roles(id)
);

CREATE TABLE restaurants(
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     schedule varchar(128),
     card INT(1) DEFAULT 0,
     x DOUBLE NOT NULL,
     y DOUBLE NOT NULL,
     image_name varchar(256),
     association_id INT UNSIGNED,
    FOREIGN KEY(association_id) REFERENCES associations(id)
);

CREATE TABLE dishes(
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     name varchar(256) NOT NULL,
     description varchar(4096) NOT NULL
);

CREATE TABLE categories(
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     name varchar(256) NOT NULL,
     price float(10,5) NOT NULL
);

CREATE TABLE restaurants_dishes_categories(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT UNSIGNED NOT NULL,
    dishe_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    type varchar(256) NOT NULL,
    date date NOT NULL,
    FOREIGN KEY(restaurant_id) REFERENCES restaurants(id),
    FOREIGN KEY(dishe_id) REFERENCES dishes(id),
    FOREIGN KEY(category_id) REFERENCES categories(id),
    UNIQUE(restaurant_id,dishe_id,category_id)
);