<?php
require __DIR__ . '/src/autoload.php';
Lms\Env::load(__DIR__ . '/.env');

$php = PHP_BINARY;
$hash = password_hash('Admin@123', PASSWORD_DEFAULT);
$officer = password_hash('Officer@123', PASSWORD_DEFAULT);
$acct = password_hash('Accountant@123', PASSWORD_DEFAULT);
$viewer = password_hash('Viewer@123', PASSWORD_DEFAULT);

$pdo = Lms\Database::pdo();
$pdo->prepare('UPDATE users SET password=? WHERE email=?')->execute([$hash, 'admin@lms.local']);
$pdo->prepare('UPDATE users SET password=? WHERE email=?')->execute([$officer, 'officer@lms.local']);
$pdo->prepare('UPDATE users SET password=? WHERE email=?')->execute([$acct, 'accountant@lms.local']);
$pdo->prepare('UPDATE users SET password=? WHERE email=?')->execute([$viewer, 'viewer@lms.local']);
echo "Passwords hashed.\n";
