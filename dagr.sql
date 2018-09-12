/* DROP DATABASE mmda; */

CREATE DATABASE mmda;

CREATE TABLE dagr (
  ID varchar(255) NOT NULL,
  Name varchar(255),
  FilePath varchar(255),
  Category varchar(64),
  Subcategory varchar(64),
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
