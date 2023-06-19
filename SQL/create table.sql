CREATE DATABASE hospital;
USE hospital;

CREATE TABLE `Patient` (
	`Patient_ID`	varchar(20)	NOT NULL,
	`PName`	varchar(20)	NULL,
	`Personal_ID`	varchar(20)	NULL,
	`PNumber`	varchar(20)	NULL,
	`Address`	varchar(100)	NULL
);

CREATE TABLE `Department` (
	`Department_ID`	varchar(20)	NOT NULL,
	`Department_Name`	varchar(50)	NULL
);

CREATE TABLE `Employee` (
	`Employee_ID`	varchar(20)	NOT NULL,
	`EName`	varchar(20)	NULL,
	`Personal_ID`	varchar(20)	NULL,
	`ENumber`	varchar(20)	NULL,
	`Address`	varchar(100)	NULL,
	`Department_ID`	varchar(20)	NOT NULL,
	`Position_ID`	varchar(20)	NOT NULL
);

CREATE TABLE `Room` (
	`Room_ID`	varchar(20)	NOT NULL,
	`Room_Type`	varchar(20)	NULL,
	`Occupied`	varchar(5)	NULL
);

CREATE TABLE `Reservation` (
	`Reservation_ID`	varchar(20)	NOT NULL,
	`Reservation_Type`	varchar(20)	NULL,
	`Reservation_Date`	timestamp	NULL,
	`Patient_ID`	varchar(20)	NOT NULL,
	`Employee_ID`	varchar(20)	NOT NULL
);

CREATE TABLE `Operation` (
	`Operation_ID`	varchar(20)	NOT NULL,
	`Operation_Detail`	varchar(100)	NULL,
	`Operation_Date`	timestamp	NULL,
	`Employee_ID`	varchar(20)	NOT NULL,
	`Patient_ID`	varchar(20)	NOT NULL,
	`Room_ID`	varchar(20)	NOT NULL,
	`Treatment_ID`	varchar(20)	NOT NULL,
	`Examination_ID`	varchar(20)	NOT NULL
);

CREATE TABLE `Treatment` (
	`Treatment_ID`	varchar(20)	NOT NULL,
	`Treatment_Detail`	varchar(100)	NULL,
	`Treatment_Date`	timestamp	NULL,
	`Employee_ID`	varchar(20)	NOT NULL,
	`Patient_ID`	varchar(20)	NOT NULL,
	`Room_ID`	varchar(20)	NOT NULL
);

CREATE TABLE `Examination` (
	`Examination_ID`	varchar(20)	NOT NULL,
	`Examination_Detail`	varchar(100)	NULL,
	`Examination_Date`	timestamp	NULL,
	`Employee_ID`	varchar(20)	NOT NULL,
	`Patient_ID`	varchar(20)	NOT NULL,
	`Room_ID`	varchar(20)	NOT NULL,
	`Treatment_ID`	varchar(20)	NOT NULL
);

CREATE TABLE `Hospitalization` (
	`Hospitalization_ID`	varchar(20)	NOT NULL,
	`Start_Date`	timestamp	NULL,
	`End_Date`	timestamp	NULL,
	`Employee_ID`	varchar(20)	NOT NULL,
	`Patient_ID`	varchar(20)	NOT NULL,
	`Room_ID`	varchar(20)	NOT NULL,
	`Treatment_ID`	varchar(20)	NOT NULL
);

CREATE TABLE `Position` (
	`Position_ID`	varchar(20)	NOT NULL,
	`Position_Name`	varchar(50)	NULL
);

ALTER TABLE `Patient` ADD CONSTRAINT `PK_PATIENT` PRIMARY KEY (
	`Patient_ID`
);

ALTER TABLE `Department` ADD CONSTRAINT `PK_DEPARTMENT` PRIMARY KEY (
	`Department_ID`
);

ALTER TABLE `Employee` ADD CONSTRAINT `PK_EMPLOYEE` PRIMARY KEY (
	`Employee_ID`
);

ALTER TABLE `Room` ADD CONSTRAINT `PK_ROOM` PRIMARY KEY (
	`Room_ID`
);

ALTER TABLE `Reservation` ADD CONSTRAINT `PK_RESERVATION` PRIMARY KEY (
	`Reservation_ID`
);

ALTER TABLE `Operation` ADD CONSTRAINT `PK_OPERATION` PRIMARY KEY (
	`Operation_ID`
);

ALTER TABLE `Treatment` ADD CONSTRAINT `PK_TREATMENT` PRIMARY KEY (
	`Treatment_ID`
);

ALTER TABLE `Examination` ADD CONSTRAINT `PK_EXAMINATION` PRIMARY KEY (
	`Examination_ID`
);

ALTER TABLE `Hospitalization` ADD CONSTRAINT `PK_HOSPITALIZATION` PRIMARY KEY (
	`Hospitalization_ID`
);

ALTER TABLE `Position` ADD CONSTRAINT `PK_POSITION` PRIMARY KEY (
	`Position_ID`
);

