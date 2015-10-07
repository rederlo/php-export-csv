<?php
/**
 * Created by PhpStorm.
 * User: Rodrigo
 * Date: 12/12/2014
 * Time: 14:52
 */

require_once 'vendor/autoload.php';

use League\Csv\Writer;

$pdo = new PDO('mysql:host=localhost;dbname=teste' , 'root' , '1234');

$sth = $pdo->prepare(
    "SELECT id, nome FROM alunos LIMIT 200"
);

$sth->setFetchMode(PDO::FETCH_ASSOC);
$sth->execute();


$csv = Writer::createFromFileObject(new SplTempFileObject);


$csv->setNullHandlingMode(Writer::NULL_AS_EMPTY);


$csv->insertOne(['id', 'nome']);

$csv->insertAll($sth);

$csv->output('users.csv');
die;
