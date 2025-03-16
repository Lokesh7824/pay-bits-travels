<?php
session_start();
session_destroy(); // Destroy session
echo "success"; // Send response to AJAX
?>
