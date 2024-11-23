<?php include '../include/header.php'; ?>
<main>
    <h2>Login</h2>
    <form class="login-form" method="POST" action="/login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</main>
<?php include '../include/footer.php'; ?>
