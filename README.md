#Projet Game design pour un salon virtuel LocalHost

########################################################### Procedure d'installation LocalHost ########################################################################

1. Télécharger tout le git, de la branche main.

2. METTRE EN PLACE LA BDD :
    - Installer Wampserver : https://www.wampserver.com/
    - Lancer Wampserver (check que tous les services soit actif).
    - Mettre le dossier du projet dans le dossier www : C:\Wamp\www
    - Aller sur l'icone de wamp en bas à droit et cliquer sur PhpMyAdmin, entre l'utilisateur root sans mot de passe, puis executer.
    - Verifier que le server courant (en gaut a gauche en dessous du logo PhpMyAdmin) soit bien MySQL et non MariaBD.
    - Aller dans l'onglet importer (situer dans le menu en haut) -> Choisir un fichier -> selectionner le fichier salonvirtuel.sql
    - Pour vous ajouter en tant qu'admin du site, entre la requete suivante dans la table superadmin (dans l'onglet SQL) en remplacent "votre mail" et "votre mdp" par le mail et le mdp que vous désirez : 
    INSERT INTO superadmin(mailSuperAdmin, mdpSuperAdmin) VALUES ("votre mail","votre mdp")
    - Executer la requete.

3. METTRE EN PLACE LE LOGCIEL D'ENVOIE DE MAIL (EN LOCALHOST) :
    - Suivre les 5 premières minuites du tuto : https://www.youtube.com/watch?v=c4C0LXmSHhE
    /!\ ATTENTION /!\ utiliser l'adresse mail suivante : 
        -> equipeverte1@gmail.com
        -> Verte09*
    - Faite attention de bien avoir crée un super admin (étape précedente) sinon l'envoie de mail ne pourra pas fonctionner correctement.

4. ACCEDER AU SITE :
    - Aller sur l'icone de wamp en bas à droit et cliquer sur localhost, ca vous redirigera vers votre navigateur, acceder au dossier du projet via le path, exemple de path : http://localhost/projetsalon/central.php
########################################################### Procedure d'installation LocalHost ########################################################################https://discord.com/channels/@me/694177875263225929/783693851634171927
