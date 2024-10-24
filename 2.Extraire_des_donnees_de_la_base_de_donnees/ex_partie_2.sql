/************************* Exercices Requetes SQL **********************/

/* Rechercher le prénom des employés et le numéro de la région de leur département.*/

SELECT e.prenom, d.noregion
FROM employe e
INNER JOIN dept d ON e.nodep = d.nodept;

/*Rechercher le numéro du département, le nom du département, le
nom des employés classés par numéro de département (renommer les
tables utilisées).*/

SELECT d.nodept, d.nom, e.nom  FROM employe e
INNER JOIN dept d ON e.nodep = d.nodept
ORDER BY d.nodept;

/*Rechercher le nom des employés du département Distribution.*/

SELECT e.nom
FROM employe e
JOIN dept d ON e.nodep = d.nodept
WHERE d.nom = 'Distribution';


/*Rechercher le nom et le salaire des employés qui gagnent plus que
leur patron, et le nom et le salaire de leur patron.*/

SELECT 
    e.nom AS nom_employe,
    e.salaire AS salaire_employe,
    sup.nom AS nom_sup,
    sup.salaire AS salaire_sup
FROM 
    employe e
JOIN 
    employe sup ON e.nosup = sup.noemp
WHERE 
    e.salaire > sup.salaire;


/*Rechercher le nom et le titre des employés qui ont le même titre que
Amartakaldire.*/

SELECT 
    e.nom,
    e.titre
FROM 
    employe e
WHERE 
    e.titre IN (SELECT titre FROM employe WHERE nom = 'Amartakaldire');



/*Rechercher le nom, le salaire et le numéro de département des
employés qui gagnent plus qu'un seul employé du département 31,
classés par numéro de département et salaire.*/

SELECT e.nom, e.salaire, e.nodep 
FROM employe e
WHERE e.salaire > (SELECT MAX(salaire) FROM employe WHERE nodep = 31)
ORDER BY e.nodep, e.salaire;


/*Rechercher le nom, le salaire et le numéro de département des
employés qui gagnent plus que tous les employés du département 31,
classés par numéro de département et salaire.*/

SELECT e.nom, e.salaire, e.nodep 
FROM employe e
WHERE e.salaire > (SELECT MAX(salaire) FROM employe WHERE nodep = 31)
ORDER BY e.nodep,e.salaire;

/*Rechercher le nom et le titre des employés du service 31 qui ont un
titre que l'on trouve dans le département 32.*/

SELECT e.nom, e.titre 
FROM employe e
WHERE e.nodep = 31 
  AND e.titre IN (SELECT titre FROM employe WHERE nodep = 32);

/*Rechercher le nom et le titre des employés du service 31 qui ont un
titre l'on ne trouve pas dans le département 32.*/

SELECT e.nom, e.titre 
FROM employe e
WHERE e.nodep = 31 
  AND e.titre NOT IN(SELECT titre FROM employe WHERE nodep = 32);

/*Rechercher le nom, le titre et le salaire des employés qui ont le même
titre et le même salaire que Fairant.*/

SELECT e.nom, e.titre, e.salaire 
FROM employe e
WHERE (e.titre, e.salaire) = (
    SELECT titre, salaire 
    FROM employe 
    WHERE nom = 'Fairant'
);


/*Rechercher le numéro de département, le nom du département, le
nom des employés, en affichant aussi les départements dans lesquels
il n'y a personne, classés par numéro de département.*/

SELECT e.nodep, d.nom AS department_nom, e.nom AS employe_nom
FROM dept d
LEFT JOIN employe e ON d.nodept = e.nodep
ORDER BY d.nodept;

/*Exercice 1 - Calculer le nombre d'employés de chaque titre*/

SELECT titre, COUNT(*) AS nombre_employes
FROM employe
GROUP BY titre;


/*Exercice 2 - Calculer la moyenne des saaires et leur somme, par région*/

SELECT d.nom, AVG(e.salaire) AS moyenne_salaire, SUM(e.salaire) AS somme_salaire
FROM dept d
LEFT JOIN employe e ON d.nodept = e.nodep
GROUP BY d.nom;

/*Exercice 3 - Afficher les numéros des départements ayant au moins 3 employés.*/

SELECT e.nodep, COUNT(e.nom) AS employee_count
FROM employe e
GROUP BY e.nodep
HAVING COUNT(e.nom) >= 3;

/*Exercice 4 - Afficher les lettres qui sont l'initiale d'au moins trois employés.*/

SELECT inicial FROM 
(SELECT LEFT(nom,1) AS inicial FROM  employe 
UNION ALL
SELECT LEFT(prenom,1)AS inicial FROM  employe ) AS initials
GROUP BY inicial
HAVING COUNT(*) >= 3;

/*Exercice 5 - Rechercher le salaire maximum et le salaire minimum parmi tous les
salariés et l'écart entre les deux.*/

SELECT MAX(salaire) AS max_salaire, 
       MIN(salaire) AS min_salaire, 
       (MAX(salaire) - MIN(salaire)) AS ecart
FROM employe;

/*Exercice 6 - Rechercher le nombre de titres différents.*/

SELECT COUNT( DISTINCT titre) AS TOTAl
 FROM employe;

/*Exercice 7 - Pour chaque titre, compter le nombre d'employés possédant ce titre.*/

SELECT titre, COUNT(*) AS nombre_employes
FROM employe
GROUP BY titre;


/*Exercice 8 - Pour chaque nom de département, afficher le nom du département et
le nombre d'employés.*/

SELECT d.nom AS nom_departement, COUNT(*) AS nombre_employes
FROM dept d
LEFT JOIN employe e ON d.nodept = e.nodep
GROUP BY d.nom
LIMIT 0, 25;


/*Exercice 9 - Rechercher les titres et la moyenne des salaires par titre dont la
moyenne est supérieure à la moyenne des salaires des Représentants.*/

SELECT titre, AVG(salaire) AS moyenne_salaire
FROM employe
GROUP BY titre
HAVING AVG(salaire) > (SELECT AVG(salaire) FROM employe WHERE titre = 'Représentant');


/*Exercice 10 - Rechercher le nombre de salaires renseignés et le nombre de taux de
commission renseignés.*/

SELECT COUNT(salaire) AS nombre_salaires,
       COUNT(tauxcom) AS nombre_taux_commission
FROM employe;
