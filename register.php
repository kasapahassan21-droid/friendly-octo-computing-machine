<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';

$errors = [];
$success = false;
$fullName = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim((string) ($_POST['full_name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $confirmPassword = (string) ($_POST['confirm_password'] ?? '');

    if (strlen($fullName) < 2) {
        $errors[] = 'Tafadhali ingiza jina kamili.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Tafadhali ingiza email sahihi.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Nenosiri liwe na herufi au namba angalau 8.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Nenosiri na uthibitisho havifanani.';
    }

    if (!$errors) {
        try {
            $statement = db()->prepare(
                'INSERT INTO users (full_name, email, password_hash, role) VALUES (:full_name, :email, :password_hash, :role)'
            );
            $statement->execute([
                'full_name' => $fullName,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 'customer',
            ]);

            $success = true;
            $fullName = '';
            $email = '';
        } catch (PDOException $exception) {
            if ($exception->getCode() === '23000') {
                $errors[] = 'Email hii tayari imesajiliwa. Tafadhali tumia nyingine au login.';
            } else {
                $errors[] = 'Usajili umeshindikana kwa sasa. Jaribu tena.';
            }
        }
    }
}
?>
<!doctype html>
<html lang="sw">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IDEA COMPANY | Register</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body class="auth-page">
    <main class="auth-shell">
      <section class="auth-brand-panel">
        <div class="auth-brand-badge">I.D.C</div>
        <p class="eyebrow">IDEA CONSTRUCTION</p>
        <h1>Fungua akaunti mpya kwa ajili ya kusimamia kazi na maombi.</h1>
        <p class="auth-copy">
          Akaunti yako itahifadhiwa kwenye MySQL kwa usalama kwa kutumia password hash.
        </p>
        <div class="auth-highlights">
          <article>
            <strong>Fast</strong>
            <span>Jaza taarifa chache tu kuanza</span>
          </article>
          <article>
            <strong>Secure</strong>
            <span>Nenosiri halihifadhiwi kama plain text</span>
          </article>
          <article>
            <strong>Ready</strong>
            <span>Baada ya usajili unaweza kuingia mara moja</span>
          </article>
        </div>
      </section>

      <section class="auth-card">
        <p class="eyebrow">Akaunti mpya</p>
        <h2>Jisajili sasa</h2>

        <?php if ($success): ?>
          <p class="auth-success" role="status">Umesajiliwa kikamilifu. Sasa unaweza kuingia kwenye akaunti yako.</p>
        <?php endif; ?>

        <form class="auth-form" method="post" action="register.php">
          <label>
            Jina kamili
            <input name="full_name" required autocomplete="name" placeholder="Mf. Hassan K." value="<?= htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8') ?>" />
          </label>
          <label>
            Email
            <input name="email" type="email" required autocomplete="email" placeholder="kasapa@example.com" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" />
          </label>
          <label>
            Nenosiri
            <input name="password" type="password" required autocomplete="new-password" minlength="8" placeholder="Angalau herufi/namba 8" />
          </label>
          <label>
            Rudia nenosiri
            <input name="confirm_password" type="password" required autocomplete="new-password" minlength="8" placeholder="Rudia nenosiri" />
          </label>
          <p class="auth-message" role="alert" aria-live="polite">
            <?= $errors ? htmlspecialchars(implode(' ', $errors), ENT_QUOTES, 'UTF-8') : '' ?>
          </p>
          <button class="primary-button auth-submit" type="submit">Create account</button>
          <a class="auth-link" href="login.php">Tayari una akaunti? Login</a>
        </form>
      </section>
    </main>

    <script src="auth.js"></script>
    <script>
      SmartFundiAuth.redirectIfAuthenticated();
    </script>
  </body>
</html>
