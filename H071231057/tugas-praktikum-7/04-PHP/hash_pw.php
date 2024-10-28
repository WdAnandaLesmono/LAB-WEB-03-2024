<?php
$hashedPassword = password_hash('admin_new', PASSWORD_DEFAULT);
echo $hashedPassword;
