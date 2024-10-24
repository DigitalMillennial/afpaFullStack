-- 1. Какое общее количество студентов?
-- Мы используем функцию COUNT() для подсчета всех записей в таблице ETUDIANT.
SELECT COUNT(*) AS nombre_etudiants
FROM ETUDIANT;

-- 2. Какие оценки среди всех являются самой высокой и самой низкой?
-- Для этого мы используем агрегатные функции MAX() и MIN() для нахождения максимальной и минимальной оценки соответственно.
SELECT MAX(Note) AS note_maximale, MIN(Note) AS note_minimale
FROM EVALUER;

-- 3. Каковы средние баллы каждого студента по каждой дисциплине?
-- Чтобы найти средний балл для каждого студента по каждой дисциплине, используем AVG() с группировкой по студенту и предмету.
SELECT id_Etudiant, id_Matiere, AVG(Note) AS moyenne
FROM EVALUER
GROUP BY id_Etudiant, id_Matiere;

-- 4. Каковы средние баллы по каждой дисциплине?
-- Здесь мы группируем по id_Matiere (предмет), чтобы получить среднюю оценку по каждому предмету.
SELECT id_Matiere, AVG(Note) AS moyenne_matiere
FROM EVALUER
GROUP BY id_Matiere;

-- 5. Какова общая средняя оценка каждого студента?
-- Чтобы вычислить общую среднюю оценку для каждого студента, мы группируем по id_Etudiant и используем AVG().
SELECT id_Etudiant, AVG(Note) AS moyenne_generale
FROM EVALUER
GROUP BY id_Etudiant;

-- 6. Какова общая средняя оценка всей группы (промоции)?
-- Здесь мы просто находим среднее значение всех оценок студентов.
SELECT AVG(Note) AS moyenne_generale_promotion
FROM EVALUER;

-- 7. Какие студенты имеют общую среднюю оценку, равную или превышающую среднюю оценку всей группы?
-- Сначала мы находим среднюю оценку по группе в подзапросе, затем выбираем студентов, у которых средняя оценка равна или больше этого значения.
SELECT id_Etudiant
FROM EVALUER
GROUP BY id_Etudiant
HAVING AVG(Note) >= (
    SELECT AVG(Note)
    FROM EVALUER
);
