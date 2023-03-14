# BAP Plessis Robinsson

## Branch Setup
Pour setup votre branch, suivez ce qui suit :
```
git pull
git switch dev
git branch TonPrénom-dev
git switch TonPrénom-dev
```

## Project Setup
Pour éviter les conflits et avoir une bonne organisation, respectez bien ce qui suit :

-   Les images seront dans un dossier "images"
-   Les fichiers css seront dans un dossier "public/css" (Pour le bien de tout le monde on fera du scss avec une architecture 7-1)
-   Les fichiers js seront dans un dossier "public/js"
-   Les éléments html importable dans un dossier "public/layouts"

*Que ce soit en css ou en html, les fichiers qui seront importé dans d'autres commenceront par un "_"*

### L'architecture 7-1
-   Un dossier "base" contenant le css qui s'applique à la racine (le reset avec "* {} etc")
-   Un dossier "components" contenant le css des composants (bouton, cart, input)
-   Un dossier "layouts" contenant le css des blocs importables (header, footer)
-   Un dossier "pages" contenant le css de chaque pages du site 
-   Un dossier "utils" pour les mixins
-   Un fichier output.scss qui compilera tous les fichiers scss
-   Un fichier style.css qui sera importé sur chaque page