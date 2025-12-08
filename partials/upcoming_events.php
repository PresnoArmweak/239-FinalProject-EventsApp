<?php
$events = get_events();
?>

<h1>Upcoming Events</h1>
<?php if (count($events) === 0) : ?>
    <p>No upcoming events.</p>


<?php else : ?>
    <table>
        <tr>
            <!-- Headers -->
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
        </tr>

        <?php foreach ($events as $event) : ?>

            <tr>
                <td><?php echo htmlspecialchars($event['title']); ?></td>
                <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                <td><?php echo htmlspecialchars($event['location']); ?></td>
                <td>
                    <a href="?view=event_details&event_id=<?php echo htmlspecialchars($event['id']); ?>" class="btn btn-sm btn-primary">View Details</a>
                </td>
                <td>
                    <a href="?view=edit_event&event_id=<?php echo htmlspecialchars($event['id']); ?>" class="btn btn-sm btn-secondary">Edit</a>
                </td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="action" value="delete_event">
                        <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['id']); ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

<?php endif; ?>