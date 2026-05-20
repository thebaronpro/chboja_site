<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/kakao_oauth.php';

kakao_session_destroy();

$dest = $_GET['next'] ?? KAKAO_LOGOUT_REDIRECT;
header('Location: ' . $dest);
exit;
