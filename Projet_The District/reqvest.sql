--Отображение списка заказов (в списке должна быть указана дата, информация о клиенте, блюдо и цена)

SELECT c.date_commande,c.nom_client,c.telephone_client,c.email_client,c.adresse_client,p.libelle,p.prix 
FROM commande c 
left join plat p on p.id = c.id_plat 

--Показать список блюд, указав категорию

SELECT 
    p.libelle AS plat_name,       
    cat.libelle AS categorie_name 
FROM plat p
JOIN categorie cat ON p.id_categorie = cat.id   
ORDER BY cat.libelle, p.libelle; 


--Показать категории и количество активных блюд в каждой категории.

SELECT 
    cat.libelle AS categorie_name,    
    COUNT(p.libelle) AS Quantite      
FROM categorie cat
LEFT JOIN plat p ON p.id_categorie = cat.id AND p.active = "yes" 
GROUP BY cat.libelle;  

--Список самых продаваемых блюд в порядке убывания.

SELECT 
    p.libelle AS plat_name,        
    SUM(c.quantite) AS total_sales 
FROM commande c
JOIN plat p ON c.id_plat = p.id    
GROUP BY p.id                       
ORDER BY total_sales DESC;  

--Самое прибыльное блюдо

SELECT 
    p.libelle AS plat_name,              
    SUM(c.quantite * p.prix) AS total_profit
FROM commande c
JOIN plat p ON c.id_plat = p.id          
GROUP BY p.id                             
ORDER BY total_profit DESC                
LIMIT 1;                                  
 
--Список клиентов и доход, полученный на каждого клиента (в порядке убывания)

SELECT 
    nom_client,                         
    telephone_client,                   
    email_client,                      
    SUM(quantite * p.prix) AS total_income 
FROM commande c
JOIN plat p ON c.id_plat = p.id        
GROUP BY nom_client, telephone_client, email_client   
ORDER BY total_income DESC;            
              
--Написание запросов на изменение базы данных
-- 1.Написать запрос на удаление неактивных блюд из базы данных
SELECT * FROM plat WHERE active = 'no';
--2.Напишите запрос на удаление заказов со статусом доставки
DELETE FROM commande
WHERE etat = 'delivered';
--3.Напишите сценарий SQL, чтобы добавить новую категорию и блюдо в эту новую категорию.
INSERT INTO categorie (libelle, image, active)
VALUES ('Новая категория', 'image_url.jpg', 'yes');
SET @new_category_id = LAST_INSERT_ID();
INSERT INTO plat (libelle, description, prix, image, id_categorie, active)
VALUES ('Новое блюдо', 'Описание блюда', 100.00, 'dish_image.jpg', @new_category_id, 'yes');

