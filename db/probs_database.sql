/*
 * Creating the Props 2.0 database and tables. 
 */

DROP DATABASE IF EXISTS Props_2;

CREATE DATABASE IF NOT EXISTS Props_2;
-- Undersøg om det giver mening med : DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE Props_2;
SET default_storage_engine = MYISAM;

CREATE TABLE IF NOT EXISTS Sections(
    id INT NOT NULL AUTO_INCREMENT
  , name VARCHAR(128) NOT NULL
  , PRIMARY KEY (id)
  , FULLTEXT INDEX ftsection (name)
);

CREATE TABLE IF NOT EXISTS Prop_statuses(
    id INT NOT NULL AUTO_INCREMENT
  , name VARCHAR(128) NOT NULL
  , color VARCHAR(128) NOT NULL
  , PRIMARY KEY (id)
  , FULLTEXT INDEX ftpropstat (name)
);

CREATE TABLE IF NOT EXISTS Production_statuses(
    id INT NOT NULL AUTO_INCREMENT
  , name VARCHAR(128) NOT NULL
  , color VARCHAR(128) NOT NULL
  , PRIMARY KEY (id)
  , FULLTEXT INDEX ftprodstat (name)
);

CREATE TABLE IF NOT EXISTS Periods(
    id INT NOT NULL AUTO_INCREMENT
  , name VARCHAR(128) NOT NULL
  , PRIMARY KEY (id)
  , FULLTEXT INDEX ftperiods (name)
);


CREATE TABLE IF NOT EXISTS Suppliers (
    id INT NOT NULL AUTO_INCREMENT
  , name VARCHAR(128) NOT NULL
  , email VARCHAR(128) 
  , web_page VARCHAR(128)
  , phone VARCHAR(128)
  , street VARCHAR(128)
  , city VARCHAR(128)
  , zip_code VARCHAR(128)
  , country VARCHAR(128)
  , comment TEXT
  , PRIMARY KEY (id)
  , FULLTEXT INDEX ftsuppl (name)
);

CREATE TABLE IF NOT EXISTS Productions (
    id VARCHAR(9) NOT NULL -- production number, on the form xxxx-yyyy
  , title VARCHAR(128) NOT NULL
  , status_id INT NOT NULL
  , premiere_date DATE
  , venue VARCHAR(128) -- spillested
  , instructor VARCHAR(128) -- en lille sød kommentar <3
  , scenographer VARCHAR(128)
  , choreographer VARCHAR(128)
  , stage_manager VARCHAR(128)
  , storage VARCHAR(128) -- opbevaringssted
  , comment TEXT
  , date_added DATETIME NOT NULL 
  , date_updated DATETIME NOT NULL 
  , PRIMARY KEY (id)
  , FOREIGN KEY (status_id) REFERENCES Production_statuses(id)
  , FULLTEXT INDEX ftprod (title, venue, instructor, scenographer, choreographer, stage_manager, storage, comment)
);

CREATE TABLE IF NOT EXISTS Props(
    id INT NOT NULL AUTO_INCREMENT
  , prop_nr INT NOT NULL
  , old_prop_nr INT
  , section_id INT NOT NULL
  , description VARCHAR(128) NOT NULL
  , comment TEXT
  , date_added DATETIME NOT NULL
  , date_updated DATETIME NOT NULL
  , supplier_id INT
  , price REAL
  , bought_for_id VARCHAR(9)
  , status_id INT NOT NULL
  , size VARCHAR(128)
  , category VARCHAR(128)
  , subcategory VARCHAR(128)
  , period_id INT
  , deleted BOOLEAN NOT NULL DEFAULT 0
  , creditor VARCHAR(128)
  , maintenance_time REAL
  , PRIMARY KEY (id)
  , FOREIGN KEY (section_id) REFERENCES Sections(id)
  , FOREIGN KEY (supplier_id) REFERENCES Suppliers(id)
  , FOREIGN KEY (bought_for_id) REFERENCES Productions(id)
  , FOREIGN KEY (status_id) REFERENCES Prop_statuses(id)
  , FOREIGN KEY (period_id) REFERENCES Periods(id)
  , FULLTEXT INDEX ftprop (description, comment, size, category, subcategory, creditor)
);

CREATE TABLE IF NOT EXISTS Used_in (
    prop_id INT NOT NULL
  , production_id VARCHAR(9) NOT NULL
  , PRIMARY KEY (prop_id, production_id)
  , FOREIGN KEY (prop_id) REFERENCES Props(id)
  , FOREIGN KEY (production_id) REFERENCES Productions(id)
);
