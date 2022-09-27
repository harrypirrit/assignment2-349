CREATE TABLE currencies (
    userID varchar(10),
    defaultCurrency varchar(3),
    PRIMARY KEY (userID)
);

INSERT INTO currencies VALUES ('User', 'NZD');