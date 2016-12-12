
/*****************************************
* Create the llama_lodge database
*****************************************/


DROP DATABASE IF EXISTS llama_lodge;
CREATE DATABASE llama_lodge;
USE llama_lodge;

-- create the tables
CREATE TABLE categories (
  categoryID       INT(11)        NOT NULL   AUTO_INCREMENT,
  categoryName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE products (
  productID        INT(11)        NOT NULL   AUTO_INCREMENT,
  categoryID       INT(11)        NOT NULL,
  productCode      VARCHAR(10)    NOT NULL   UNIQUE,
  productName      VARCHAR(255)   NOT NULL,
  listPrice        DECIMAL(10,2)  NOT NULL,
  discountPercent  DECIMAL(3)     NOT NULL,
  description      VARCHAR(255)   NOT NULL,
  PRIMARY KEY (productID)
);


CREATE TABLE orders (
  orderID        INT(11)        NOT NULL   AUTO_INCREMENT,
  customerID     INT            NOT NULL,
  orderDate      DATETIME       NOT NULL,
  productID       INT(11)       NOT NULL,
  quantity_ordered       INT(11)        NOT NULL,
  PRIMARY KEY (orderID)
);

CREATE TABLE users (
  userID   		 INT(12)        NOT NULL   AUTO_INCREMENT,
  username       varchar(16)    NOT NULL,
  userpass       varchar(50)    NOT NULL,

  PRIMARY KEY (userID)
);

-- insert data into the database
INSERT INTO categories VALUES
(1, 'llamas'),
(2, 'alpacas'),
(3, 'camels'),
(4, 'other');

INSERT INTO users VALUES
(1, 'byefelicia', 'admin'),
(2, 'grrimangry', 'z8c8jsa03'),
(3, 'llamallover', '11ama1ov3r'),
(4, 'donaldtrump', 'buildthewall');

INSERT INTO products VALUES
(1, 1, 'chilean', 'Chilean Red Heavy-Wool Llama', '399.00', 5, 'A friendly, naturally-red-coated llama, with a fiery coat but a friendly attitude.'),
(2, 1, 'argentine', 'Argentine White Heavy-Wool Llama', '699.00', 10, 'White coats are in high-demand, and this llama grows an abundance of the easily-dyeable material.'),
(3, 1, 'bolivian', 'Bolivian Grey Medium-Wool Llama', '399.00', 5, 'From the valleys of Bolivia, this sturdy grey llama does well in warm environments as a sheep-protector.'),
(4, 1, 'ccara', 'Ccara Cream-colored Llama', '489.99', 10, 'Possibly the most iconic llama, the Ccara can serve both as an excellent sheep-protector and as a sheared animal.'),
(5, 2, 'spotted', 'Huacaya Spotted Alpaca', '299.00', 15, 'While not in high demand, spotted alpacas make great companion animals, for both humans and other farm animals.'),
(6, 2, 'suri', 'Suri Beige Alpaca', '415.00', 5, 'Known for its long, heavy coat, the Suri alpaca mainly serves as a large producer of fabric materials. It eats a lot of feed, though.'),
(7, 2, 'brown', 'Huacaya Brown Alpaca', '399.99', 5, 'Brown Huacayas are in moderately high demand, due to the popularity of their brown hair. They are very peaceful, except around humans that are Libras.'),
(8, 2, 'white', 'Huacaya White Alpaca', '599.99', 10, 'This is possibly the most popular alpaca in the world, due to its overwhelming adorableness and all-purpose white hair.'),
(9, 3, 'onehump', 'Dromedary Camel', '1199.99', 10, 'The classic one-humped camel.'),
(10, 3, 'twohump', 'Bactrian Camel', '1299.99', 10, 'Bactrian camels are known for their large necks and dual humps, which makes them much more comfortable to ride.');

-- create the users and grant privileges to those users
GRANT SELECT, INSERT, DELETE, UPDATE
ON llama_lodge.*
TO mgs_user@localhost
IDENTIFIED BY 'pa55word';

GRANT SELECT, UPDATE
ON products
TO mgs_tester@localhost
IDENTIFIED BY 'pa55word';
