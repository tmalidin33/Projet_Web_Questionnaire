# projet_web

Réalisé par Maxime Fuchs, Thomas Malidin-Delabrière et Alix Moret.  
Ce projet est réalisé dans le cadre de nos études à l'IMT Lille Douai dans la majeur ISIC.  
La consigne était de créer une plateforme de questionnaires (création, réponses, résultats..)

### Fonctionnalités
Création d'un compte enseignant ou étudiant.

##### Création
Un enseignant peut créer un questionnaire avec questions déjà existantes ou des questions qu'il crée lui même.
Il peut viser un certain groupe de personne pour son questionnaire :

	* une promo
	* une demi promo
	* un groupe de td d'une promo
	* toutes les promos
Également, une date de début et de fin sont demandées. Un questionnaire dont la date de fin est dépassée ne pourra plus être répondu par un élève (même si l'on triche avec l'url).  

Une question peut être de quatre types différents : QCM, QCU, Libre, ou assignement.

#### Correction
Pour la correction, une réponse est soit juste, soit fausse. Un QCM doit avoir tous les éléments attendus pour qu'il soit compté comme juste. Une réponse libre doit avoir les même caractères, avec les espaces (mais non sensible à la case).

Un étudiant peut répondre à un questionnaire disponible et peut ensuite voir ses résultats.  
Un enseignant a accès aux résultats d'un questionnaires qu'il a créé. Il peut également voir le détail des réponses d'un élève ayant répondu ou avoir le détail des réponses pour une question donnée.


### Fontionnalités secondaires
Des barres de recherches sont fonctionnelles afin de faciliter la recherche d'un élément.  
Certains boutons sont aussi affichés afin de trier les questionnaires qui attendent une réponse.  

Le site a été fait pour traiter au maximum les erreurs telles que :
	
	* les echecs de connexion
	* erreurs dans les formaulaires
	* les tricheries au niveau des url (accéder à des actions qui ne font pas parti du controller actuel, changer de controleur par l'url, accéder à un questionnaire fermé...) 
	* modifier les affichages à partir de l'inspecteur : Les boutons qui sont affichés ou non sont traités par le php et donc inaccessible via la page web.

Une personne qui s'incrit ne peut pas avoir un login déjà existant


### Extras
Il existe un super utilisateur. Son profil permet de visualiser l'ensemble de la base de données et ainsi de réucpérer un mot de passe.

-----------

## Déployer en local
Pour rédployer ce projet sur un serveur local tel que uWamp, il faut penser à changer les données d'accès à la base de données.

Pour ce faire, deux fichier sont à modifier. 
#### Accès à la base de données
Le premier est celui de la connexion à la base de données : le fichier classes/Database.class.php. Il faudra mettre votre nom de base de données, le nom d'utilisateur ainsi que le mot de passe.  
Notez que pour un serveur local, on aura souvent :

	$DB_HOST = 'localhost';
	$DB_NAME = 'le nom de votre base de données';
	$DB_USER = 'root';
	$DB_PWD = 'root';
	// ou bien 
	$DB_PWD = '';

Également, même sur un serveur distant, le nom d'hôte est souvent toujours 'localhost', mais pensez tout de même à vérifier ce paramètre. Les sites hébergeurs (tels que 1and1) ne gardent pas ces noms là.

#### Liens des requêtes AJAX
Le deuxième fichier à modifier est un fichier faisant appel à une requête AJAX.  
Cette requête prend un lien où elle va chercher un bout de code. Or ce lien diffère en fonction du lieu de déploiement du site. Il faut vérifier les liens dans ce fichier : templates/remplirQuestionTemplate.php.  
Attention : la fonction js window.location.origin ne renvoie que la partie principale de l'url actuel.
Par exemple, si cette fonction est appelée sur une page ayant l'url https://eden.imt-lille-douai.fr/~thomas.malidin.delabriere/index.php, la fonction renverra eden.imt-lille-douai.fr. Pensez à faire attention à ce genre de détails.
