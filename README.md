# Webservices
Vanuit je app een externe database benaderen via webservices, voortgekomen uit het 'Slimme Willy' concept.

MySQL - een database management systeem.

SQL - een programmeertaal om databases uit te vragen.

mysqli - een stel PHP functies om een MySQL database te benaderen.


Zet in de 'server' directory een 'config.php' met de volgende inhoud (vervang de sterretjes door je echte toegangsgegevens):

<?php
$dbserver = "***"; // meestal 'localhost'
$dbuser = "***"; // de naam van de database-gebruiker
$dbpwd = "***"; // het wachtwoord van de database-gebruiker
$dbname = "***"; // de naam van de database
