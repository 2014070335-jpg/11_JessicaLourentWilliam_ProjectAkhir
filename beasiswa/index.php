<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Beasiswa - Platform Pendaftaran Beasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg1:#071129;
            --bg2:#0f2949;
            --accent:#ff7a59;
            --muted:#cbd5e1;
            --light:#e8f0ff;
        }
        *{margin:0;padding:0;box-sizing:border-box}
        body{
            font-family:"Poppins",sans-serif;
            background:linear-gradient(135deg,var(--bg1),var(--bg2));
            color:var(--muted);
            min-height:100vh;
        }
        /* NAVBAR */
        nav{
            background:rgba(7,17,41,0.95);
            backdrop-filter:blur(8px);
            border-bottom:1px solid rgba(255,255,255,0.05);
            padding:16px 0;
            position:sticky;
            top:0;
            z-index:100;
        }
        .nav-container{
            max-width:1200px;
            margin:0 auto;
            padding:0 24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }
        .nav-brand{
            display:flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
            color:#fff;
            font-size:18px;
            font-weight:700;
        }
        .nav-logo{
            width:40px;
            height:40px;
            background:linear-gradient(135deg,var(--accent),#ffb085);
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-weight:700;
        }
        .nav-links{
            display:flex;
            list-style:none;
            gap:24px;
        }
        .nav-links a{
            color:var(--muted);
            text-decoration:none;
            font-size:14px;
            transition:color 0.3s;
        }
        .nav-links a:hover{
            color:var(--accent);
        }
        .nav-buttons{
            display:flex;
            gap:10px;
        }
        .btn-login{
            padding:9px 16px;
            border-radius:8px;
            border:1px solid rgba(255,255,255,0.1);
            background:transparent;
            color:var(--muted);
            cursor:pointer;
            font-size:13px;
            text-decoration:none;
            transition:all 0.3s;
            font-family:"Poppins",sans-serif;
        }
        .btn-login:hover{
            border-color:var(--accent);
            color:var(--accent);
        }
        .btn-daftar{
            padding:9px 16px;
            border-radius:8px;
            background:linear-gradient(90deg,var(--accent),#ffb085);
            color:#082033;
            border:none;
            cursor:pointer;
            font-size:13px;
            font-weight:600;
            text-decoration:none;
            transition:all 0.3s;
            font-family:"Poppins",sans-serif;
        }
        .btn-daftar:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 20px rgba(255,122,89,0.3);
        }
        @media (max-width:768px){
            .nav-links{display:none}
        }

        /* HERO SECTION */
        .hero{
            max-width:1200px;
            margin:0 auto;
            padding:80px 24px;
            text-align:center;
        }
        .hero h1{
            font-size:52px;
            color:#fff;
            margin-bottom:16px;
            line-height:1.2;
        }
        .hero p{
            font-size:18px;
            color:var(--light);
            margin-bottom:32px;
            max-width:600px;
            margin-left:auto;
            margin-right:auto;
        }
        .hero-buttons{
            display:flex;
            gap:14px;
            justify-content:center;
            flex-wrap:wrap;
        }
        .btn-primary{
            padding:14px 28px;
            background:linear-gradient(90deg,var(--accent),#ffb085);
            color:#082033;
            border:none;
            border-radius:10px;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:all 0.3s;
            text-decoration:none;
            font-family:"Poppins",sans-serif;
        }
        .btn-primary:hover{
            transform:translateY(-3px);
            box-shadow:0 12px 32px rgba(255,122,89,0.3);
        }
        .btn-secondary{
            padding:14px 28px;
            background:transparent;
            color:var(--accent);
            border:2px solid var(--accent);
            border-radius:10px;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:all 0.3s;
            text-decoration:none;
            font-family:"Poppins",sans-serif;
        }
        .btn-secondary:hover{
            background:rgba(255,122,89,0.1);
        }

        /* SECTION TITLE */
        .section{
            max-width:1200px;
            margin:0 auto;
            padding:60px 24px;
        }
        .section-title{
            font-size:32px;
            color:#fff;
            margin-bottom:48px;
            text-align:center;
        }

        /* BEASISWA GRID */
        .beasiswa-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:24px;
            margin-bottom:40px;
        }
        .beasiswa-card{
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:12px;
            padding:24px;
            transition:all 0.3s;
            cursor:pointer;
        }
        .beasiswa-card:hover{
            background:rgba(255,255,255,0.08);
            border-color:var(--accent);
            transform:translateY(-4px);
        }
        .beasiswa-icon{
            font-size:40px;
            margin-bottom:12px;
        }
        .beasiswa-card h3{
            color:#fff;
            font-size:18px;
            margin-bottom:8px;
        }
        .beasiswa-card p{
            color:var(--light);
            font-size:14px;
            line-height:1.6;
            margin-bottom:14px;
        }
        .beasiswa-badge{
            display:inline-block;
            background:rgba(255,122,89,0.15);
            color:var(--accent);
            padding:6px 12px;
            border-radius:6px;
            font-size:12px;
            font-weight:600;
        }

        /* UNIVERSITAS SECTION */
        .universitas-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:20px;
        }
        .univ-card{
            position:relative;
            border-radius:12px;
            overflow:hidden;
            height:280px;
            background:linear-gradient(135deg,var(--bg1),var(--bg2));
            border:1px solid rgba(255,255,255,0.06);
            transition:all 0.3s;
        }
        .univ-card:hover{
            transform:scale(1.05);
            border-color:var(--accent);
        }
        .univ-card img{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:all 0.3s;
        }
        .univ-card:hover img{
            filter:brightness(1.1);
        }
        .univ-overlay{
            position:absolute;
            bottom:0;
            left:0;
            right:0;
            background:linear-gradient(180deg,transparent,rgba(7,17,41,0.95));
            padding:20px;
            color:#fff;
        }
        .univ-name{
            font-size:16px;
            font-weight:600;
            margin:0;
        }
        .univ-desc{
            font-size:12px;
            color:var(--light);
            margin:4px 0 0;
        }

        /* FOOTER */
        footer{
            background:rgba(7,17,41,0.8);
            border-top:1px solid rgba(255,255,255,0.05);
            padding:40px 24px;
            text-align:center;
            color:var(--light);
            font-size:13px;
        }

        @media (max-width:768px){
            .hero h1{font-size:32px}
            .hero p{font-size:16px}
            .hero-buttons{flex-direction:column}
            .btn-primary, .btn-secondary{width:100%}
            .section-title{font-size:24px}
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-container">
        <a href="index.php" class="nav-brand">
            <div class="nav-logo">BM</div>
            Beasiswa
        </a>

        <ul class="nav-links">
            <li><a href="#beasiswa">Beasiswa</a></li>
            <li><a href="#universitas">Universitas</a></li>
            <li><a href="about.php">About</a></li>
        </ul>

        <div class="nav-buttons">
            <a href="admin_login.php" class="btn-login">Admin</a>
            <a href="daftarmember.php" class="btn-daftar">Daftar</a>
        </div>
    </div>
</nav>


<!-- HERO -->
<section class="hero">
    <h1>Raih Beasiswa Impianmu</h1>
    <p>Agensi terpercaya untuk mendapatkan beasiswa dari universitas terkemuka di seluruh Indonesia.</p>
    <div class="hero-buttons">
        <a href="#beasiswa" class="btn-primary">Lihat Beasiswa</a>
        <a href="daftarmember.php" class="btn-secondary">Daftar Sekarang</a>
    </div>
</section>

<!-- BEASISWA SECTION -->
<section class="section" id="beasiswa">
    <h2 class="section-title">Jenis-Jenis Beasiswa Tersedia</h2>
    <div class="beasiswa-grid">
        <div class="beasiswa-card">
            <div class="beasiswa-icon">🎓</div>
            <h3>Beasiswa Penuh</h3>
            <p>Mencakup biaya pendidikan, akomodasi, dan tunjangan bulanan untuk seluruh masa studi.</p>
            <span class="beasiswa-badge">Sangat Kompetitif</span>
        </div>

        <div class="beasiswa-card">
            <div class="beasiswa-icon">🎓</div>
            <h3>Beasiswa Partial</h3>
            <p>Beasiswa yang mencakup sebagian dari biaya pendidikan dan kebutuhan akademik Anda.</p>
            <span class="beasiswa-badge">Moderat</span>
        </div>

        <div class="beasiswa-card">
            <div class="beasiswa-icon">🎓</div>
            <h3>Beasiswa Prestasi</h3>
            <p>Diberikan kepada siswa dengan prestasi akademik dan non-akademik yang luar biasa.</p>
            <span class="beasiswa-badge">Berbakat</span>
        </div>

        <div class="beasiswa-card">
            <div class="beasiswa-icon">🎓</div>
            <h3>Beasiswa Sosial</h3>
            <p>Program khusus untuk siswa kurang mampu yang memiliki potensi akademik tinggi.</p>
            <span class="beasiswa-badge">Berkomitmen</span>
        </div>

        <div class="beasiswa-card">
            <div class="beasiswa-icon">🎓</div>
            <h3>Beasiswa Internasional</h3>
            <p>Peluang untuk belajar di universitas luar negeri dengan dukungan finansial penuh.</p>
            <span class="beasiswa-badge">Global</span>
        </div>

        <div class="beasiswa-card">
            <div class="beasiswa-icon">🎓</div>
            <h3>Beasiswa Riset</h3>
            <p>Untuk mahasiswa yang ingin melakukan penelitian mendalam di bidang tertentu.</p>
            <span class="beasiswa-badge">Inovatif</span>
        </div>
    </div>
</section>

<!-- UNIVERSITAS SECTION -->
<section class="section" id="universitas">
    <h2 class="section-title">Universitas Partner Beasiswa</h2>
    <div class="universitas-grid">
        <div class="univ-card">
            <img src="https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=500&h=300&fit=crop" alt="Universitas Indonesia">
            <div class="univ-overlay">
                <h3 class="univ-name">Universitas Indonesia</h3>
                <p class="univ-desc">Jakarta, Indonesia</p>
            </div>
        </div>

        <div class="univ-card">
            <img src="https://images.unsplash.com/photo-1517457373614-b7152f800fd1?w=500&h=300&fit=crop" alt="Institut Teknologi Bandung">
            <div class="univ-overlay">
                <h3 class="univ-name">ITB</h3>
                <p class="univ-desc">Bandung, Indonesia</p>
            </div>
        </div>

        <div class="univ-card">
            <img src="https://images.unsplash.com/photo-1519452575417-564c1401ecc0?w=500&h=300&fit=crop" alt="Universitas Gadjah Mada">
            <div class="univ-overlay">
                <h3 class="univ-name">UGM</h3>
                <p class="univ-desc">Yogyakarta, Indonesia</p>
            </div>
        </div>

        <div class="univ-card">
            <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=500&h=300&fit=crop" alt="Universitas Airlangga">
            <div class="univ-overlay">
                <h3 class="univ-name">Universitas Airlangga</h3>
                <p class="univ-desc">Surabaya, Indonesia</p>
            </div>
        </div>

        <div class="univ-card">
            <img src="https://images.unsplash.com/photo-1495521821757-a1efb6729352?w=500&h=300&fit=crop" alt="Universitas Diponegoro">
            <div class="univ-overlay">
                <h3 class="univ-name">UNDIP</h3>
                <p class="univ-desc">Semarang, Indonesia</p>
            </div>
        </div>

        <div class="univ-card">
            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=500&h=300&fit=crop" alt="Universitas Hasanuddin">
            <div class="univ-overlay">
                <h3 class="univ-name">UNHAS</h3>
                <p class="univ-desc">Makassar, Indonesia</p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>@2025 Platform Beasiswa dibuat oleh JESSICA LOURENT XII5.</p>
    <p>Hubungi kami: info@beasiswa.com | +62 812-3456-7890</p>
</footer>

</body>
</html>