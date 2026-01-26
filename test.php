<?php 

$hash1 = password_hash("123", PASSWORD_BCRYPT);


$hash2 = password_hash("123", PASSWORD_BCRYPT);




echo ($hash1);


echo ($hash2);


