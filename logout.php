<?php
session_start();
session_destroy(); // Destroy all session data
header('Location: home.html'); // Redirect to the login page after logout
exit();
?>
