<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Templates/index.html");
exit();
?>
