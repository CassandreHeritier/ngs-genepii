# Base de données - séquençage NGS de Sars-CoV-2

<p align="center">
    <img src="images/genepii.png" width="300" height="150" />
    <img src="images/hcl.jpg" width="100" height="100" />
    <img src="images/laravel.png" width="300" height="110" />
</p>

## Description
Ce projet a pour but de stocker et de manipuler des données de séquençage du *Sars-CoV-2* déjà existantes dans une base de données SQL, et faciliter l'insertion de futures données dans la base à l'aide de scripts Python et qui peut se faire facilement depuis une interface web programmée avec Laravel.

Se trouvent dans ce dépôt git :

- Un fichier de définition Singularity *ngs.def* qui permet de construire l'image (et *debian-ngs.def* pour mettre sous Debian plus tard)
- L'application Laravel, c'est le dossier *genepii-app* qui contient un dossier *src* avec :
    - Un dossier *emergen* avec :
        - Un script R *emergen_compare.R* qui permet de comparer le format EMERGEN fonctionnel (utilisé actuellement) avec le format sorti par la librairie Python (en développement)
    - Un package Python fait maison *package_genepii* qui contient :
        - Un README avec toute la documentation et l'aide à l'utilisation du package 
        - Un dossier *corres* avec toutes les correspondances de noms et de formats (cf. README du package)
        - Un dossier *log* avec : 
            - *sql_statements.log* : contient toutes les dernières requêtes SQL effectuées
            - *errors.log*
        - *main.py* qui est le seul script a être exécuté
        - Un fichier de configuration *settings.json*
        - Les autres dossiers concernent la librairie Python elle-même (cf. README du package)

## Requis
Pour développer l'application il est nécessaire d'avoir un environnement Linux ou une machine virtuelle avec Linux où est installé LAMP, phpMyAdmin et Laravel (avec Composer).

## Installation projet
Clôner ce dépôt git :
```bash=
git clone https://github.com/CassandreHeritier/db-ngs.git
```
Exporter les variables d'environnement pour accéder au réseau HCL :

```bash=
export http_proxy=http://ge91097.chu-lyon.fr:8888/ && sudo -E bash -c 'echo $http_proxy'
export https_proxy=http://ge91097.chu-lyon.fr:8888/ && sudo -E bash -c 'echo $https_proxy'
```

Construire l'image Singularity depuis le fichier de définition :
```bash=
sudo -E singularity build ngs.sif ngs.def
```

Une fois l'image construite, accéder en shell en montant les parties nécessaires :
```bash=
sudo -E singularity --bind /data/genepi:/mnt ngs.def
```

*Pour le moment nous développons en sandbox donc les deux dernières commandes deviennent :*
```bash=
sudo -E singularity build --sandbox ngs ngs.def
sudo -E singularity --writable --bind /data/genepi:/mnt ngs
```

Installer les dépendances et initier un fichier *.env* de configuration dans l'environnement Singularity :
```bash=
Singularity> cd /mnt/db-ngs/ngs-app/
Singularity> composer install
Singularity> cp .env.example .env
```

Éditer le fichier *.env* et modifier les valeurs relatives à la base de données pour les faire correspondre à MySQL configuré sur localhost, par exemple :
```php=
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ngs
DB_USERNAME=root
DB_PASSWORD=root
```
Lancer le serveur local :
```bash=
php artisan serve --host <ip>
```

## Versions:
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
