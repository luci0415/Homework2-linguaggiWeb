HOMEWORK-2-PHP-MYSQL

AUTORI: Emilio Russo, Lucia Felici

In questo secondo homework abbiamo preso spunto dal primo: il sito è lo stesso, ma i file html hanno ceduto il posto
ai php, in cui, ove fosse utile abbiamo inserito nuove funzionalità e soprattutto ove fosse possibile abbiamo reso il
codice più elegante e breve (basti notare il passo di qualità da decine e decine di html ai soli php presenti) seppur
più complesso in alcuni casi.

A grandi linee, le modifiche rispetto alla versione precedente (HTML-CSS) sono le seguenti:
-Funzionalità di registrazione e login;
-Nella pagina del libro dei fantasmi è stata aggiunta la possibilità di filtrare la lista in base alle prove ottenute;
-Aggiunta la sezione del profilo personale;
-Ove possibile, le tabelle e le liste nel codice originariamente HTML puro sono state sostituite da cicli che automatizzassero
 l'inserimento degli elementi;
-Gli elementi in questione (fantasmi, oggetti, prove, dati utente, mappe, foto e caratteristiche varie) sono stati interamente
 inseriti in tabelle all'interno di un unico database MYSQL.

IMPORTANTE:
All'interno della cartella è presente il file "install.php", il cui scopo è quello di creare e popolare il database.
L'idea è di eseguirlo <b>una sola volta</b>, altrimenti gli elementi vengono duplicati, triplicati...
Una volta eseguito l'install, il database avrà come nome utente "user" e come password "password" ai fini dell'accesso.
Dopodichè, l'ideale è eseguire "index.php", che proporrà all'utente di effettuare il login. Abbiamo pensato di non popolare
a priori la tabella degli utenti per far provare la registrazione, ma non è obbligatoria, in quanto si può accedere come guest.

