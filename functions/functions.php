<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'db.php';

function get_events(): array    
{
    $pdo = get_pdo();
    $stmt = $pdo->query('SELECT * FROM `events` e WHERE e.event_date >= CURRENT_DATE;');
    return $stmt->fetchAll();
};

function available_event_ids(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->query('SELECT e.id FROM `events` e WHERE e.event_date >= CURRENT_DATE;');
    return $stmt->fetchAll();
};

function insert_new_registration(int $event_id, string $name, string $email)
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO `registrations` (event_id, name, email) VALUES (:event_id, :name, :email);');
    $stmt->execute(['event_id' => $event_id, 'name' => $name, 'email' => $email]);
};

function check_if_registered(int $event_id, string $email, string $name): bool
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT COUNT(*) as count FROM `registrations` r WHERE r.event_id = :event_id AND r.email = :email AND r.name = :name;');
    $stmt->execute(['event_id' => $event_id, 'email' => $email, 'name' => $name]);
    $result = $stmt->fetch();
    return $result['count'] > 0;
};

function get_event_by_id(int $event_id): ?array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM `events` e WHERE e.id = :event_id;');
    $stmt->execute(['event_id' => $event_id]);
    $result = $stmt->fetch();
    return $result ?: null;
};

function insert_new_event(string $title, string $event_date, string $location, string $description)
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO `events` (title, event_date, location, description) VALUES (:title, :event_date, :location, :description);');
    $stmt->execute(['title' => $title, 'event_date' => $event_date, 'location' => $location, 'description' => $description]);
};

function update_event(int $event_id, string $title, string $event_date, string $location, string $description)
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare('UPDATE `events` SET title = :title, event_date = :event_date, location = :location, description = :description WHERE id = :event_id;');
    $stmt->execute(['event_id' => $event_id, 'title' => $title, 'event_date' => $event_date, 'location' => $location, 'description' => $description]);
};

function get_all_registrations(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->query('SELECT * FROM `registrations` r JOIN `events` e ON r.event_id = e.id ORDER BY e.id;'); // I am assumeing you did not want a literal GROUP BY and instead wanted an ORDER BY so that all users can be seen for each event
    return $stmt->fetchAll();
}



?>