insert into admin(nom, email, mdp) values
    ('John Doe', 'john@example.com', '123'),
    ('Jane Smith', 'jane@example.com', '456'),
    ('Alice Johnson', 'alice@example.com', '789'),
    ('Bob Brown', 'bob@example.com', '1234'),
    ('Charlie Davis', 'charlie@example.com', '5678');

insert into equipe(nom, pseudo, mdp) values
    ('Equipe A', 'a_team', '123'),
    ('Equipe B', 'b_team', '456'),
    ('Equipe C', 'c_team', '789'),
    ('Equipe D', 'd_team', '1234'),
    ('Equipe E', 'e_team', '5678');

insert into categorie(nom) values ('Homme'), ('Femme'), ('Junior');

insert into etape(nom, longueur, nbre_coureur, rang, date_course, heure_depart) values
    ('Betsizaraina', 120.5, 2, 1, '2024-05-31', '12:00:00'),
    ('Ampasibe', 98.7, 1, 2, '2024-06-01', '13:00:00');

insert into genre(nom) values ('M'), ('F');

insert into coureur(nom, num_dossard, genre, dtn, idequipe) values
    ('Pierre Martin', 101, 1, '2000-05-15', 1),
    ('Sophie Dupont', 102, 2, '1999-05-16', 2),
    ('Lucas Dubois', 103, 1, '1997-05-17', 1),
    ('Marie Leroy', 104, 2, '1998-05-18', 2),
    ('Thomas Petit', 105, 1, '2000-05-19', 2);

insert into point_etape(rang, point) values
    (1, 10), (2, 6), (3, 4), (4, 2), (5, 1);