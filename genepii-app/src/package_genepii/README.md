# Librairie Python Genepii NGS

## I. Objectifs
Cette librairie Python a pour objectif d'intéragir avec la base de données, c'est-à-dire de permettre :

- L'insertion de données automatique dans la base en donnant simplement un tableur Excel, CSV ou TSV en option de commande
- Les requêtes sur la base pour récupérer les informations souhaitées comme pour récupérer le format EMERGEN ou récupérer des données spécifiques

## II. Dépendances
Nous utilisons l'outil *Poetry* pour gérer la librairie et ses dépendances. Pour ajouter une dépendance, lancer la commande :
```bash=
poetry add <package-python>
```

## III. Options
Pour utilier cette librairie il faut renseigner une commande qui oriente l'utilisation du script **main.py** parmi :
- `file` pour insérer des données dans la base
- `emergen` pour récupérer un format EMERGEN
- `export` pour récupérer des données spécifiques
- `test` pour lancer des scripts de tests sur la base

Options associées à la commande `file`:
- `--input / -i` : chemin du fichier à insérer dans la base (formats acceptés : .csv, .xlsx, .xls)
- `--header / -d` : le numéro de ligne des en-têtes du tableur en input, où se trouvent les noms de colonnes. `1` par défaut
- `--db` : en spécifiant cette option, les données issues du fichier renseigné seront automatiquement insérées dans la base de données ou mises à jour. `False` par défaut.
- `--no_table` : permet de renseigner un nom de table SQL qui ne sera pas remplie avec les nouvelles données dans la base.

Options associées à la commande `emergen`:
- `--start-date / -a` : date de début de validation. `2021-01-01` par défaut.
- `--stop-date / -b` : date de fin de validation. `2023-01-01` par défaut.
Ces deux options servent à donner une période de temps sur les dates de validation pour déterminer les échantillons à récupérer depuis la base de données pour la soumission EMERGEN.
- `--samples / -s` : chemin vers un fichier texte contenant une liste de numéros de prélèvements pour lesquels on souhaite extraire les données de la base (format accepté pour le moment: .txt, avec un numéro par ligne, séparés par un retour chariot)

Options associées à la commande `export`:
- `--table` : table pour laquelle on souhaite extraire toutes les données (requis)
- `--list` : liste d'identifiants associée à une table donnée en argument pour lesquels on souhaite récupérer les données de la table à cette clé primaire

## IV. Insérer un fichier dans la base de données
Les types de fichiers qu'il est possible d'insérer dans la base sont :
- Tous les fichiers issus d'une extraction GLIMS (feuillets connus sous les noms de "Extraction", "Echantillon" et "Renseignements" par exemple)
- Les fichiers concernant l'extraction des prélèvements
- Les Samplesheets
- Les fichiers JSON de configuration de pipeline bioinformatique
- Les résultats d'analyse bioinformatique (connu sous le nom de ncov_validation)

Les fichiers à insérer doivent être au format Excel donc .xlsx ou .xls (recommandé sous Windows car le format CSV n'est pas toujours reconnu), CSV (UTF-8 dans ce cas, ou issu d'un système Linux directement), TSV ou JSON.

### Logique d'insertion
Voici la correspondance entre les informations brutes et les attributs SQL qui seront remplis selon ces informations :

![](https://i.imgur.com/0sk14PL.jpg)


### Exemple de commande :
```bash=
poetry run python3 main.py file -i /path/to/file.xslx -d 12 --db --no_table samples
```
- Option `-d` pour indiquer que la ligne des en-têtes est la 12e ligne du fichier (souvent pour un fichier GLIMS).
- Option `--db` pour indiquer qu'on souhaite insérer les données dans la base.
- Option `--no_table samples` pour indiquer qu'on souhaite insérer les données dans toutes les tables sauf la table "samples" de la base.

*Astuce : insérer dans l'ordre d'abord le fichier ECHANTILLON, puis EXTRACTION, puis RENSEIGNEMENTS pour avoir un maximum d'informations couvertes (il faut connaître les numéros de prélèvements avant de leur attribuer des dates d'enregistrement et autres, qui se trouvent dans le fichier EXTRACTION). Dans le doute, faire deux fois l'insertion des fichiers (cela fera une mise à jour).*

### Important
Quand on met à jour une table de la base en insérant de nouvelles données, celles-ci écraseront automatiquement les anciennes données présentes dans la base *(possibilité de modifier, voir donner une commande pour refuser l'écrasement pour une colonne donnée).* En revanche aucune donnée n'est écrasée par une valeur vide donc aucune perte de donnée n'est possible.

### Colonnes acceptées
Le fichier **FILE_DF_COLUMNS.csv** indique les noms de colonnes pris en compte et leur nom de correspondance dans la base de données ainsi que le nom de la méthode de formatage qui sera appliquée. Ce tableau est stocké sous forme de fichier CSV. C'est le seul endroit où il est nécessaire de modifier des noms de colonnes si on le souhaite (pour ajouter une colonne et ajouter sa correspondance dans la base de données il faut aussi modifier **DB_COLUMNS.csv**). Ces fichiers sont versionnés.

*Note : les colonnes ayant le même nom entre elles ne peuvent pas être reconnues, il est pour l'instant nécessaires de les numéroter à la main dans le fichier brut Excel pour les prendre en compte, et vérifier ou ajouter le nom dans FILE_DF_COLUMNS.csv. Exemple: "Seq SARS-CoV2 NG" et "Seq SARS-CoV2 NG2"*

### Tables SQL et leurs attributs
Les noms des tables et des colonnes SQL sont indiqués dans le fichier **DB_COLUMNS-0.0.1.csv**. La première ligne correspond aux noms de tables SQL, et on retrouve les attributs par table dans chaque colonne, comme le montre l'exemple ci-dessous.

![](https://i.imgur.com/wj31rFn.jpg)

### Ajouter une nouvelle colonne
Pour insérer une colonne dans tous le processus d'automatisation il faut :
- Ajouter le nom de la colonne Excel dans **FILE_DF_COLUMNS-0.0.1.csv** avec le nom souhaité associé qui sera dans la base (attribut SQL)
- Ajouter le nom du nouvel attribut dans **DB_COLUMNS-0.0.1.csv** associé à la bonne table donc la bonne colonne
- Du côté de l'application Laravel, il faut ajouter la colonne dans la migration de la table correspondante dans *app/database/migrations/create_nomtable_table.php*).
- Mettre à jour les fichiers Drive
    - Tables SQL
    - GLIMS-BDD
    - Choix de formatage
    - Le Mocodo pour l'architecture de la base

### Ajouter des formats ou des données à formater
Le fichier **FORMATS-0.0.1.csv** indique toutes les données type chaînes de caractère qui doivent être formatées. La première ligne indique la nouvelle valeur qui remplace n'importe quelle autre valeur indiquée en-dessous dans la colonne associée. Exemple : "Non renseigné" devient "NR".

*Remarque : il est pour l'instant obligatoire de le faire à la main et de repérer les éventuelles erreur saisies dans un fichier d'entrée. A voir pour améliorer.*

## V. Le format EMERGEN
Un des objectifs du script est aussi de récupérer des données qui devront être soumises dans la base EMERGEN, ce qui nécessite de les formater au format spécifique imposé par EMERGEN.

### Exemples de commandes
Pour cela voici un exemple de commande, qui récupère ici toutes les données sans contraintes de dates de validation :
```bash=
poetry run python3 main.py emergen
```

En récupérant les données issues de prélèvements qui ont été validés entre le 20 mars 2022 et le 20 avril 2022 (au format YYYY-MM-DD) :
```bash=
poetry run python3 main.py emergen -a '2022-03-20' -b '2022-04-20'
```

En donnant une liste de numéros de prélèvements dans un fichier texte :
```bash=
poetry run python3 main.py emergen -s '/path/to/samples.txt'
```
## VI. Exporter des données
Les données sont exportées au format Excel dans le dossier de stockage des ressources de Laravel *genepii-app/storage/app/public/outputs/exported_data.xlsx*.

### Exemples de commandes
Exporter toute une table SQL :
```bash=
poetry run python3 main.py export --table patients
```
Exporter une partie de la table en donnant des identifiants (15 et 33 ici) :
```bash=
poetry run python3 main.py export --ids 15 33 --table patients
```

## VII. Guide des erreurs
1. Erreur :
`Incorrect number of column names compared to the number of columns: please check the DB_COLUMNS_NAMES.csv file with the SQL tables.`
Si ce message apparaît, c'est qu'il y a un surplus de colonnes à insérer par rapport aux colonnes SQL existantes. Pour cela il faut vérifier que le fichier DB_COLUMNS_NAMES contient bien tous les noms de colonnes existantes. Souvent le problème vient du fait qu'il manque "updated_at" dans les noms de colonnes, car ces données sont mises à jour à chaque réinsertion de données, il est donc impératif de renseigner ce nom aussi.

## VIII. Maintien et modification du script
### Pour implémenter un identifiant unique en fonction de colonnes existantes
Par exemple, actuellement l'id patient est unique en fonction du nom, prénom, date de naissance. Ici, trois colonnes sont prises en compte pour caractériser un patient dans la base, c'est-à-dire que si on tombe sur ce même trio d'informations dans un fichier, l'id crypté sera récupéré depuis la base car il sera déjà existant. Il est possible de modifier les colonnes sur lesquelles se baser dans les méthodes de créations d'id dans le script `create.py` du set d'outils de `format`.

## IX. Fichiers de correspondances
- **AUTO_IDS-0.0.1.csv** : Renseigne sur les clés primaires SQL à auto-incrémenter ou non par des booléens.
- **CHOICE_COLUMNS-0.0.1.csv** : Donne les noms de colonnes du DataFrame à formater selon un modèle à choix, avec YES, NO ou ND pour Not Documented.
- **FILE_DF_COLUMNS-0.0.1.csv** : Fait la correspondance entre les noms de colonnes des fichiers bruts avec les noms de colonnes du DataFrame qui sert ensuite à remplir les attributs SQL souvent du même nom, et la méthode à appliquer à chaque colonne pour le formatage.
- **EMERGEN-0.0.1.csv** : Fait la correspondance entre les noms de colonnes SQL (donc du DataFrame) avec ceux des colonnes à créer en sortie pour le format EMERGEN.
- **FORMATS-0.0.1.csv** : Fait la correspondance entre les valeurs brutes rencontrées lors du formatage avec des valeurs “propres” qui vont les remplacer comme pour homogénéiser les noms des vaccins.
- **SERIOUS_CASES-0.0.1.csv** : Fait correspondre les noms des services aux HCL qui traitent des cas graves de patients (service de réanimation par exemple) afin de déterminer les patients “cas graves”.
- **DB_COLUMNS-0.0.1.csv** : Fait correspondre les noms des colonnes de la base avec leurs table SQL respectives (une colonne = une table et ses attributs SQL).
- **REQUIRED-0.0.1.csv** : Détermine les colonnes (= attributs SQL) requis pour insérer dans la table correspondante (nom de la colonne). Par exemple, sans la clé primaire et une certaine clé secondaire, on choisit de ne pas insérer dans la table concernée, si c’est inutile ou qu’il n’y a pas de clé primaire.
- **SENDER_LABS-0.0.1.csv** : Permet de formater des noms de laboratoires expéditeurs rencontrés en homogénéisant certains noms. Par exemple, "CDP ADOMA GIVORS" devient "CH GIVORS" selon une liste de l’équipe.

## X. Versions
- Python 3.10.4
- Apache 2.4.52
- PHP 8.1.5
- phpMyAdmin 5.1.3
- Laravel 9.11.0
- Composer 2.3.5
- MySQL 8.0.28
- Singularity 3.8.4
- Node.JS 12.22.9

### Auteurs
Cassandre Héritier--Tellier