<?php
    try
    {
        $bdd = new PDO('mysql:host=db676121771.db.1and1.com;dbname=db676121771;charset=utf8', 'dbo676121771', 'Poo5vood@');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }