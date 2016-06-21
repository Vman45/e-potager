# E-Potager
Auto potager intégré au coeur domotique Yana de Idleman

## Présentation
Bonjour à tous! Ceci est un projet d'auto-potager à intégrer dans le coeur domotique Yana Server compatible entre autre avec le Flower Power de Parrot, qui est une sonde bluetooth, facile d'utilisation, et avec laquelle j'aimerai suivre l'état de mes petites plantations =)

## Captures d'écran
![capture d ecran 2016-06-21 a 09 54 04](https://cloud.githubusercontent.com/assets/6785619/16221998/06f0529a-37c0-11e6-8fd1-8fc23fe0f024.png)
![capture d ecran 2016-06-21 a 09 55 17](https://cloud.githubusercontent.com/assets/6785619/16221999/0a02f1ea-37c0-11e6-8b09-459aecd6ec2b.png)
![capture d ecran 2016-06-21 a 09 55 36](https://cloud.githubusercontent.com/assets/6785619/16222003/0e88101a-37c0-11e6-994a-8789ff9853a7.png)
![capture d ecran 2016-06-21 a 09 55 47](https://cloud.githubusercontent.com/assets/6785619/16222004/10b040c4-37c0-11e6-87a5-887d74e4e4c4.png)

## En cours de développement
En plus de ce que vous voyez en screen, je compte développer:
- Plusieurs widgets qui affichent chacun une des 4 données renvoyées par l'appareil
- Des commandes vocales, une pour chaque donnée et une pour un rapport complet
- Un bouton et une commande vocale qui seraient liée à un pin gpio (ou une commande bash je ne sais pas encore) pour pouvoir effectuer une action en fonction des données (genre "Yana, arrose les plantes", pour activer une électro-vanne / pompe à eau électrique). **FAIT: il sera possible d'ajouter une commande pour l'arrosage et une commande pour l'engrais, en bash, ce qui permet à chacun de développer son propre système d'arrosage / d'ajout d'engrais.**

Le plugin n'est pas fonctionnel car je n'ai pas encore acheté ce fameux Flower Power, j'ai juste développé le plugin en fonction de la doc trouvé sur internet pour interagir avec ce dernier via Raspberry Pi. Si vous avez des idées d'améliorations, je suis preneur! Si vous avez déjà utilisé le Flower Power avec node.js notemment le paquet npm qui va bien, ce serait cool de me donner un retour =) Sinon, si vous avez envie de m'acheter un Flower Power pour que je puisse avancer plus vite, je suis preneur également ;)

## Avancement
Après pas mal de discussions, je compte procéder ainsi: la première version du plugin sera directement compatible avec le Flower Power, que j'achèterai en temps voulu. Je développerai par la suite un projet de sonde DIY autonome, soit un Flower Power fait maison pour un budget de 20€ max (capteurs + batterie + bluetooth). Chaque sonde sera indépendante et pourra être ajoutée au plugin, de façon à gérer plusieurs objets "Potager". Ce projet sera mis à disposition sur l'excellente plateforme Hackpoint, et je rédiregerai un article complet sur http://valou-tweak.fr, comme j'ai l'habitude de faire avec mes petits hacks. En parallèle, je compte mettre en place une boîte à permaculture, pour aller un peu plus loin qu'une simple gestion de potager, et destiné aux personnes qui comme moi n'ont pas la chance de posséder un lopin de terre. J'imagine cette boîte comme un cube en bois de 50cm3 environ, avec une "porte" s'ouvrant vers le haut où sera intégré l'électronique, le tout se déplaçant facilement.

## Inspiration
Bien évidemment, le coeur Yana développé par Idleman:
https://github.com/ldleman/yana-server
Egalement la plateforme Hackpoint, développé encore par Idleman:
http://blog.idleman.fr/gerez-vos-projets-de-hack-avec-hackpoint/
Je poste aussi l'excellent projet d'un étudiant, Victor Le Deuff ayant développé un système similaire, sur lequel je me suis fortement inspiré: http://www.pipotager.tk/

Merci pour votre lecture =)
