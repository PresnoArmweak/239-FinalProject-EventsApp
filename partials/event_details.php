<?php
$event = get_event_by_id(($_GET['event_id'] ?? 0));
if (!$event) {
    echo "Event not found.";
    return;
}
?>

<table>
    <tr>
        <th>Event Title</th>
        <td><?php echo htmlspecialchars($event['title']); ?></td>
    </tr>
    <tr>
        <th>Date</th>
        <td><?php echo htmlspecialchars($event['event_date']); ?></td>
    </tr>
    <tr>
        <th>Location</th>
        <td><?php echo htmlspecialchars($event['location']); ?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo nl2br(htmlspecialchars($event['description'])); ?></td>
    </tr>
</table>