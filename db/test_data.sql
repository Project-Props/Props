/*
 * Data vi kan teste på
 */
 
-- Sections(id, name) id NULL = auto
INSERT INTO Sections VALUES (NULL, 'Møbler');
INSERT INTO Sections VALUES (NULL, 'Rekvisitter');
INSERT INTO Sections VALUES (NULL, 'Forestillinger');
INSERT INTO Sections VALUES (NULL, 'Våben');
INSERT INTO Sections VALUES (NULL, 'Diverse');

-- Prop_statuses(id, name, color) id NULL= auto
INSERT INTO Prop_statuses VALUES (NULL, 'ledig', 'grøn');
INSERT INTO Prop_statuses VALUES (NULL, 'reserveret', 'gul');
INSERT INTO Prop_statuses VALUES (NULL, 'i brug', 'rød');
INSERT INTO Prop_statuses VALUES (NULL, 'pakket ned', 'orange'); -- skal self. ændres!

-- Production_statuses(id, name, color) id = auto
INSERT INTO Production_statuses VALUES (NULL, 'Skilt', 'red');
INSERT INTO Production_statuses VALUES (NULL, 'I repertoire', 'orange'); -- i container 
INSERT INTO Production_statuses VALUES (NULL, 'Udlånt', 'blue');
INSERT INTO Production_statuses VALUES (NULL, 'I sæson', 'green');

-- Periods(id, name) id = auto
INSERT INTO Periods VALUES (NULL, 'Barok');
INSERT INTO Periods VALUES (NULL, 'Klunketiden');
INSERT INTO Periods VALUES (NULL, 'Guldalder');
INSERT INTO Periods VALUES (NULL, 'Renæssancen');

-- Suppliers(id, name, email, web-page, phone, street, city, zipcode, country, comment) id = auto
INSERT INTO Suppliers VALUES (NULL, 'Netto', 'netto@netto.dk', 'www.netto.dk', '62514925', 'Nettovej 1337', 'Nettoby', '1337', 'Nettoland', 'Netto er vold nice! De har de bedste trææsker!');
INSERT INTO Suppliers(name, email, comment) VALUES ('Fakta', 'fakta@fakta.dk', 'Fakta er lort! Gå i Netto næste gang!');

-- Productions(id, title, status_id, premiere_date, venue, instructor, scenographer, choreographer, stage_manager,
--			   storage, comment, date_added)
INSERT INTO Productions VALUES ('0000-2014', 'en dejlig forestilling', 4, '2014-05-05', 'spillested', 'Hans Hansen', 'Jens Jensen', 'Charlotte', 'Mikkel', 'opbevaringssted', 'Hans er en lort', 2014-04-28);
INSERT INTO Productions VALUES ('0001-2014', 'en mindre dejlig forestilling', 4, '2014-01-02', 'spillested', 'Hans Hansen', 'Jens Jensen', 'Charlotte', 'Mikkel', 'opbevaringssted', 'Hans er en lort', 2014-04-28);

-- Props(id, prop_nr, old_prop_nr, section_id, desription, comment, date_added, date_updated, supplier_id, price,
--		 bought_for_id, status_id, size, category, subcategory, period_id, deleted, creditor, maintenance_time)
INSERT INTO Props VALUES (NULL, 26, 42, 1, 'en dejlig stol', 'hej hej', '2014-04-28 12:12:12', '2014-04-28 12:12:12', 1, 13.37, '0000-2014', 3, 'størrelse', 'stol', 'stor stol', 1, 0, 'Mikkel', 13.37);
INSERT INTO Props VALUES (NULL, 27, 41, 1, 'en mindre dejlig stol', 'hej hej hej', '2014-04-28 12:12:12', '2014-04-28 12:12:12', 1, 13.37, '0000-2014', 3, 'størrelse', 'hat', 'stor hat', 2, 0, 'Mikkel', 13.37);

-- Used_in(prop_id, production_id)
INSERT INTO Used_in VALUES (1, '0000-2014');
INSERT INTO Used_in VALUES (1, '0001-2014');
INSERT INTO Used_in VALUES (2, '0000-2014');
