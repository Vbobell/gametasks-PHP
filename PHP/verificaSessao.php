<?php
 if (is_null($user)) {
                session_destroy();
                header ("Location: /gametasks/index.php");
            }
?>