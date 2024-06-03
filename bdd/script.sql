-- create database course;
-- \c course

create database course_eval;
\c course_eval

create table admin(
    id serial primary key,
    nom varchar(200),
    email varchar(200),
    mdp varchar(100)
);

create table equipe(
    id serial primary key,
    nom varchar(200),
    pseudo varchar(200),
    mdp varchar(100)
);

create table etape(
    id serial primary key,
    nom varchar(200),
    longueur double precision default 0,
    nbre_coureur int default 0,
    rang int default 1,
    date_course date default current_date,
    heure_depart time default '00:00:00'
);

create table categorie(
    id serial primary key,
    nom varchar(200)
);

create table genre(
    id serial primary key,
    nom varchar(100)
);

create table coureur(
    id serial primary key,
    nom varchar(200),
    num_dossard int,
    genre int, 
    dtn date,
    idequipe int references equipe(id)
);

create table coureur_categorie(
    id serial primary key,
    idcoureur int references coureur(id),
    idcategorie int references categorie(id)
);

create table coureur_etape(
    id serial primary key,
    idetape int references etape(id),
    idcoureur int references coureur(id),
    heure_depart timestamp default current_timestamp,
    heure_arrivee timestamp default current_timestamp
);

create table point_etape(
    id serial primary key,
    rang int,
    point double precision default 0
);

-- IMPORT
create table temp_points(
    classement int,
    points int
);

create table temp_etape(
    etape varchar(200),
    longueur double precision,
    nbre_coureur int,
    rang int,
    date_depart date,
    heure_depart time
);

create table resultat(
    etape_rang int,
    num_dossard int,
    nom varchar(200),
    genre varchar(100),
    dtn date,
    equipe varchar(100),
    arrivee timestamp
);

-----------------------------------------------------------------------------------------------------------------------------------------
create or replace view v_coureur_etape as
select ce.idetape, c.idequipe, e.nom as equipe, ce.idcoureur, c.nom, c.num_dossard, c.genre, 
    CASE 
        WHEN c.genre = 1 THEN 'Homme' 
        WHEN c.genre = 2 THEN 'Femme' 
        ELSE 'non spécifié' 
    END AS nomgenre
from coureur_etape ce
join coureur c on ce.idcoureur = c.id
join equipe e on c.idequipe = e.id;

create or replace view v_coureur_etape as
select ce.idetape, c.idequipe, e.nom as equipe, ce.idcoureur, c.nom, c.num_dossard, c.genre, 
    CASE 
        WHEN c.genre = 1 THEN 'Homme' 
        WHEN c.genre = 2 THEN 'Femme' 
        ELSE 'non spécifié' 
    END AS nomgenre, ce.heure_depart, ce.heure_arrivee
from coureur_etape ce
join coureur c on ce.idcoureur = c.id
join equipe e on c.idequipe = e.id;
-----------------------------------------------------------------------------------------------------------------------------------------

create or replace view v_coureur_etape as
select ce.idetape, et.nom as etape, et.rang as rang_etape, c.idequipe, e.nom as equipe, ce.idcoureur, c.nom, c.num_dossard, c.genre, 
    CASE 
        WHEN c.genre = 1 THEN 'Homme' 
        WHEN c.genre = 2 THEN 'Femme' 
        ELSE 'non spécifié' 
    END AS nomgenre, ce.heure_depart, ce.heure_arrivee, (ce.heure_arrivee - ce.heure_depart) as duree, et.longueur, et.nbre_coureur
from coureur_etape ce
join coureur c on ce.idcoureur = c.id
join equipe e on c.idequipe = e.id
join etape et on ce.idetape = et.id;

create or replace view v_coureur_etape as
select ce.idetape, et.nom as etape, et.rang as rang_etape, et.longueur, et.nbre_coureur, c.idequipe, e.nom as equipe, ce.idcoureur, c.nom, c.num_dossard, c.genre, 
    CASE 
        WHEN c.genre = 1 THEN 'Homme' 
        WHEN c.genre = 2 THEN 'Femme' 
        ELSE 'non spécifié' 
    END AS nomgenre, ce.heure_depart, ce.heure_arrivee, (ce.heure_arrivee - ce.heure_depart) as duree
from coureur_etape ce
join coureur c on ce.idcoureur = c.id
join equipe e on c.idequipe = e.id
join etape et on ce.idetape = et.id;

create or replace view v_coureur_etape as
select ce.idetape, et.nom as etape, et.rang as rang_etape, c.idequipe, e.nom as equipe, ce.idcoureur, c.nom, c.num_dossard, c.genre, 
    CASE 
        WHEN c.genre = 1 THEN 'Homme' 
        WHEN c.genre = 2 THEN 'Femme' 
        ELSE 'non spécifié' 
    END AS nomgenre, ce.heure_depart, ce.heure_arrivee, (ce.heure_arrivee - ce.heure_depart) as duree, et.longueur, et.nbre_coureur,
    CASE 
        WHEN (ce.heure_arrivee - ce.heure_depart) = '00:00:00' THEN 1 
        ELSE 0
    END AS parti
from coureur_etape ce
join coureur c on ce.idcoureur = c.id
join equipe e on c.idequipe = e.id
join etape et on ce.idetape = et.id;

create or replace view v_etape_classement as
SELECT idetape, etape, rang_etape, idequipe, equipe, idcoureur, nom, num_dossard, genre, nomgenre, duree, parti, DENSE_RANK() OVER (PARTITION BY idetape ORDER BY parti, duree) AS rang
FROM v_coureur_etape
ORDER BY idetape, rang;

create or replace view v_etape_classement_point as
select vec.idetape, vec.etape, vec.rang_etape, vec.idequipe, vec.equipe, vec.idcoureur, vec.nom, vec.num_dossard, vec.genre, vec.nomgenre, vec.duree, vec.rang, coalesce(pe.point, 0) as point
from v_etape_classement vec
left join point_etape pe on vec.rang = pe.rang
ORDER by vec.idetape, vec.rang;

create or replace view v_equipe_classement as
select idequipe, equipe, sum(point) as totalpoint, DENSE_RANK() OVER (ORDER BY sum(point) DESC) AS rang
from v_etape_classement_point
group by idequipe, equipe;

create or replace view v_count_coureur_etape as
select idequipe, idetape, count(idetape) as coureur, nbre_coureur
from v_coureur_etape
group by idequipe, idetape, nbre_coureur;


create or replace view v_coureur_categorie as
select vce.idetape, vce.etape, cc.idcategorie, c.nom as categorie, vce.idequipe, vce.equipe, vce.idcoureur, vce.nom, vce.duree, vce.parti
from v_coureur_etape vce
join coureur_categorie cc on vce.idcoureur = cc.idcoureur
join categorie c on cc.idcategorie = c.id;

create or replace view v_etape_classement_categorie as
SELECT idetape, etape, idcategorie, categorie, idequipe, equipe, idcoureur, nom, duree, parti, DENSE_RANK() OVER (PARTITION BY idetape, idcategorie ORDER BY parti, duree) AS rang
FROM v_coureur_categorie
ORDER BY idetape, idcategorie, rang;

create or replace view v_etape_classement_categorie_point as
select vecc.idetape, vecc.etape, vecc.idcategorie, vecc.categorie, vecc.idequipe, vecc.equipe, vecc.idcoureur, vecc.nom, vecc.duree, vecc.rang, coalesce(pe.point, 0) as point
from v_etape_classement_categorie vecc 
left join point_etape pe on vecc.rang = pe.rang
ORDER by vecc.idetape, vecc.idcategorie, vecc.rang;

create or replace view v_equipe_classement_categorie as
select idcategorie, categorie, idequipe, equipe, sum(point) as totalpoint, DENSE_RANK() OVER (PARTITION BY idcategorie ORDER BY sum(point) DESC) AS rang
from v_etape_classement_categorie_point
group by idcategorie, categorie, idequipe, equipe;