<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';

$errors = [];
$email = '';
$name = '';
$loginUser = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Tafadhali ingiza email sahihi.';
    }

    if ($password === '') {
        $errors[] = 'Tafadhali ingiza nenosiri.';
    }

    if (!$errors) {
        $statement = db()->prepare(
            'SELECT id, full_name, email, password_hash FROM users WHERE email = :email AND is_active = 1 LIMIT 1'
        );
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $loginUser = [
                'name' => $user['full_name'],
                'email' => $user['email'],
            ];
        } else {
            $errors[] = 'Email au nenosiri si sahihi.';
        }
    }
}
?>
<!doctype html>
<html lang="sw">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IDEA COMPANY | Login</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body class="auth-page">
    <main class="auth-shell">
      <section class="auth-brand-panel">
        <div class="auth-brand-badge">I.D.C</div>
        <p class="eyebrow">IDEA CONSTRUCTION</p>
        <h1>Ingia kwenye mfumo wa kusimamia kazi, vifaa, mafundi na malipo.</h1>
        <p class="auth-copy">
          Jenga kwa ubora, simamia kwa data, kamilisha kwa wakati.
        </p>
        <div class="auth-highlights">
          <article>
            <strong>24/7</strong>
            <span>Session hubaki mpaka utoke mwenyewe</span>
          </article>
          <article>
            <strong>Live</strong>
            <span>Dashboard inafunguka mara moja baada ya login</span>
          </article>
          <article>
            <strong>Secure</strong>
            <span>Imeandaliwa kuunganishwa na MySQL backend</span>
          </article>
        </div>
      </section>

      <section class="auth-card">
        <p class="eyebrow">Karibu tena</p>
        <h2>Ingia kwenye akaunti yako</h2>
        <form class="auth-form" method="post" action="login.php">
          <label>
            Email
            <input name="email" type="email" required autocomplete="email" placeholder="kasapa@example.com" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" />
          </label>
          <label>
            Nenosiri
            <input name="password" type="password" required autocomplete="current-password" placeholder="Ingiza nenosiri" />
          </label>
          <p class="auth-note">Huna akaunti? <a class="auth-link" href="register.php">Jisajili hapa</a>.</p>
          <p class="auth-message" role="alert" aria-live="polite">
            <?= $errors ? htmlspecialchars(implode(' ', $errors), ENT_QUOTES, 'UTF-8') : '' ?>
          </p>
          <button class="primary-button auth-submit" type="submit">Login</button>
          <a class="auth-link" href="index.php">Rudi kwenye dashboard</a>
        </form>
      </section>
    </main>

    <script src="auth.js"></script>
    <script>
      <?php if ($loginUser): ?>
      SmartFundiAuth.writeSession(<?= json_encode($loginUser, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>);
      window.location.replace("index.php");
      <?php else: ?>
      SmartFundiAuth.redirectIfAuthenticated();
      <?php endif; ?>
    </script>
  </body>
</html>
