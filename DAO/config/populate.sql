use ticket_management;

-- =========================
-- ROLES
-- =========================
insert into roles (nom) values
('Superviseur'),   -- id_role = 1
('Team Leader'),   -- id_role = 2
('Technicien');    -- id_role = 3

-- =========================
-- STATUS
-- =========================
insert into `status` (nom) values
('En attente'),    -- id_status = 1
('En cours'),      -- id_status = 2
('Réattribuer'),   -- id_status = 3
('Annulé'),        -- id_status = 4
('Résolu');        -- id_status = 5

-- =========================
-- TYPES
-- =========================
insert into types (nom) values
('Laptop'),        -- id_type = 1
('PC'),            -- id_type = 2
('Imprimante'),    -- id_type = 3
('Smartphone'),    -- id_type = 4
('Tablette');      -- id_type = 5

-- =========================
-- PRIORITIES
-- =========================
insert into priorities (nom) values
('Faible'),        -- id_priority = 1
('Moyenne'),       -- id_priority = 2
('Haute');         -- id_priority = 3

-- =========================
-- USERS
-- (hash bcrypt d’exemple: "password")
-- =========================
insert into users (fname, lname, email, phone_number, `password`, role_id) values
('Super', 'Viseur', 'sv@tm.com', '0472555555', '$2y$10$abcdefghijklmnopqrstuv', 1), -- id_user = 1 Superviseur
('Team', 'Leader', 'tl@tm.com', '0546777777', '$2y$10$abcdefghijklmnopqrstuv', 2), -- id_user = 2 Team Leader
('Tech', 'Nicien', 'tc@tm.com', '0465888888', '$2y$10$abcdefghijklmnopqrstuv', 3), -- id_user = 3 Technicien

('Marie', 'Dupont', 'marie.dupont@tm.com', '0472000001', '$2y$10$abcdefghijklmnopqrstuv', 3), -- 4 technicien
('Jean', 'Martin', 'jean.martin@tm.com', '0472000002', '$2y$10$abcdefghijklmnopqrstuv', 3),  -- 5 technicien
('Luc', 'Lambert', 'luc.lambert@tm.com', '0472000003', '$2y$10$abcdefghijklmnopqrstuv', 3),  -- 6 technicien
('Sophie', 'Lemaire', 'sophie.lemaire@tm.com', '0472000004', '$2y$10$abcdefghijklmnopqrstuv', 2), -- 7 team leader
('Paul', 'Durand', 'paul.durand@tm.com', '0472000005', '$2y$10$abcdefghijklmnopqrstuv', 2), -- 8 team leader
('Alice', 'Moreau', 'alice.moreau@tm.com', '0472000006', '$2y$10$abcdefghijklmnopqrstuv', 1), -- 9 superviseur (1 suppl.)
('Nicolas', 'Renard', 'nicolas.renard@tm.com', '0472000007', '$2y$10$abcdefghijklmnopqrstuv', 3); -- 10 technicien

-- =========================
-- CLIENTS
-- =========================
insert into clients (fname, lname, email, phone_number) values
('Claire', 'Bernard', 'claire.bernard@client.com', '0485000001'), -- id_client = 1
('Julien', 'Petit', 'julien.petit@client.com', '0485000002'),    -- 2
('Emma', 'Dubois', 'emma.dubois@client.com', '0485000003'),      -- 3
('Lucas', 'Leroy', 'lucas.leroy@client.com', '0485000004'),      -- 4
('Chloe', 'Morel', 'chloe.morel@client.com', '0485000005'),      -- 5
('Hugo', 'Garcia', 'hugo.garcia@client.com', '0485000006'),      -- 6
('Lea', 'Fontaine', 'lea.fontaine@client.com', '0485000007'),    -- 7
('Thomas', 'Rousseau', 'thomas.rousseau@client.com', '0485000008'), -- 8
('Manon', 'Blanc', 'manon.blanc@client.com', '0485000009'),      -- 9
('Antoine', 'Gillet', 'antoine.gillet@client.com', '0485000010'); -- 10

-- =========================
-- DEVICES
-- =========================
insert into devices (model, serial_number, brand, type_id, client_id, submission_date, retrieve_date) values
('Latitude 5510', 'SN-LAP-0001', 'Dell',      1, 1, '2026-01-05 09:15:00', null),
('ThinkPad T14', 'SN-LAP-0002', 'Lenovo',    1, 2, '2026-01-06 10:30:00', '2026-01-10 16:00:00'),
('EliteDesk 800', 'SN-PC-0001', 'HP',        2, 3, '2026-01-07 14:20:00', null),
('OptiPlex 7090', 'SN-PC-0002', 'Dell',      2, 4, '2026-01-08 11:05:00', null),
('LaserJet Pro M404', 'SN-IMP-0001', 'HP',   3, 5, '2026-01-09 13:40:00', null),
('EcoTank ET-2850', 'SN-IMP-0002', 'Epson',  3, 6, '2026-01-10 09:00:00', '2026-01-15 15:30:00'),
('PowerEdge R540', 'SN-SRV-0001', 'Dell',    4, 7, '2026-01-11 08:50:00', null),
('ThinkServer TS460', 'SN-SRV-0002', 'Lenovo',4, 8, '2026-01-12 16:10:00', null),
('iPad 9e gen', 'SN-TAB-0001', 'Apple',      5, 9, '2026-01-13 10:00:00', null),
('Galaxy Tab S7', 'SN-TAB-0002', 'Samsung',  5,10, '2026-01-14 15:45:00', null);

-- =========================
-- TICKETS (10 tickets)
-- =========================
insert into tickets (ticket_number, client_id, device_id, status_id, priority_id, created_by) values
('TCK-2026-0001', 1, 1, 1, 3, 2), -- En attente, Haute, créé par Team Leader (id 2)
('TCK-2026-0002', 2, 2, 2, 2, 3), -- En cours, Moyenne, créé par Tech (id 3)
('TCK-2026-0003', 3, 3, 2, 3, 7), -- En cours, Haute, créé par Team Leader (7)
('TCK-2026-0004', 4, 4, 1, 1, 5), -- En attente, Faible, créé par Tech (5)
('TCK-2026-0005', 5, 5, 5, 2, 1), -- Résolu, Moyenne, créé par Superviseur (1)
('TCK-2026-0006', 6, 6, 3, 2, 4), -- Réattribuer, Moyenne, créé par Tech (4)
('TCK-2026-0007', 7, 7, 2, 3, 8), -- En cours, Haute, créé par Team Leader (8)
('TCK-2026-0008', 8, 8, 4, 1, 9), -- Annulé, Faible, créé par Superviseur (9)
('TCK-2026-0009', 9, 9, 1, 2, 6), -- En attente, Moyenne, créé par Tech (6)
('TCK-2026-0010',10,10,5, 3,10);  -- Résolu, Haute, créé par Tech (10)

-- =========================
-- INTERVENTIONS
-- 2 à 3 interventions par ticket
-- =========================
insert into intervention (ticket_id, user_id, start_at, end_at) values
-- Ticket 1
(1, 3,  '2026-01-05 10:00:00', '2026-01-05 11:00:00'),
(1, 4,  '2026-01-05 11:30:00', '2026-01-05 12:15:00'),

-- Ticket 2
(2, 3,  '2026-01-06 11:00:00', '2026-01-06 12:00:00'),
(2, 5,  '2026-01-06 14:00:00', '2026-01-06 15:00:00'),
(2, 7,  '2026-01-06 16:00:00', '2026-01-06 16:30:00'),

-- Ticket 3
(3, 4,  '2026-01-07 09:00:00', '2026-01-07 10:30:00'),
(3, 6,  '2026-01-07 11:00:00', '2026-01-07 12:00:00'),

-- Ticket 4
(4, 5,  '2026-01-08 09:15:00', '2026-01-08 10:00:00'),
(4, 10, '2026-01-08 10:30:00', '2026-01-08 11:10:00'),

-- Ticket 5
(5, 2,  '2026-01-09 08:30:00', '2026-01-09 09:15:00'),
(5, 3,  '2026-01-09 09:30:00', '2026-01-09 10:30:00'),
(5, 4,  '2026-01-09 11:00:00', '2026-01-09 11:45:00'),

-- Ticket 6
(6, 6,  '2026-01-10 13:00:00', '2026-01-10 14:00:00'),
(6, 7,  '2026-01-10 14:30:00', '2026-01-10 15:00:00'),

-- Ticket 7
(7, 8,  '2026-01-11 09:00:00', '2026-01-11 09:30:00'),
(7, 3,  '2026-01-11 10:00:00', '2026-01-11 11:00:00'),
(7, 5,  '2026-01-11 11:15:00', '2026-01-11 12:00:00'),

-- Ticket 8
(8, 9,  '2026-01-12 15:00:00', '2026-01-12 15:20:00'),
(8, 4,  '2026-01-12 15:30:00', '2026-01-12 16:00:00'),

-- Ticket 9
(9, 10, '2026-01-13 09:00:00', '2026-01-13 10:00:00'),
(9, 6,  '2026-01-13 10:15:00', '2026-01-13 11:00:00'),

-- Ticket 10
(10, 3, '2026-01-14 13:00:00', '2026-01-14 14:00:00'),
(10, 4, '2026-01-14 14:15:00', '2026-01-14 15:00:00'),
(10, 5, '2026-01-14 15:15:00', '2026-01-14 16:00:00');
