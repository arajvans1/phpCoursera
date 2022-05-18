<?php
$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=people', 'pg4e', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ?>