<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'functions.php';

$view = filter_input(INPUT_GET, 'view') ?: 'upcoming_events';
$action = filter_input(INPUT_POST, 'action');


switch ($action) {
    case 'register':
        $event_id = trim((int)($_POST['event_id'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $name = trim((string)($_POST['name'] ?? ''));
        if (check_if_registered($event_id, $email, $name)) {
            $view = 'already_registered';
            break;
        }
        else {
            insert_new_registration($event_id, $name, $email);
            $view = 'registration_success';
            break;
        }
        break;
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Planner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include __DIR__ . DIRECTORY_SEPARATOR . 'conponents' . DIRECTORY_SEPARATOR . 'nav.php'; ?>

    <?php
    if ($view === 'upcoming_events') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'upcoming_events.php';
    }
    elseif ($view === 'registration_form') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'registration_form.php';
    }
    elseif ($view === 'already_registered') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'already_registered.php';
    }
    elseif ($view === 'registration_success') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'registration_success.php';
    }
    elseif ($view === 'event_details') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'event_details.php';
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>