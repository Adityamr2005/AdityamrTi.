<?php
session_start();

session_unset();
session_destroy();

header("Location: login.php?message=" . urlencode("Anda telah berhasil logout."));
exit;
?>
