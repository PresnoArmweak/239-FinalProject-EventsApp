<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'functions.php';

session_start();

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
        } else {
            insert_new_registration($event_id, $name, $email);
            $view = 'registration_success';
            break;
        }
        break;
    case 'admin_login':
        $username = trim((string)($_POST['username'] ?? ''));
        $password = trim((string)($_POST['password'] ?? ''));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($username === 'admin' && password_verify("finalproject", $hashed_password)) {
            $_SESSION['user_id'] = 1;
            $_SESSION['name'] = 'Admin';
            header('Location: ?view=upcoming_events');
            exit;
        } else {
            $view = 'failed_admin_login';
        }
        break;
    case 'add_event':
        $title = trim((string)($_POST['title'] ?? ''));
        $event_date = (string)($_POST['event_date'] ?? '');
        $location = trim((string)($_POST['location'] ?? ''));
        $description = trim((string)($_POST['description'] ?? ''));
        insert_new_event($title, $event_date, $location, $description);
        header('Location: ?view=upcoming_events');
        exit;
        break;
    case 'delete_event':
        if (!empty($_SESSION['user_id'])) {
            $event_id = trim((int)($_POST['event_id'] ?? ''));
            $pdo = get_pdo();
            $stmt = $pdo->prepare('DELETE FROM `events` WHERE id = :event_id;');
            $stmt->execute(['event_id' => $event_id]);
            header('Location: ?view=upcoming_events');
            exit;
        } else {
            $view = 'AdminLogin';
        }
        break;
    case 'edit_event':
        if (!empty($_SESSION['user_id'])) {
            $event_id = trim((int)($_POST['event_id'] ?? ''));
            $title = trim((string)($_POST['title'] ?? ''));
            $event_date = (string)($_POST['event_date'] ?? '');
            $location = trim((string)($_POST['location'] ?? ''));
            $description = trim((string)($_POST['description'] ?? ''));
            update_event($event_id, $title, $event_date, $location, $description);
            header('Location: ?view=upcoming_events');
            exit;
        } else {
            $view = 'AdminLogin';
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
    } elseif ($view === 'registration_form') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'registration_form.php';
    } elseif ($view === 'already_registered') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'already_registered.php';
    } elseif ($view === 'registration_success') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'registration_success.php';
    } elseif ($view === 'event_details') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'event_details.php';
    } elseif ($view === 'AdminLogin') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'admin_login.php';
    } elseif ($view === 'failed_admin_login') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'failed_admin_login.php';
    } elseif ($view === 'add_event') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'add_event.php';
    } elseif ($view === 'edit_event') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'edit_event.php';
    } elseif ($view === 'delete_event') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'delete_event.php';
    } elseif ($view === 'RegistrationsPage') {
        include __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'registrations_page.php';
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>