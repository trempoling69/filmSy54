## commande création de bdd 
```
créer une table bin/console doctrine:database:create

créer une entity php bin/console make:entity

repondre au question pour créer les champs de la table
```

## Migration
```
Créer : Php bin/console make:migration
Exécuter : php bin/console doctrine:migrations:migrate
```

## modifier une entity
```
php bin/console make:entity nomentity
puis migration
```

## modifier une entity par le code 
```
Modifier ce qu'on veut dans le code
mettre à jour le modèle php bin/console make:entity --regenerate App/Entity/Plan
Puis make:migration et migrate
```

## Créer un controller
```
symfony console make:controller nomController
```

## Enregistrement d'une clé étrangère
```
php bin/console make:entity nomtableouajouter
ajouter d'un nouveau field 
type : relation
classe avec laquelle faire la relation
type de lien
add new property? ajouter la clé aussi à l'autre table
si oui lui donner un nom 
puis faire toute la migration
```

## CRUD
```
- Créer une entité
- faire migration
- Créer un controller
- Fonction toString
- Créer un formulaire
- Créer un template
```
