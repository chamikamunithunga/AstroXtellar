<?php
require __DIR__ . '/vendor/autoload.php'; // Firebase SDK

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)->withServiceAccount('firebase_credentials.json');
$auth = $factory->createAuth();
?>
