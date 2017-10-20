CREATE database alternatum;
use alternatum;


CREATE TABLE Building (
    ID int NOT NULL AUTO_INCREMENT,
    Building varchar(255) NOT NULL,
    PRIMARY KEY (ID)
);


CREATE TABLE Level (
    ID int NOT NULL AUTO_INCREMENT,
    Level varchar(255) NOT NULL,
    PRIMARY KEY (ID)
);


CREATE TABLE Responsible (
    ID int NOT NULL AUTO_INCREMENT,
    Field1 varchar(255) NOT NULL,
    PRIMARY KEY (ID)
);


CREATE TABLE DorR (
    ID int NOT NULL AUTO_INCREMENT,
    DorR varchar(255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE RoomNo (
    ID int NOT NULL AUTO_INCREMENT,
    RoomNo varchar(255) NOT NULL,
    PRIMARY KEY (ID)
);


CREATE TABLE Main (
    ID int NOT NULL AUTO_INCREMENT,
    Building INT,
    FOREIGN KEY (Building)
		REFERENCES Building(ID),
	Level INT,
    FOREIGN KEY (Level)
		REFERENCES Level(ID),
	RoomNo INT,
    FOREIGN KEY (RoomNo)
		REFERENCES RoomNo(ID),
	Description varchar(2048),
    DorR INT,
    FOREIGN KEY (DorR)
		REFERENCES DorR(ID),
	Photo varchar(1024),
    InspectionDate datetime,
    Responsible INT,
    FOREIGN KEY (Responsible)
		REFERENCES Responsible(ID),
	User INT,
    FOREIGN KEY (User)
		REFERENCES users(ID),
	DueDate datetime,
    Complete int,
    PRIMARY KEY (ID)
);


Create table users (
	ID int NOT NULL AUTO_INCREMENT,
    Name varchar(255),
    Role varchar(255),
    username varchar(255),
    password varchar(255),
    PRIMARY KEY (ID)
);

create table user_building (
	ID int NOT NULL AUTO_INCREMENT,
	User_id INT,
    FOREIGN KEY (User_id)
		REFERENCES Users(ID),
	Building_id INT,
    FOREIGN KEY (Building_id)
		REFERENCES Building(ID),
	PRIMARY KEY (ID)
);

Create table internal_users (
	ID int NOT NULL AUTO_INCREMENT,
    Name varchar(255),
    username varchar(255),
    password varchar(255),
    PRIMARY KEY (ID)
);
