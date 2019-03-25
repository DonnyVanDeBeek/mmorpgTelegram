<?php

include 'keyboard.php';

print "\nTest1\n";
$test1 = as_button("Bottone 1");
print $test1->dump() . "\n";

print "\nTest2\n";
$test2 = as_button("Bottone 2", "Bottone 3,  ");
print $test2->dump() . "\n";

print "\nTest3\n";
$test3 = as_button("Bottone 4", array("Bottone 5", "Bottone 6"));
print $test3->dump() . "\n";

print "\nTest4\n";
$test1->push($test2, $test3, "Bottone 7");
print $test1->dump() . "\n";

print "\nTest5\n";
$test1->remove("Bottone 7", $test3);
print $test1->dump() . "\n";

print "\nKey1\n";
$key = new Keyboard("Key 1");
print $key->dump() . "\n";

print "\nKey2\n";
$key->push($test1);
print $key . "\n";

print "\nKey3\n";
$key->separator = ",\n";
print $key . "\n";
