<?php
session_start();
unset($_SESSION);
session_destroy();
session_write_close();
echo "<script>location.href='index.php';</script>";
exit();
?>