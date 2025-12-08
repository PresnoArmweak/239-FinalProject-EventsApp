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





?>