# Dictionnaire de données

## Tâches (`tasks`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de notre tâche|
|title|VARCHAR(128)|NOT NULL|Le titre de la tâche|
|completion|TINYINT|NOT NULL, UNSIGNED, DEFAULT 0|Le pourcentage de completion de la tâche|
|status|TINYINT|NOT NULL, DEFAULT 1|Le statut de la tâche (1=active, 2=archivée)|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la tâche|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de la tâche|
|category_id|INT|NOT NULL, UNSIGNED|FK - Identifiant de la catégorie de la tâche|

## Catégories (`categories`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de notre catégorie|
|name|VARCHAR(64)|NOT NULL|Le nom de la catégorie|
|status|TINYINT|NOT NULL, DEFAULT 1|Le statut de la catégorie (1=active, 2=désactivée)|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la catégorie|
|updated_at|TIMESTAMP|NULL|La date de la dernière mise à jour de la catégorie|
