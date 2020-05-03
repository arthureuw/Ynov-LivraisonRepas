# Bigeat Api Symfony

> Entité : Restaurant

| Champ | Type | Commentaires |
|---|---|---|
| id | integer | Clé primaire |
| name | string | |
| created | date | Date de création de l'enregistrement, renseignée automatiquement à la création de l'enregistrement |
| rate | integer | Note sur 5 |
| menus | **Relation** | menus dans le restaurant | Many to One
| plats | **Relation** | plats dans le restaurant | Many to One

> Entité : Menu

| Champ | Type | Commentaires |
|---|---|---|
| id | integer | Clé primaire |
| name | string | |
| price | integer | Prix du Menu |
| plats | **Relation** | Listes des plats dans le menu | Many To Many
| restaurant | **Relation** | Restaurant contenant le menu | One to Many

> Entité : Plat

| Champ | Type | Commentaires |
|---|---|---|
| id | integer | Clé primaire |
| name | string | |
| price | integer | Prix du plat | 
| menus | **Relation** | Listes des menus contenant le plat | Many To Many
| restaurant | **Relation** | restaurant du plat | One to Many

> User : User

- Id
- Email
- LastName
- Firstname
- Password
- Balance
- Created date
- Last Connection
