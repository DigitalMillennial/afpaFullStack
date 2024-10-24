-- 1. Каков состав команды Festina (номер, имя и страна гонщиков)?
-- Мы выбираем id гонщика (номер), его имя и страну, к которой он принадлежит.
-- Для этого объединяем таблицы COUREUR, EQUIPE и PAYS.
SELECT 
    COUREUR.id AS NumCoureur, -- Номер гонщика
    COUREUR.NomCoureur,       -- Имя гонщика
    PAYS.NomPays              -- Название страны
FROM 
    COUREUR
    JOIN EQUIPE ON COUREUR.id_Equipe = EQUIPE.id -- Соединяем с таблицей команд по id команды
    JOIN PAYS ON COUREUR.id_Pays = PAYS.id       -- Соединяем с таблицей стран по id страны
WHERE 
    EQUIPE.NomEquipe = 'Festina'; -- Условие, чтобы выбрать только гонщиков команды Festina


-- 2. Каково общее количество километров в Тур де Франс 1997 года?
-- Мы суммируем все километры этапов, которые прошли в 1997 году.
-- Для этого используем функцию SUM() и фильтруем по году в столбце DateEtape.
SELECT 
    SUM(NbKm) AS total_kilometres -- Суммируем все километры (NbKm)
FROM 
    ETAPE
WHERE 
    YEAR(DateEtape) = 1997;       -- Фильтруем по этапам, которые прошли в 1997 году


-- 3. Каково общее количество километров этапов типа "Высокая гора"?
-- Мы выбираем и суммируем километры этапов, которые относятся к типу "Haute Montagne".
-- Для этого соединяем таблицы ETAPE и TYPE_ETAPE.
SELECT 
    SUM(ETAPE.NbKm) AS total_kilometres_haute_montagne -- Суммируем километры для этапов типа "Haute Montagne"
FROM 
    ETAPE
    JOIN TYPE_ETAPE ON ETAPE.id_Type_Etape = TYPE_ETAPE.id -- Соединяем этапы с их типами по id типа
WHERE 
    TYPE_ETAPE.LibelléType = 'Haute Montagne'; -- Фильтруем только этапы типа "Высокая гора"


-- 4. Каков общий рейтинг гонщиков (имя, код команды, код страны и время гонщиков)?
-- Мы получаем имена гонщиков, их командный код, код страны и общее время, которое они провели на этапах.
-- Соединяем таблицы COUREUR, PARTICIPER, EQUIPE и PAYS, группируем результаты и сортируем по времени.
SELECT 
    COUREUR.NomCoureur,         -- Имя гонщика
    EQUIPE.id AS CodeEquipe,    -- Код команды (id команды)
    PAYS.id AS CodePays,        -- Код страны (id страны)
    SUM(PARTICIPER.TempsRéalisé) AS TempsTotal -- Суммируем время гонщика на всех этапах
FROM 
    COUREUR
    JOIN PARTICIPER ON COUREUR.id = PARTICIPER.id_Coureur -- Соединяем COUREUR и PARTICIPER по id гонщика
    JOIN EQUIPE ON COUREUR.id_Equipe = EQUIPE.id          -- Соединяем COUREUR с EQUIPE, чтобы получить команду гонщика
    JOIN PAYS ON COUREUR.id_Pays = PAYS.id                -- Соединяем COUREUR с PAYS, чтобы получить страну гонщика
GROUP BY 
    COUREUR.id, EQUIPE.id, PAYS.id -- Группируем по гонщику, команде и стране
ORDER BY 
    TempsTotal ASC; -- Сортируем по времени, чтобы гонщики с наименьшим временем шли первыми
