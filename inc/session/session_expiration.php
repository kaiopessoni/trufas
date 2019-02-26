<?php

  $max_time_session = 60 * 60; // 1 hora

  if (time() - $_SESSION['tf_last_time_access'] > $max_time_session) {
    unset($_SESSION['tf_user_active']);
    header("Location: /trufas/login");
  }

  $_SESSION['tf_last_time_access'] = time();