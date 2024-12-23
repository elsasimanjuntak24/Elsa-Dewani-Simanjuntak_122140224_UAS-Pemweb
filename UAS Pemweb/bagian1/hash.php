<?php
$password_hashed = password_hash('admin123', PASSWORD_DEFAULT);
echo $password_hashed;
?>