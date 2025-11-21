<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrinergy | Data Monitoring PLTS</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="main.css">
</head>

<body class="light-mode">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm main-navbar">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <span class="logo-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-flower3"></i>
                </span>
                <div class="d-flex flex-column">
                    <span class="fw-bold text-uppercase brand-title">Agrinergy</span>
                    <small class="brand-subtitle">Inovasi Sosial Institut Teknologi Kalimantan</small>
                </div>
            </a>

            <!-- MENU -->
            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Monitoring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="data.php">Data Tabel</a>
                </li>
            </ul>

            <!-- DARK MODE TOGGLE -->
            <span class="theme-toggle ms-auto" id="toggleTheme">
                <i class="bi bi-moon-stars" id="theme-icon"></i>
            </span>
        </div>
    </nav>

    <!-- HERO / HEADER -->
    <section class="hero-section">
        <div class="container">
            <h1 class="title-header mb-2">
                Data Historis Monitoring PLTS Agrinergy
            </h1>
            <p class="subtitle-header mb-0">
                Rekaman data tegangan, arus, daya, energi, cahaya, suhu, dan kelembapan dari sistem monitoring
                <span class="highlight">Agrinergy</span>. Data dapat dianalisis untuk melihat performa harian maupun jangka panjang.
            </p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div class="container my-4 data-section">

        <div class="card card-custom">
            <div class="card-body">

                <!-- TOOLBAR ATAS -->
                <div class="data-toolbar d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="data-icon-wrap d-flex align-items-center justify-content-center">
                            <i class="bi bi-table"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-semibold">Data Monitoring PLTS</h5>
                            <small class="text-muted d-block">
                                Ditampilkan berdasarkan urutan waktu terbaru.
                            </small>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 data-toolbar-actions">
                        <div class="input-group input-group-sm data-search">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="search-input" placeholder="Cari waktu / status / nilai...">
                        </div>

                        <input type="date" class="form-control form-control-sm" id="filter-date">

                        <button class="btn btn-sm btn-outline-success" id="btn-refresh">
                            <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" id="btn-export">
                            <i class="bi bi-download me-1"></i> Export CSV
                        </button>
                    </div>
                </div>

                <!-- TABEL DATA -->
                <div class="table-responsive table-modern">
                    <table class="table align-middle mb-0" id="table-monitoring">
                        <!-- TABEL DATA -->
                        <div class="table-scroll-wrapper">
                            <div class="table-responsive table-modern">
                                <table class="table align-middle mb-0" id="table-monitoring">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Waktu</th>
                                            <th>Tegangan (V)</th>
                                            <th>Arus (A)</th>
                                            <th>Daya (W)</th>
                                            <th>Energi (kWh)</th>
                                            <th>Cahaya (lux)</th>
                                            <th>Suhu (&deg;C)</th>
                                            <th>Kelembapan (%)</th>
                                            <th>Frekuensi (Hz)</th>
                                            <th>Power Factor</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-table-body">
                                        <!-- Baris data akan diisi lewat JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </table>
                </div>


                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                    <div class="data-pagination d-flex gap-2 align-items-center">
                        <button class="btn btn-sm btn-outline-secondary" id="prev-page">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <span id="page-info" class="small">Halaman 1 / 1</span>
                        <button class="btn btn-sm btn-outline-secondary" id="next-page">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <!-- DARK MODE + TABEL SCRIPT -->
    <script>
        // ==== DARK MODE ====
        const htmlBody = document.body;
        const themeIcon = document.getElementById("theme-icon");
        htmlBody.style.transition = "background-color 0.5s ease, color 0.5s ease";

        if (localStorage.getItem("theme") === "dark") {
            htmlBody.classList.remove("light-mode");
            htmlBody.classList.add("dark-mode");
            themeIcon.classList.replace("bi-moon-stars", "bi-brightness-high");
        }

        document.getElementById("toggleTheme").onclick = function() {
            if (htmlBody.classList.contains("light-mode")) {
                htmlBody.classList.replace("light-mode", "dark-mode");
                themeIcon.classList.replace("bi-moon-stars", "bi-brightness-high");
                localStorage.setItem("theme", "dark");
            } else {
                htmlBody.classList.replace("dark-mode", "light-mode");
                themeIcon.classList.replace("bi-brightness-high", "bi-moon-stars");
                localStorage.setItem("theme", "light");
            }
        };

        // ==== TABEL DATA ====
        const API_URL = "api/read.php";

        let currentPage = 1;
        const pageSize = 10; // kalau backendmu pakai pageSize, sesuaikan juga di read.php
        let currentSearch = "";
        let currentDate = "";
        let lastTotalPages = 1;

        // Ambil referensi elemen
        const tbody = document.getElementById("data-table-body");
        const searchInput = document.getElementById("search-input");
        const filterDate = document.getElementById("filter-date");
        const pageInfo = document.getElementById("page-info");
        const btnPrev = document.getElementById("prev-page");
        const btnNext = document.getElementById("next-page");
        const btnRefresh = document.getElementById("btn-refresh");
        const btnExport = document.getElementById("btn-export");

        function renderTable(data, page, totalPages) {
            tbody.innerHTML = "";

            if (!Array.isArray(data) || data.length === 0) {
                const tr = document.createElement("tr");
                tr.innerHTML = `<td colspan="12" class="text-center text-muted py-3">Belum ada data / tidak cocok dengan filter.</td>`;
                tbody.appendChild(tr);
            } else {
                const startIndex = (page - 1) * pageSize;

                data.forEach((row, index) => {
                    const tr = document.createElement("tr");

                    // Sesuaikan nama field ini dengan JSON dari api/read.php
                    const waktu = row.waktu;
                    const tegangan = row.V ?? 0;
                    const arus = row.I ?? 0;
                    const daya = row.P ?? 0;
                    const energi = row.E ?? 0;
                    const cahaya = row.lux ?? 0;
                    const suhu = row.t ?? 0;
                    const kelembapan = row.h ?? 0;
                    const frekuensi = row.f ?? 0;
                    const pf = row.pf ?? 0;
                    const status = row.status ?? "Normal";

                    let badgeClass = "badge bg-success";
                    if (status.toUpperCase() === "WASPADA") {
                        badgeClass = "badge bg-warning text-dark";
                    } else if (status.toUpperCase() === "OFFLINE" || status.toUpperCase() === "ERROR") {
                        badgeClass = "badge bg-danger";
                    }

                    tr.innerHTML = `
                        <td>${startIndex + index + 1}</td>
                        <td>${waktu}</td>
                        <td>${tegangan}</td>
                        <td>${arus}</td>
                        <td>${daya}</td>
                        <td>${energi}</td>
                        <td>${cahaya}</td>
                        <td>${suhu}</td>
                        <td>${kelembapan}</td>
                        <td>${frekuensi}</td>
                        <td>${pf}</td>
                        <td><span class="${badgeClass}">${status}</span></td>
                    `;

                    tbody.appendChild(tr);
                });
            }

            lastTotalPages = totalPages;
            pageInfo.textContent = `Halaman ${page} / ${totalPages}`;
        }

        async function fetchHistory() {
            const params = new URLSearchParams({
                page: currentPage,
                pageSize: pageSize,
                search: currentSearch,
                date: currentDate
            });

            try {
                const res = await fetch(`${API_URL}?${params.toString()}`);
                const json = await res.json();

                console.log("API read.php:", json); // DEBUG: cek di console

                if (!json.success) {
                    tbody.innerHTML = `<tr><td colspan="12" class="text-center text-danger py-3">Gagal memuat data dari server.</td></tr>`;
                    pageInfo.textContent = "Halaman - / -";
                    return;
                }

                renderTable(json.data, json.page ?? 1, json.totalPages ?? 1);
            } catch (err) {
                console.error(err);
                tbody.innerHTML = `<tr><td colspan="12" class="text-center text-danger py-3">Terjadi kesalahan saat mengambil data.</td></tr>`;
                pageInfo.textContent = "Halaman - / -";
            }
        }

        // ==== EVENT SEARCH DENGAN DEBOUNCE ====
        let searchTimeout = null;

        // Ketika user mengetik
        searchInput.addEventListener("input", () => {
            const value = searchInput.value.trim();

            // Kalau teksnya sama, nggak usah nge-fetch lagi
            if (value === currentSearch) return;

            currentSearch = value;
            currentPage = 1;

            // Debounce: tunggu 300ms setelah user berhenti mengetik
            if (searchTimeout) clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                fetchHistory();
            }, 300);
        });

        // Kalau user pencet ENTER → langsung cari saat itu juga
        searchInput.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                currentSearch = searchInput.value.trim();
                currentPage = 1;

                if (searchTimeout) clearTimeout(searchTimeout);
                fetchHistory();
            }
        });


        // Event: filter tanggal
        filterDate.addEventListener("change", () => {
            currentDate = filterDate.value;
            currentPage = 1;
            fetchHistory();
        });


        // Pagination
        btnPrev.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                fetchHistory();
            }
        });

        btnNext.addEventListener("click", () => {
            if (currentPage < lastTotalPages) {
                currentPage++;
                fetchHistory();
            }
        });

        // Refresh: reset filter
        btnRefresh.addEventListener("click", () => {
            searchInput.value = "";
            filterDate.value = "";
            currentSearch = "";
            currentDate = "";
            currentPage = 1;
            fetchHistory();
        });

        btnExport.addEventListener("click", () => {
            const params = new URLSearchParams({
                search: currentSearch,
                date: currentDate
            });

            // Arahkan browser ke export_csv.php → langsung download file
            window.location.href = `api/export_csv.php?${params.toString()}`;
        });

        // Panggil pertama kali setelah halaman load
        document.addEventListener("DOMContentLoaded", () => {
            fetchHistory();
        });
    </script>

</body>

</html>