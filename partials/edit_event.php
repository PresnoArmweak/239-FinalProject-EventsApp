<?php
    $event_id = (int)($_GET['event_id'] ?? 0);
    $event = get_event_by_id($event_id);

    // Format the event_date to YYYY-MM-DD format for the date input
    // can not use a string for date form input
    $event_date_formatted = date('Y-m-d', strtotime($event['event_date']));

?>

<form method="POST">
    <h2>Edit Event</h2>

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($event['title'] ?? '', ENT_QUOTES); ?>" required>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location:</label>
        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($event['location'] ?? '', ENT_QUOTES); ?>" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description"  required><?php echo htmlspecialchars($event['description'] ?? '', ENT_QUOTES); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date:</label>
        <input type="date" class="form-control" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event_date_formatted, ENT_QUOTES); ?>" required>
    </div>

    <input type="hidden" name="action" value="edit_event">
    <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['id'], ENT_QUOTES); ?>">
    <button type="submit" class="btn btn-primary">Edit Event</button>
</form>