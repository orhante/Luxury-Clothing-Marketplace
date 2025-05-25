Flight::route('POST /login', function () {
    $data = Flight::request()->data->getData();
    $user = Flight::userService()->login($data['email'], $data['password']);
    
    if ($user) {
        Flight::json($user);
    } else {
        Flight::halt(401, 'Invalid credentials');
    }
});

Flight::route('POST /register', function () {
    $data = Flight::request()->data->getData();
    $data['role'] = 'user'; // default role
    $user = Flight::userService()->register($data);
    Flight::json($user);
});
