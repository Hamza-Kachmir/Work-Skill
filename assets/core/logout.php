<?php
    session_name("workskill");
    session_start();
    session_destroy();
    header("Location: ../../index.php");
