<?php include "app/views/sessions/logout.php"; ?>
<div>
    <h1>Hello <?= $_SESSION['username']?></h1>
    <h2>Your are looking the <strong>Page</strong><?= $GLOBALS['page_name'] ?></h2>
</div>
