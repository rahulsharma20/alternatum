Alter table alternatum.users add email varchar(512);
Alter table alternatum.users add phone varchar(512);
Alter table alternatum.users add project_role varchar(256);
Alter table alternatum.users add company varchar(512);


ALTER TABLE alternatum.level
  ADD COLUMN building INT,
  ADD FOREIGN KEY building(building) REFERENCES building(id) ON DELETE CASCADE;

Create table building_types (
	ID int NOT NULL AUTO_INCREMENT,
    Name varchar(255),
    PRIMARY KEY (ID)
);

Alter Table alternatum.building add size varchar(512);

ALTER TABLE alternatum.building
  ADD COLUMN building_type INT,
  ADD FOREIGN KEY building_type(building_type) REFERENCES building_types(id) ON DELETE CASCADE;
  
insert into alternatum.building_types (Name) values ('commercial');
insert into alternatum.building_types (Name) values ('warehouse');
insert into alternatum.building_types (Name) values ('residential');
insert into alternatum.building_types (Name) values ('DC');


Create table project (
	ID int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    address varchar(1024),
    gps_coordinates varchar(512),
    plan_view varchar(256),
    ownership varchar(256),
    occupant varchar(256),
    PRIMARY KEY (ID)
);
