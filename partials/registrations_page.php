<?php
$registrations = get_all_registrations();
?>

<h2>All Registrations</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Register Time</th>
        <th>Event</th>
        <th>Event Date</th>
    </tr>
    <?php foreach ($registrations as $registration) : 
        $event = get_event_by_id($registration['event_id']);
    ?>
        <tr>
            <td><?php echo htmlspecialchars($registration['name']); ?></td>
            <td><?php echo htmlspecialchars($registration['email']); ?></td>
            <td><?php echo htmlspecialchars($registration['registered_at']); ?></td>
            <td><?php echo htmlspecialchars($event['title'] ?? 'Event not found'); ?></td>
            <td><?php echo htmlspecialchars($event['event_date'] ?? 'N/A'); ?></td>
        </tr>
    <?php endforeach; ?>
</table>