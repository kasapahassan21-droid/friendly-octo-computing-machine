<!doctype html>
<html lang="sw">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IDEA CONSTRUCTION COMPANY</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="app-shell">
      <aside class="sidebar" aria-label="Idea Construction navigation">
        <div class="brand">
          <div class="brand-mark">I.D.C</div>
          <div>
            <strong>Idea Construction</strong>
            <span>Control ya miradi ya ujenzi</span>
          </div>
        </div>

        <nav class="nav-list">
          <button class="nav-item active" data-view="dashboard" type="button">Dashboard</button>
          <button class="nav-item" data-view="requests" type="button">Maombi</button>
          <button class="nav-item" data-view="fundis" type="button">Mafundi</button>
          <button class="nav-item" data-view="equipment" type="button">Vifaa</button>
          <button class="nav-item" data-view="objectives" type="button">Objectives</button>
          <button class="nav-item" data-view="schedule" type="button">Ratiba</button>
          <button class="nav-item" data-view="payments" type="button">Malipo</button>
        </nav>

        <div class="sidebar-panel">
          <span>Motto</span>
          <strong>Jenga kwa ubora, simamia kwa data, kamilisha kwa wakati.</strong>
          <button class="ghost-button" type="button" data-open-request>Fungua Ombi</button>
        </div>
      </aside>

      <main class="main">
        <header class="topbar">
          <div>
            <p class="eyebrow">Dodoma</p>
            <h1>Idea Construction Control Center</h1>
          </div>
          <div class="topbar-actions">
            <label class="search">
              <span>Tafuta</span>
              <input id="searchInput" type="search" placeholder="Jina, eneo, aina ya kazi au fundi" />
            </label>
            <div class="session-chip" aria-live="polite">
              <span class="session-label">Akaunti</span>
              <strong id="sessionName">Mgeni</strong>
            </div>
            <a class="secondary-button session-link" href="logout.php">Logout</a>
            <button class="primary-button" type="button" data-open-request>Ombi Jipya</button>
          </div>
        </header>

        <section class="hero-control bg-site" id="heroControl" aria-label="Construction background control">
          <div class="hero-copy">
            <p class="eyebrow">Construction command room</p>
            <h2>Udhibiti wa kazi, mafundi, vifaa, ratiba na malipo sehemu moja.</h2>
            <p>
              Mfumo huu unarahisisha kupanga kazi za construction, kufuatilia maendeleo,
              na kuhakikisha kila eneo lina vifaa vinavyohitajika kabla kazi haijaanza.
            </p>
          </div>
          <div class="background-picker" aria-label="Badili picha ya background">
            <span>Background</span>
            <button class="active" type="button" data-background="bg-site">Site</button>
            <button type="button" data-background="bg-equipment">Vifaa</button>
            <button type="button" data-background="bg-blueprint">Plan</button>
          </div>
        </section>

        <section class="summary-grid" aria-label="Muhtasari">
          <article class="metric">
            <span>Maombi mapya</span>
            <strong id="newRequests">0</strong>
            <small>yanahitaji kupangiwa fundi</small>
          </article>
          <article class="metric">
            <span>Kazi zinaendelea</span>
            <strong id="activeJobs">0</strong>
            <small>zinatarajiwa kukamilika leo</small>
          </article>
          <article class="metric">
            <span>Mafundi walio karibu</span>
            <strong id="availableFundis">0</strong>
            <small>wanaweza kupokea kazi</small>
          </article>
          <article class="metric">
            <span>Mapato ya wiki</span>
            <strong id="weeklyRevenue">TSh 0</strong>
            <small>kutoka kazi zilizofungwa</small>
          </article>
        </section>

        <section class="content-view active" id="dashboard">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Leo</p>
              <h2>Kazi zinazohitaji uamuzi</h2>
            </div>
            <div class="segmented-control" role="tablist" aria-label="Kuchuja kazi">
              <button class="active" type="button" data-filter="all">Zote</button>
              <button type="button" data-filter="open">Wazi</button>
              <button type="button" data-filter="assigned">Zimepangiwa</button>
            </div>
          </div>

          <div class="dashboard-layout">
            <section class="work-list" id="jobList" aria-label="Orodha ya kazi"></section>
            <aside class="detail-panel" id="jobDetail" aria-label="Maelezo ya kazi"></aside>
          </div>
        </section>

        <section class="content-view" id="requests">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Maombi</p>
              <h2>Maombi yote ya wateja</h2>
            </div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Mteja</th>
                  <th>Huduma</th>
                  <th>Eneo</th>
                  <th>Hali</th>
                  <th>Makadirio</th>
                </tr>
              </thead>
              <tbody id="requestRows"></tbody>
            </table>
          </div>
        </section>

        <section class="content-view" id="fundis">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Mtandao</p>
              <h2>Mafundi waliothibitishwa</h2>
            </div>
          </div>
          <div class="fundi-grid" id="fundiGrid"></div>
        </section>

        <section class="content-view" id="equipment">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Vifaa vya kazi</p>
              <h2>Vifaa vinavyopaswa kuwepo kila sehemu ya construction</h2>
            </div>
          </div>
          <div class="equipment-grid" id="equipmentGrid"></div>
        </section>

        <section class="content-view" id="objectives">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Mwelekeo</p>
              <h2>Objectives za mfumo na motivation</h2>
            </div>
          </div>
          <div class="objective-layout">
            <article class="motto-panel">
              <span>Motto / Motivation</span>
              <strong>Jenga kwa ubora, simamia kwa data, kamilisha kwa wakati.</strong>
              <p>Kila kazi iwe na taarifa sahihi, fundi sahihi, vifaa sahihi, na muda sahihi.</p>
            </article>
            <div class="objective-list" id="objectiveList"></div>
          </div>
        </section>

        <section class="content-view" id="schedule">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Ratiba</p>
              <h2>Ziara za kazi wiki hii</h2>
            </div>
          </div>
          <div class="timeline" id="timeline"></div>
        </section>

        <section class="content-view" id="payments">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Fedha</p>
              <h2>Malipo na makato</h2>
            </div>
          </div>
          <div class="payment-grid">
            <article>
              <span>Escrow</span>
              <strong>TSh 1,180,000</strong>
              <small>inasubiri kazi kukubaliwa</small>
            </article>
            <article>
              <span>Kamisheni</span>
              <strong>TSh 162,000</strong>
              <small>mapato ya platform</small>
            </article>
            <article>
              <span>Malipo kwa mafundi</span>
              <strong>TSh 918,000</strong>
              <small>tayari kwa kutoa</small>
            </article>
          </div>
        </section>
      </main>
    </div>

    <dialog id="requestDialog">
      <form id="requestForm" method="dialog">
        <div class="modal-header">
          <div>
            <p class="eyebrow">Ombi jipya</p>
            <h2>Andikisha kazi ya mteja</h2>
          </div>
          <button class="icon-button" value="cancel" aria-label="Funga" type="submit">x</button>
        </div>

        <div class="form-grid">
          <label>
            Jina la mteja
            <input name="customer" required placeholder="Mf. Asha M." />
          </label>
          <label>
            Simu
            <input name="phone" required placeholder="+255..." />
          </label>
          <label>
            Huduma
            <select name="service" required>
              <option value="Umeme">Umeme</option>
              <option value="Plumbing">Plumbing</option>
              <option value="Ujenzi">Ujenzi</option>
              <option value="Rangi">Rangi</option>
              <option value="Tiles">Tiles</option>
              <option value="Welding">Welding</option>
              <option value="AC">AC</option>
              <option value="Seremala">Seremala</option>
            </select>
          </label>
          <label>
            Eneo
            <input name="location" required placeholder="Mf. Nzuguni" />
          </label>
          <label class="full">
            Maelezo
            <textarea name="description" rows="4" required placeholder="Eleza kazi inayohitajika kwa kifupi"></textarea>
          </label>
        </div>

        <div class="modal-actions">
          <button class="secondary-button" value="cancel" type="submit">Ghairi</button>
          <button class="primary-button" value="submit" type="submit">Hifadhi Ombi</button>
        </div>
      </form>
    </dialog>

    <script src="auth.js"></script>
    <script src="app.js"></script>
  </body>
</html>
