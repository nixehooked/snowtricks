# snowtricks
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/61cacf4273b44d0c931c8dc01865413a)](https://app.codacy.com/manual/nixehooked/snowtricks?utm_source=github.com&utm_medium=referral&utm_content=nixehooked/snowtricks&utm_campaign=Badge_Grade_Dashboard)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/7cf78155aeaf4bbbb42e8f02c5e83b2d)](https://app.codacy.com/manual/nixehooked/snowtricks?utm_source=github.com&utm_medium=referral&utm_content=nixehooked/snowtricks&utm_campaign=Badge_Grade_Dashboard)

<h2><strong>Clonage du projet</strong></h2>
<p>Installation de GIT :</p>
<pre><code>- GIT (https://git-scm.com/downloads) </code></pre>
<p>Une fois GIT installé, il faudra vous placer dans le répertoire de votre choix puis exécuté la commande suivante :</p>
<pre><code>- git clone https://github.com/nixehooked/snowtricks.git</code></pre>
<p>Le projet sera automatiquement copié dans le répertoire ciblé.</p>
<h2><strong>Configuration des variables d'environnement</strong></h2>
<p>Configurez les variables d'environnement comme la connexion à la base de données dans le fichier env.local qui sera créé à la racine du projet en copiant le fichier .env. Vous pourrez ensuite renseigner les identifiants de votre base de données en suivant le modèle ci-dessous.</p>
<pre><code>- DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7</code></pre>
<h2>Création de la base de données</h2>
<p>Créez la base de données de l'application en tapant la commande ci-dessous :</p>
<pre><code>- php bin/console doctrine:database:create</code></pre>
<p>Puis lancer la migration pour créer les tables dans la base de données :</p>
<pre><code>- php bin/console doctrine:migrations:migrate</code></pre>
<h2>Lancement du serveur</h2>
<p>Vous pouvez lancer le serveur via la commande suivante :</p>
<pre><code>symfony server:start</code></pre>
<h2>Générer des fausses données</h2>
<p>Vous pouvez générer des fausses données grâce la fixture présente dans le projet avec la commande suivante :</p>
<pre><code>- php bin/console doctrine:fixtures:load</code></pre>
