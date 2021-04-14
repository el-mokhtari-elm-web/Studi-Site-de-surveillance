Le site de Surveillance est fini

Acces Back-end soumis à un contrôle sérré pour l'administrateur qui possède la clef

L'insertion et données  liées aux missions en cours (uniquement pour le backend)  ne sont consultables qu'en version desk et tablette (afin de poster de manière serein)

pour le front end absolument tout est consultables

Pour l'insertion assurez vous de remplir tout les champs au risque d'avoir une redirection à l'origine

Bouton de connexion / deconnexion Opérationnel

La base de données est déjà prérempli avec des utilisateurs fictifs permettant de se situer

l'interface utilisé pour la gestion relationnels des données est PhpMyAdmin et Mysql (dernière version stable)

Les classes ciblant les acteurs sont en COUPLE,
par exemple : Pour la classe "Contact" qui cible les contacts on aura avec cette dernière une classe 
Contactmanager qui elle et les autres seront des classes filles de la classe Dbconnect et qui hériteront des méthodes de la classe Dbconnect.

AVANTAGE : 
Des connexions hétérogène avec un pattern Singleton sur la classe Dbconnect.

Pas de duplications des methodes de PDO ou PDOStatement
Lisibilités accrus avec des inclusions de fichiers
