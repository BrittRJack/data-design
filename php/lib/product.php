<?php
namespace bjack2\DataDesign;
require_once("../Classes/Product.php");

$date = new \DateTime('now');
$Product = new Product("896daa72-00fb-4b1e-8b02-a009cb4237a5","896daa72-00fb-4b1e-8b02-a009cb4237a5",$date,"16");
var_dump($Product);