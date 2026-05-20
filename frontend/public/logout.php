<?php

session_start();

// remove todos os dados da sessão
session_unset();
session_destroy();

// volta para home ou login
header("Location: index.php");

exit;