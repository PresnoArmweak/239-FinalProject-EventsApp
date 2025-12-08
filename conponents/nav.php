<nav class="navbar navbar-expand-sm" data-bs-theme="dark">
    <div class="container-fluid">

        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="?view=upcoming_events">Upcoming Events</a></li>
            <li class="nav-item"><a class="nav-link" href="?view=registration_form">Register for Event</a></li>
        </ul>

        <ul class="navbar-nav ms-auto">

            <?php if (!empty($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="?view=add_event">Add Event</a></li>
                <li class="nav-item"><a class="nav-link" href="?view=RegistrationsPage">Registrations</a></li>
            <?php else: ?>

                <li class="nav-item"><a class="nav-link" href="?view=AdminLogin">Admin Login</a></li>

            <?php endif; ?>
        </ul>

    </div>
</nav>