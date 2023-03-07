commande création de bdd 

créer une table bin/console doctrine:database:create

créer une entity php bin/console make:entity

repondre au question pour créer les champs de la table


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

## Enregistrement d'un nouveau Plan
```

```