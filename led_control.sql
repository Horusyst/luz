-- led_control.sql
CREATE DATABASE led_control;

USE led_control;

CREATE TABLE led_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    led_id INT NOT NULL,
    status BOOLEAN NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO led_status (led_id, status) VALUES
(1, 0),
(2, 0),
(3, 0);
