<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php?r=Deslogado%20com%20sucesso");