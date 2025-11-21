<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrinergy.id | Agriculture Energy Monitoring</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="main.css">
</head>

<body class="light-mode">
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

            <!-- MENU (TAMBAHAN BARU) -->
            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Monitoring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data.php">Data Tabel</a>
                </li>
            </ul>

            <!-- DARK MODE TOGGLE -->
            <span class="theme-toggle ms-auto" id="toggleTheme">
                <i class="bi bi-moon-stars" id="theme-icon"></i>
            </span>

        </div>
    </nav>


    <!-- Hero / Header section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-lg-8">
                    <h1 class="title-header mb-2">Realtime Monitoring PLTS Agrinergy</h1>
                    <p class="subtitle-header mb-0">
                        Platform pemantauan <span class="highlight">energi surya untuk pertanian</span> yang
                        memudahkan petani Desa Sungai Merdeka memantau tegangan, arus, daya, energi, dan intensitas
                        cahaya secara online 24/7.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end text-start mt-3 mt-lg-0">
                    <span class="badge rounded-pill live-badge">
                        <span class="live-dot"></span> LIVE DATA
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Cards -->
    <div class="container my-4">
        <div class="row g-4">

            <!-- STATUS DEVICE -->
            <div class="col-md-4">
                <div class="card card-custom status-card" id="device-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label text-light">Status Perangkat</p>
                            <h4 class="card-value text-light fw-bold" id="status-device">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-wifi icon-large"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terakhir update -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Terakhir Diperbarui</p>
                            <h5 class="card-value-sm" id="data-waktu">Memuat...</h5>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-clock icon-large"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cahaya -->
            <div class="col-md-4">
                <div class="card card-custom accent-sun">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Cahaya (LUX)</p>
                            <h4 class="card-value" id="data-cahaya">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-brightness-high icon-large"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tegangan -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Tegangan AC</p>
                            <h4 class="card-value" id="data-tegangan">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-lightning-charge icon-large text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Arus -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Arus AC</p>
                            <h4 class="card-value" id="data-arus">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-lightning-charge icon-large text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daya Power -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Daya (Power)</p>
                            <h4 class="card-value" id="data-power">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-plug icon-large text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Energy -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Energi (kWh)</p>
                            <h4 class="card-value" id="data-energy">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-battery-full icon-large text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Frekuensi -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Frekuensi AC</p>
                            <h4 class="card-value" id="data-frequency">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-soundwave icon-large text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Power Factor -->
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-label">Power Factor</p>
                            <h4 class="card-value" id="data-pf">Memuat...</h4>
                        </div>
                        <div class="card-icon-wrap">
                            <i class="bi bi-graph-up icon-large text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUHU & KELEMBAPAN -->
            <div class="d-flex justify-content-between gap-3 flex-wrap">
                <!-- Temperature -->
                <div class="col-md-4 flex-grow-1">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-label">Suhu</p>
                                <h4 class="card-value" id="data-temp">Memuat...</h4>
                            </div>
                            <div class="card-icon-wrap">
                                <i class="bi bi-thermometer-half icon-large"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Humidity -->
                <div class="col-md-4 flex-grow-1">
                    <div class="card card-custom">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-label">Kelembapan</p>
                                <h4 class="card-value" id="data-hum">Memuat...</h4>
                            </div>
                            <div class="card-icon-wrap">
                                <i class="bi bi-droplet icon-large"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="scripts.js"></script>

    <!-- DARK MODE SCRIPT -->
    <script>
        const htmlBody = document.body;
        const themeIcon = document.getElementById("theme-icon");
        htmlBody.style.transition = "background-color 0.5s ease, color 0.5s ease";

        // Load theme dari localStorage
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
    </script>

</body>

</html>