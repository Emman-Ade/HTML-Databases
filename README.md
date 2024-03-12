This is for testing purposes if you want to see what the code does:
newconnect.php connects registration.php to my SQL database, the  code for mySQL database is:
CREATE TABLE status (
    status_id INT PRIMARY KEY,
    statusOF VARCHAR(50)
);

INSERT INTO status (status_id, statusOF) VALUES
(1, 'Qualifications met'),
(2, 'Application under review'),
(3, 'Submit Video'),
(4, 'Hired');

CREATE TABLE registration (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(40) NOT NULL,
    lastname VARCHAR(40) NOT NULL,
    eagle_id INT NOT NULL,
    status_id INT,
    FOREIGN KEY (status_id) REFERENCES status (status_id) ON DELETE SET NULL
);
