<?php include '../include/header.php'; ?>
<main>
    <h2>Register</h2>
    <form class="register-form" method="POST" action="/register.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</main>
<?php include '../include/footer.php'; ?>
