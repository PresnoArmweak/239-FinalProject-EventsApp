<?php
if (empty($_SESSION['user_id'])) {
    echo "Access denied. Please log in as admin to add events.";
    header('Location: ?view=AdminLogin');
    exit;
}
?>
<form method="POST" class="center">
    <h2>Add Event</h2>

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location:</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>

    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date:</label>
        <input type="date" class="form-control" id="event_date" name="event_date" required>
    </div>

    <input type="hidden" name="action" value="add_event">
    <button type="submit" class="btn btn-primary">Add Event</button>
</form>