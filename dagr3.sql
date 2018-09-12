/* DROP DATABASE mmda; */

CREATE DATABASE mmda;

CREATE TABLE dagr (
  ID varchar(255) NOT NULL,
  Name varchar(255),
  Path varchar(255),
  FileName varchar(255),
  Extension varchar(255),
  Size varchar(255),
  Category varchar(64),
  Subcategory varchar(64),
  Annotations varchar(255),
  Type varchar(64),
  PRIMARY KEY (ID)
);

CREATE TABLE dagr_metadata (
  DID varchar(255) NOT NULL,
  CreationTime datetime,
  Deleted tinyint(1),
  CreatorName varchar(64),
  HasComponents tinyint(1),
  PRIMARY KEY (DID)
);

CREATE TABLE components (
  CID varchar(255) NOT NULL,
  PID varchar(255),
  PRIMARY KEY (CID)
);

CREATE TABLE deleted_dagrs (
  DID varchar(255) NOT NULL,
  DeletionTime datetime,
  PRIMARY KEY (DID)
);

CREATE TABLE categories (
  ID int NOT NULL AUTO_INCREMENT,
  Name varchar(255),
  PRIMARY KEY (ID)
);

CREATE TABLE subcategories (
  ID int NOT NULL AUTO_INCREMENT,
  Name varchar(255),
  CID int,
  PRIMARY KEY (ID),
  FOREIGN KEY (CID) REFERENCES Categories(ID)
);
