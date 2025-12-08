<?php
$events = get_events();
?>

<h2>Registration Form</h2>

<form method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <br>

    <label for="event">Select Event:</label>
    <select id="event" name="event_id" required>
        <option value="">Select an event you want to attend.</option>
        <?php foreach ($events as $event) : ?>
            <option value="<?php echo htmlspecialchars($event['id']); ?>">
                <?php echo htmlspecialchars($event['title']); ?> - <?php echo htmlspecialchars($event['event_date']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br>

    <input type="hidden" name="action" value="register">
    <button class="btn btn-primary" type="submit">Register</button>
</form>