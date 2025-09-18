CREATE DATABASE da;

USE DATABASE da;


CREATE TABLE sell_products (
    email VARCHAR(50),
    product_name VARCHAR(50),
    species_name VARCHAR(50),
    farmer_name VARCHAR(50),
    weight INT,
    price INT,
    statement VARCHAR(400),
    image VARCHAR(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE sold_products(
  product_id INT,
  email VARCHAR(50),
  customer_name VARCHAR(50),
  last_name VARCHAR(50),
  delivery_address VARCHAR(200),
  build_name VARCHAR(70),
  landmark_name VARCHAR(70),
  pincode INT,
  phone_no INT,
  quantity INT);


CREATE TABLE cart(product_id VARCHAR(50),email VARCHAR(50), FOREIGN KEY (email) REFERENCES u_data(email));


CREATE TABLE profile_info(
    email VARCHAR(50),
    FOREIGN KEY (email) REFERENCES u_data(email),
   first_name VARCHAR(100),
   last_name  VARCHAR(100),
   addres VARCHAR(300),
   building_name VARCHAR(100),
   landmark VARCHAR(100),
   pincode INT,
   phone_no INT
);


CREATE TABLE sold_product_history  (
    log_id SERIAL PRIMARY KEY,
    product_id INT,
    email VARCHAR(255),
    customer_name VARCHAR(255),
    delivery_address TEXT,
    build_name VARCHAR(255),
    landmark_name VARCHAR(255),
    pincode  INT,
    phone_no  INT,
    action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    action_type VARCHAR(50)
);


-- trigger
DELIMITER $$

CREATE TRIGGER after_sold_products_delete
AFTER DELETE ON sold_products
FOR EACH ROW
BEGIN
    -- Insert the deleted row into the history table
    INSERT INTO sold_product_history (
        product_id,
        email,
        customer_name,
        delivery_address,
        build_name,
        landmark_name,
        pincode,
        phone_no,
        action_type
    )
    VALUES (
        OLD.product_id,
        OLD.email,
        OLD.customer_name,
        OLD.delivery_address,
        OLD.build_name,
        OLD.landmark_name,
        OLD.pincode,
        OLD.phone_no,
        'DELETE'
    );
END$$

DELIMITER ;
