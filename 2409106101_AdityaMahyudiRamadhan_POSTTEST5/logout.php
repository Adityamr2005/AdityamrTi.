<?php
session_start();
session_unset();
session_destroy();

header("Location: index.php?message=Terima Kasih Anda sudah logout.");
exit();
?>
