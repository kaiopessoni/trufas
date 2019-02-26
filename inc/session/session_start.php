<?php

  if ( !isset($_SESSION['tf_user_active']) )
    header("Location: /trufas/login");