<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'My Website'; ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <h1><a href="/">My Website</a></h1>
        <nav>
            <ul>
                <li><a href="/index.php">Home</a></li>
                <li><a href="/register.php">Register</a></li>
                <li><a href="/login.php">Login</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="/logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
