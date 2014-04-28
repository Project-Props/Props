/*
 * Data vi kan teste på
 */

-- Sections(id, name) id = auto
INSERT INTO Sections VALUES ('Møbler');
INSERT INTO Sections VALUES ('Rekvisitter');
INSERT INTO Sections VALUES ('Forestillinger');
INSERT INTO Sections VALUES ('Våben');
INSERT INTO Sections VALUES ('Diverse');

-- Prop_statuses(id, name, color) id = auto
INSERT INTO Prop_statuses VALUES ('ledig', 'grøn');
INSERT INTO Prop_statuses VALUES ('reserveret', 'gul');
INSERT INTO Prop_statuses VALUES ('i brug', 'rød');
INSERT INTO Prop_statuses VALUES ('pakket ned', 'orange'); -- skal self. ændres!

-- Production_statuses(id, name, color) id = auto
INSERT INTO Production_statuses VALUES ('Skilt', 'red');
INSERT INTO Production_statuses VALUES ('I repertoire', 'orange'); -- i container 
INSERT INTO Production_statuses VALUES ('Udlånt', 'blue');
INSERT INTO Production_statuses VALUES ('I sæson', 'green');

-- Periods(id, name) id = auto
INSERT INTO Periods VALUES ('Barok');
INSERT INTO Periods VALUES ('Klunketiden');
INSERT INTO Periods VALUES ('Guldalder');
INSERT INTO Periods VALUES ('Renæssancen');

-- Users(id, name, email)
INSERT INTO Users VALUES (1, 'Hanne Jensen', '123@mail.dk');
INSERT INTO Users VALUES (2, 'Ole Hansen', 'ole@mail.dk');
INSERT INTO Users VALUES (3, 'Peter Petersen', 'peter@mail.dk');
INSERT INTO Users VALUES (4, 'Hans Hansen', 'hans@mail.dk');
INSERT INTO Users VALUES (5, 'Gunvar', 'gunnii@mail.dk');
INSERT INTO Users VALUES (6, 'Lone Trist', 'Lone-i-solen@mail.dk');

-- Suppliers(id, name, email, web-page, phone, street, city, zipcode, country, comment) id = auto
INSERT INTO Suppliers VALUES ('Netto', 'netto@netto.dk', 'www.netto.dk', '62514925', 'Nettovej 1337', 'Nettoby', '1337', 'Nettoland', 'Netto er vold nice! De har de bedste trææsker!');
INSERT INTO Suppliers(name, email, comments) VALUES ('Fakta', 'fakta@fakta.dk', 'Fakta er lort! Gå i Netto næste gang!');

-- Productions(id, title, status_id, premiere_date, venue, instructor, scenographer, choreographer, stage_manager,
--			   storage, comment, date_added)
INSERT INTO Productions VALUES ('0000-2014', 'en dejlig forestilling', 4, 'spillested', 'Hans Hansen', 'Jens Jensen', 'Charlotte', 'Mikkel', 'opbevaringssted', 'Hans er en lort', 2014-04-28);
INSERT INTO Productions VALUES ('0001-2014', 'en mindre dejlig forestilling', 4, 'spillested', 'Hans Hansen', 'Jens Jensen', 'Charlotte', 'Mikkel', 'opbevaringssted', 'Hans er en lort', 2014-04-28);

-- Props(id, prop_nr, section_id, desription, comment, date_added, date_updated, supplier_id, price,
--		 bought_for_id, status_id, size, period_id, deleted, creditor_id, maintenance_time)
INSERT INTO Props VALUES (26, 1, 'en dejlig stol', 'hej hej', 2014-04-28, 2014-04-28, 1, 13.37, '0000-2014', 3, 'størrelse', 1, 0, 1, 13.37);
INSERT INTO Props VALUES (27, 1, 'en mindre dejlig stol', 'hej hej hej', 2014-04-28, 2014-04-28, 1, 13.37, '0000-2014', 3, 'størrelse', 2, 0, 6, 13.37);

-- Used_in(prop_id, production_id)
INSERT INTO Used_in VALUES (1, '0000-2014');
INSERT INTO Used_in VALUES (1, '0001-2014');
INSERT INTO Used_in VALUES (2, '0000-2014');