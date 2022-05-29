<?php
$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=autos', 'arajvans', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>