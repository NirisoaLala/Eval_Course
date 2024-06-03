SELECT idetape, etape, idcategorie, categorie, idequipe, equipe, idcoureur, nom, duree, parti, DENSE_RANK() OVER (PARTITION BY idetape, idcategorie ORDER BY parti, duree) AS rang
FROM v_coureur_categorie where idetape = 1 and idcategorie = 2
ORDER BY idetape, idcategorie, rang;

SELECT idetape, etape, idcategorie, categorie, idequipe, equipe, idcoureur, nom, duree, parti
FROM v_coureur_categorie;
ORDER BY idcategorie, rang;

select cc.idcategorie, c.nom as categorie, vce.idequipe, vce.equipe, vce.idcoureur, vce.nom, vce.duree, vce.parti
from v_coureur_etape vce
join coureur_categorie cc on vce.idcoureur = cc.idcoureur
join categorie c on cc.idcategorie = c.id;

select idequipe, idetape, count(idetape) as coureur, nbre_coureur
from v_coureur_etape
group by idequipe, idetape, nbre_coureur;

insert into coureur_etape(idetape, idcoureur, heure_depart, heure_arrivee)
select e.id as idetape, c.id as idcoureur, to_timestamp(e.date_course || ' ' || e.heure_depart, 'YYYY-MM-DD HH24:MI:SS') AS depart, r.arrivee
from resultat r
join etape e on r.etape_rang = e.rang
join coureur c on r.nom = c.nom;

insert into point_etape(rang, point)
select classement, points
from temp_points;

insert into coureur(nom, num_dossard, genre, dtn, idequipe)
select distinct r.nom, r.num_dossard, g.id as idgenre, r.dtn, e.id as idequipe
from resultat r
join genre g on r.genre = g.nom
join equipe e on r.equipe = e.nom;

ALTER TABLE equipe ALTER COLUMN mdp SET DEFAULT '123';

insert into equipe(nom, pseudo)
select distinct equipe, equipe as pseudo
from resultat;

insert into etape(nom, longueur, nbre_coureur, rang, date_course, heure_depart)
select etape, longueur, nbre_coureur, rang, date_depart, heure_depart
from temp_etape;

alter table etape add column date_course date default current_date;

select idequipe, equipe, sum(point) as totalpoint, RANK() OVER (PARTITION BY idequipe ORDER BY sum(point)) AS rang
from v_etape_classement_point
group by idequipe, equipe;

select vec.idetape, vec.idequipe, vec.equipe, vec.idcoureur, vec.nom, vec.num_dossard, vec.genre, vec.nomgenre, vec.heure_depart, vec.heure_arrivee, vec.duree, vec.rang, coalesce(pe.point, 0) as point
from v_etape_classement vec
left join point_etape pe on vec.rang = pe.rang;

select ce.idetape, c.idequipe, e.nom as equipe, ce.idcoureur, c.nom, c.num_dossard, c.genre, 
    CASE 
        WHEN c.genre = 1 THEN 'Homme' 
        WHEN c.genre = 2 THEN 'Femme' 
        ELSE 'non spécifié' 
    END AS nomgenre, ce.heure_depart, ce.heure_arrivee, (ce.heure_arrivee - ce.heure_depart) as duree
from coureur_etape ce
join coureur c on ce.idcoureur = c.id
join equipe e on c.idequipe = e.id;

drop view v_equipe_classement;
drop view v_etape_classement_point;
drop view v_etape_classement;
drop view v_coureur_etape;

truncate temp_points restart identity;
truncate resultat restart identity;
truncate temp_etape restart identity;
truncate point_etape restart identity;
truncate coureur_etape restart identity;
truncate coureur_categorie restart identity;
truncate coureur restart identity;
truncate categorie restart identity;
truncate etape restart identity;
truncate equipe restart identity;
truncate admin restart identity;

drop table point_etape;
drop table coureur_etape;
drop table coureur_categorie;
drop table coureur;
drop table categorie;
drop table etape;
drop table equipe;
drop table admin;