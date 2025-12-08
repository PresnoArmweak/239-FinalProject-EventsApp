<nav class="navbar navbar-expand-sm" data-bs-theme="dark">
    <div class="container-fluid">

        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="?view=upcoming_events">Upcoming Events</a></li>
            <li class="nav-item"><a class="nav-link" href="?view=registration_form">Register for Event</a></li>
        </ul>

        <ul class="navbar-nav ms-auto">

            <?php if (!empty($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="?view=orders">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="?view=cart">Cart</a></li>
                <li class="nav-item">
                    <form method="post">
                        <input type="hidden" name="action" value="logout">
                        <button class="btn btn-sm btn-outline-secondary">Logout</button>
                    </form>
                </li>
            <?php else: ?>

                <li class="nav-item"><a class="nav-link" href="?view=login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="?view=register">Register</a></li>


            <?php endif; ?>
        </ul>

    </div>
</nav>