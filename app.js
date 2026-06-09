const jobs = [
  {
    id: 1,
    customer: "Asha M.",
    phone: "+255 712 400 102",
    service: "Umeme",
    location: "Mbezi Beach",
    description: "Main switch inawaka na kuzima, nyumba nzima inapoteza umeme.",
    status: "open",
    estimate: 85000,
    urgency: "Haraka",
    fundi: "Haijapangwa",
    time: "Leo 11:30",
  },
  {
    id: 2,
    customer: "Joseph K.",
    phone: "+255 754 221 778",
    service: "Plumbing",
    location: "Sinza Mori",
    description: "Bomba la jikoni linavuja na sinki limeanza kuziba.",
    status: "assigned",
    estimate: 65000,
    urgency: "Kawaida",
    fundi: "Hamisi Msuya",
    time: "Leo 14:00",
  },
  {
    id: 3,
    customer: "Neema S.",
    phone: "+255 768 900 331",
    service: "AC",
    location: "Masaki",
    description: "AC inapuliza hewa ya kawaida na kutoa sauti isiyo ya kawaida.",
    status: "assigned",
    estimate: 120000,
    urgency: "Kawaida",
    fundi: "Zawadi Paulo",
    time: "Kesho 09:00",
  },
  {
    id: 4,
    customer: "Musa T.",
    phone: "+255 713 882 019",
    service: "Seremala",
    location: "Kijitonyama",
    description: "Mlango wa mbele haujifungi vizuri, frame imelegea.",
    status: "done",
    estimate: 55000,
    urgency: "Ndogo",
    fundi: "Baraka Said",
    time: "Jana 16:30",
  },
];

const fundis = [
  { name: "Hamisi Msuya", skill: "Plumbing", area: "Sinza", rating: 4.8, jobs: 146, available: true },
  { name: "Zawadi Paulo", skill: "AC", area: "Masaki", rating: 4.9, jobs: 82, available: true },
  { name: "Baraka Said", skill: "Seremala", area: "Kijitonyama", rating: 4.7, jobs: 118, available: false },
  { name: "Rashid Ally", skill: "Umeme", area: "Mbezi", rating: 4.8, jobs: 204, available: true },
  { name: "Rose Daniel", skill: "Ujenzi", area: "Kimara", rating: 4.6, jobs: 91, available: true },
  { name: "Mariam Juma", skill: "Rangi", area: "Tabata", rating: 4.7, jobs: 73, available: false },
];

const equipment = [
  {
    icon: "PPE",
    title: "Safety PPE",
    area: "Kila site",
    description: "Helmet, safety boots, gloves, reflector vest, goggles na ear protection kwa kulinda wafanyakazi.",
  },
  {
    icon: "ME",
    title: "Measurement tools",
    area: "Vipimo na layout",
    description: "Tape measure, spirit level, laser level, square, plumb bob na marking chalk kwa usahihi wa kazi.",
  },
  {
    icon: "CN",
    title: "Concrete tools",
    area: "Msingi na slab",
    description: "Mixer, wheelbarrow, shovel, trowel, vibrator na curing materials kwa ubora wa zege.",
  },
  {
    icon: "MS",
    title: "Masonry tools",
    area: "Kuta na finishing",
    description: "Trowels, float, line string, blocks cutter, mortar board na scaffolding kwa kuta zilizo sawa.",
  },
  {
    icon: "EL",
    title: "Electrical tools",
    area: "Umeme",
    description: "Tester, multimeter, cable puller, conduit bender, drill na insulation tape kwa installation salama.",
  },
  {
    icon: "PL",
    title: "Plumbing tools",
    area: "Maji na drainage",
    description: "Pipe wrench, cutter, threader, seal tape, pressure tester na fittings za dharura.",
  },
  {
    icon: "FN",
    title: "Finishing tools",
    area: "Rangi, tiles na mbao",
    description: "Rollers, brushes, tile cutter, grinder, sanding tools, adhesive spreader na sealants.",
  },
  {
    icon: "LG",
    title: "Logistics",
    area: "Usafiri na storage",
    description: "Wheelbarrow, hoist, storage bins, tarpaulin, site lights na generator kwa kazi isisimame.",
  },
  {
    icon: "QC",
    title: "Quality control",
    area: "Ukaguzi",
    description: "Checklist, camera, moisture meter, test cube molds na daily report forms kwa ushahidi wa kazi.",
  },
];

const objectives = [
  {
    title: "Kusimamia maombi ya wateja",
    description: "Kupokea, kuhifadhi na kufuatilia kila ombi la construction kuanzia mwanzo hadi kukamilika.",
  },
  {
    title: "Kupanga mafundi kwa ufanisi",
    description: "Kulinganisha aina ya kazi, eneo, upatikanaji na uzoefu wa fundi kabla ya kumpangia kazi.",
  },
  {
    title: "Kudhibiti vifaa vya site",
    description: "Kukumbusha timu vifaa muhimu vinavyohitajika kwa kila hatua ya ujenzi kabla kazi haijaanza.",
  },
  {
    title: "Kufuatilia muda na ratiba",
    description: "Kuonyesha kazi za leo, kesho na wiki nzima ili kuchelewesha kazi kupungue.",
  },
  {
    title: "Kuweka uwazi wa malipo",
    description: "Kuonyesha makadirio, escrow, kamisheni na malipo ya mafundi kwa ufuatiliaji rahisi.",
  },
  {
    title: "Kuboresha ubora wa huduma",
    description: "Kuweka taarifa za kazi, fundi, vifaa na maendeleo sehemu moja kwa maamuzi bora.",
  },
];

let selectedJobId = jobs[0].id;
let activeFilter = "all";

const money = new Intl.NumberFormat("sw-TZ", {
  style: "currency",
  currency: "TZS",
  maximumFractionDigits: 0,
});

const statusLabels = {
  open: "Wazi",
  assigned: "Imepangiwa",
  done: "Imekamilika",
};

const jobList = document.querySelector("#jobList");
const jobDetail = document.querySelector("#jobDetail");
const requestRows = document.querySelector("#requestRows");
const fundiGrid = document.querySelector("#fundiGrid");
const equipmentGrid = document.querySelector("#equipmentGrid");
const objectiveList = document.querySelector("#objectiveList");
const timeline = document.querySelector("#timeline");
const searchInput = document.querySelector("#searchInput");
const requestDialog = document.querySelector("#requestDialog");
const requestForm = document.querySelector("#requestForm");
const heroControl = document.querySelector("#heroControl");

function filteredJobs() {
  const query = searchInput.value.trim().toLowerCase();
  return jobs.filter((job) => {
    const matchesFilter = activeFilter === "all" || job.status === activeFilter;
    const searchable = `${job.customer} ${job.service} ${job.location} ${job.fundi}`.toLowerCase();
    return matchesFilter && searchable.includes(query);
  });
}

function renderMetrics() {
  document.querySelector("#newRequests").textContent = jobs.filter((job) => job.status === "open").length;
  document.querySelector("#activeJobs").textContent = jobs.filter((job) => job.status === "assigned").length;
  document.querySelector("#availableFundis").textContent = fundis.filter((fundi) => fundi.available).length;
  const revenue = jobs.filter((job) => job.status === "done").reduce((total, job) => total + job.estimate, 0);
  document.querySelector("#weeklyRevenue").textContent = money.format(revenue);
}

function renderJobs() {
  const visibleJobs = filteredJobs();
  if (!visibleJobs.some((job) => job.id === selectedJobId) && visibleJobs[0]) {
    selectedJobId = visibleJobs[0].id;
  }

  jobList.innerHTML = visibleJobs
    .map(
      (job) => `
        <article class="job-card ${job.id === selectedJobId ? "active" : ""}" data-job-id="${job.id}">
          <div class="job-card-header">
            <div>
              <h3>${job.service} - ${job.location}</h3>
              <div class="job-meta">${job.customer} - ${job.time}</div>
            </div>
            <span class="badge ${job.status}">${statusLabels[job.status]}</span>
          </div>
          <p>${job.description}</p>
          <div class="job-card-footer">
            <strong>${money.format(job.estimate)}</strong>
            <span class="job-meta">${job.urgency}</span>
          </div>
        </article>
      `,
    )
    .join("");

  if (!visibleJobs.length) {
    jobList.innerHTML = `<article class="job-card"><h3>Hakuna matokeo</h3><p>Badilisha utafutaji au kichujio.</p></article>`;
  }

  document.querySelectorAll(".job-card[data-job-id]").forEach((card) => {
    card.addEventListener("click", () => {
      selectedJobId = Number(card.dataset.jobId);
      renderJobs();
      renderDetail();
    });
  });
}

function renderDetail() {
  const job = jobs.find((item) => item.id === selectedJobId) || filteredJobs()[0];
  if (!job) {
    jobDetail.innerHTML = `<h3>Hakuna kazi</h3><p>Hakuna kazi inayolingana na utafutaji wako.</p>`;
    return;
  }

  jobDetail.innerHTML = `
    <span class="badge ${job.status}">${statusLabels[job.status]}</span>
    <h3>${job.service} kwa ${job.customer}</h3>
    <p>${job.description}</p>
    <div class="detail-row"><span>Simu</span><strong>${job.phone}</strong></div>
    <div class="detail-row"><span>Eneo</span><strong>${job.location}</strong></div>
    <div class="detail-row"><span>Fundi</span><strong>${job.fundi}</strong></div>
    <div class="detail-row"><span>Muda</span><strong>${job.time}</strong></div>
    <div class="detail-row"><span>Makadirio</span><strong>${money.format(job.estimate)}</strong></div>
    <button class="primary-button" type="button" id="assignButton">
      ${job.status === "open" ? "Pangia Fundi" : "Angalia Maendeleo"}
    </button>
  `;

  document.querySelector("#assignButton").addEventListener("click", () => {
    if (job.status === "open") {
      job.status = "assigned";
      job.fundi = "Rashid Ally";
      renderAll();
    }
  });
}

function renderRequests() {
  requestRows.innerHTML = jobs
    .map(
      (job) => `
        <tr>
          <td>${job.customer}</td>
          <td>${job.service}</td>
          <td>${job.location}</td>
          <td><span class="badge ${job.status}">${statusLabels[job.status]}</span></td>
          <td>${money.format(job.estimate)}</td>
        </tr>
      `,
    )
    .join("");
}

function renderFundis() {
  fundiGrid.innerHTML = fundis
    .map(
      (fundi) => `
        <article class="fundi-card">
          <h3>${fundi.name}</h3>
          <span>${fundi.skill} - ${fundi.area}</span>
          <p class="rating">${fundi.rating.toFixed(1)} / 5.0</p>
          <p>${fundi.jobs} kazi zilizokamilika</p>
          <span class="badge ${fundi.available ? "assigned" : "done"}">
            ${fundi.available ? "Yuko tayari" : "Ana kazi"}
          </span>
        </article>
      `,
    )
    .join("");
}

function renderEquipment() {
  equipmentGrid.innerHTML = equipment
    .map(
      (item) => `
        <article class="equipment-card">
          <div class="equipment-icon">${item.icon}</div>
          <span>${item.area}</span>
          <h3>${item.title}</h3>
          <p>${item.description}</p>
        </article>
      `,
    )
    .join("");
}

function renderObjectives() {
  objectiveList.innerHTML = objectives
    .map(
      (objective, index) => `
        <article class="objective-card">
          <span>Objective ${index + 1}</span>
          <h3>${objective.title}</h3>
          <p>${objective.description}</p>
        </article>
      `,
    )
    .join("");
}

function renderTimeline() {
  timeline.innerHTML = jobs
    .filter((job) => job.status !== "done")
    .map(
      (job) => `
        <article class="timeline-item">
          <strong>${job.time}</strong>
          <div>
            <h3>${job.service} - ${job.location}</h3>
            <span>${job.customer} - ${job.fundi}</span>
          </div>
          <span class="badge ${job.status}">${statusLabels[job.status]}</span>
        </article>
      `,
    )
    .join("");
}

function renderAll() {
  renderMetrics();
  renderJobs();
  renderDetail();
  renderRequests();
  renderFundis();
  renderEquipment();
  renderObjectives();
  renderTimeline();
}

document.querySelectorAll(".nav-item").forEach((button) => {
  button.addEventListener("click", () => {
    document.querySelectorAll(".nav-item").forEach((item) => item.classList.remove("active"));
    document.querySelectorAll(".content-view").forEach((view) => view.classList.remove("active"));
    button.classList.add("active");
    document.querySelector(`#${button.dataset.view}`).classList.add("active");
  });
});

document.querySelectorAll("[data-filter]").forEach((button) => {
  button.addEventListener("click", () => {
    document.querySelectorAll("[data-filter]").forEach((item) => item.classList.remove("active"));
    button.classList.add("active");
    activeFilter = button.dataset.filter;
    renderJobs();
    renderDetail();
  });
});

document.querySelectorAll("[data-open-request]").forEach((button) => {
  button.addEventListener("click", () => requestDialog.showModal());
});

document.querySelectorAll("[data-background]").forEach((button) => {
  button.addEventListener("click", () => {
    document.querySelectorAll("[data-background]").forEach((item) => item.classList.remove("active"));
    button.classList.add("active");
    heroControl.classList.remove("bg-site", "bg-equipment", "bg-blueprint");
    heroControl.classList.add(button.dataset.background);
  });
});

requestForm.addEventListener("submit", (event) => {
  if (event.submitter?.value !== "submit") return;
  const formData = new FormData(requestForm);
  jobs.unshift({
    id: Date.now(),
    customer: formData.get("customer"),
    phone: formData.get("phone"),
    service: formData.get("service"),
    location: formData.get("location"),
    description: formData.get("description"),
    status: "open",
    estimate: 70000,
    urgency: "Mpya",
    fundi: "Haijapangwa",
    time: "Leo",
  });
  selectedJobId = jobs[0].id;
  requestForm.reset();
  renderAll();
});

searchInput.addEventListener("input", () => {
  renderJobs();
  renderDetail();
});

window.SmartFundiAuth?.syncSessionName();
renderAll();
