<!doctype html>
<html lang="sw">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IDEA COMPANY | Logout</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body class="auth-page">
    <main class="auth-shell">
      <section class="auth-brand-panel auth-brand-panel--logout">
        <div class="auth-brand-badge">I.D.C</div>
        <p class="eyebrow">Session closed</p>
        <h1>Umetoka salama.</h1>
        <p class="auth-copy">Session yako imeondolewa kwenye browser. Ukirudi, utaweza kuingia tena kwa usalama.</p>
      </section>

      <section class="auth-card">
        <p class="eyebrow">Logout</p>
        <h2>Naondoa session sasa hivi</h2>
        <p class="auth-note">Utapelekwa kwenye ukurasa wa login baada ya muda mfupi.</p>
        <div class="auth-loader" aria-hidden="true"></div>
        <a class="auth-link" href="login.php">Nenda moja kwa moja kwenye login</a>
      </section>
    </main>

    <script src="auth.js"></script>
    <script>
      SmartFundiAuth.initLogoutPage();
    </script>
  </body>
</html>
