DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS orders;

CREATE TABLE items (
item_id SMALLINT PRIMARY KEY,
item_name VARCHAR(20) NOT NULL,
item_price DECIMAL(6,2) NOT NULL,
item_description VARCHAR(100),
item_image VARCHAR(100) NOT NULL
);

INSERT INTO items VALUES
('1', 'chair', 14.99, "a simple chair", "images/chair.png");

INSERT INTO items VALUES
('2', 'table', 24.99, "a simple table", "images/table.png");

INSERT INTO items VALUES
('3', 'toaster', 49.99, "toaster with many functions", "images/toaster.png");

INSERT INTO items VALUES
('4', 'pan', 19.99, "a non-stick pan", "images/pan.png");

CREATE TABLE orders (
    order_id SMALLINT NOT NULL AUTO_INCREMENT,
    item_id VARCHAR(100) NOT NULL,
    cust_name VARCHAR(15) NOT NULL,
    cust_email VARCHAR(30) NOT NULL,
    cust_address VARCHAR(100) NOT NULL,
    shipped SMALLINT NOT NULL,
    PRIMARY KEY (order_id)
);

INSERT INTO orders VALUES
('0', '[2: Table],', 'test_cust', 'testcust@email.com', '17 test cust road', 0);