<?php
// Include the necessary files
require_once './UsersDao.php';

$usersDao = new UsersDao();

// 1. Test creating a new user
$newUser = [
    'full_name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'password_hash' => password_hash('password123', PASSWORD_BCRYPT)  // Password hashed before storage
];

echo "Creating new user...\n";
if ($usersDao->createUser($newUser)) {
    echo "User created successfully!\n";
} else {
    echo "Error: User could not be created.\n";
}

?>