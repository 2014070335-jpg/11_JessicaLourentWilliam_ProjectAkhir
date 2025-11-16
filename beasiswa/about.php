<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tentang Kami - Platform Beasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .nav-links a:hover, .nav-links a.active{
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
        @media (max-width:768px){.nav-links{display:none}}

        /* BREADCRUMB */
        .breadcrumb{
            max-width:1200px;
            margin:0 auto;
            padding:16px 24px;
            font-size:13px;
        }
        .breadcrumb a{color:var(--accent);text-decoration:none}

        /* SECTION */
        .section{
            max-width:1200px;
            margin:0 auto;
            padding:60px 24px;
        }
        .section-title{
            font-size:40px;
            color:#fff;
            margin-bottom:18px;
            font-weight:700;
        }
        .section-subtitle{
            font-size:16px;
            color:var(--light);
            margin-bottom:48px;
            max-width:800px;
        }

        /* ABOUT INTRO */
        .about-intro{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:48px;
            align-items:center;
            margin-bottom:80px;
        }
        .intro-text h3{
            color:#fff;
            font-size:28px;
            margin-bottom:18px;
        }
        .intro-text p{
            color:var(--light);
            line-height:1.8;
            margin-bottom:14px;
            font-size:15px;
        }
        .intro-image{
            position:relative;
            height:400px;
            border-radius:14px;
            overflow:hidden;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.06);
        }
        .intro-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        /* PEMBIMBING SECTION */
        .pembimbing-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:28px;
            margin-bottom:80px;
        }
        .pembimbing-card{
            background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(0,0,0,0.03));
            border:1px solid rgba(255,255,255,0.04);
            border-radius:12px;
            overflow:hidden;
            transition:all 0.3s;
        }
        .pembimbing-card:hover{
            border-color:var(--accent);
            background:rgba(255,255,255,0.05);
            transform:translateY(-4px);
        }
        .pembimbing-image{
            width:100%;
            height:280px;
            background:rgba(255,255,255,0.04);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:80px;
            overflow:hidden;
        }
        .pembimbing-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .pembimbing-content{
            padding:24px;
        }
        .pembimbing-name{
            font-size:18px;
            color:#fff;
            margin-bottom:6px;
            font-weight:600;
        }
        .pembimbing-role{
            color:var(--accent);
            font-size:13px;
            font-weight:600;
            margin-bottom:8px;
        }
        .pembimbing-education{
            font-size:13px;
            color:var(--light);
            line-height:1.6;
        }
        .pembimbing-social{
            display:flex;
            gap:10px;
            margin-top:14px;
        }
        .pembimbing-social a{
            width:32px;
            height:32px;
            border-radius:6px;
            background:rgba(255,122,89,0.1);
            color:var(--accent);
            display:flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
            transition:all 0.3s;
            font-size:14px;
        }
        .pembimbing-social a:hover{
            background:var(--accent);
            color:#082033;
        }

        /* TESTIMONI SECTION */
        .testimoni-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
            gap:24px;
            margin-bottom:60px;
        }
        .testimoni-card{
            background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(0,0,0,0.03));
            border:1px solid rgba(255,255,255,0.04);
            border-radius:12px;
            padding:28px;
            position:relative;
        }
        .testimoni-card::before{
            content:'❝';
            position:absolute;
            top:12px;
            left:18px;
            font-size:48px;
            color:rgba(255,122,89,0.2);
        }
        .testimoni-text{
            color:var(--light);
            font-size:14px;
            line-height:1.7;
            margin-bottom:18px;
            font-style:italic;
            position:relative;
            z-index:1;
        }
        .testimoni-author{
            display:flex;
            gap:12px;
            align-items:center;
        }
        .testimoni-avatar{
            width:48px;
            height:48px;
            border-radius:50%;
            background:linear-gradient(135deg,var(--accent),#ffb085);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-weight:700;
            font-size:20px;
        }
        .testimoni-info h4{
            color:#fff;
            margin:0;
            font-size:15px;
        }
        .testimoni-info p{
            color:var(--muted);
            font-size:12px;
            margin:4px 0 0;
        }
        .testimoni-rating{
            color:var(--accent);
            font-size:12px;
        }

        /* SOSIAL MEDIA SECTION */
        .sosial-container{
            text-align:center;
            padding:60px 24px;
            background:rgba(255,255,255,0.02);
            border-radius:14px;
            border:1px solid rgba(255,255,255,0.04);
        }
        .sosial-title{
            font-size:28px;
            color:#fff;
            margin-bottom:12px;
            font-weight:600;
        }
        .sosial-subtitle{
            color:var(--light);
            margin-bottom:32px;
        }
        .sosial-links{
            display:flex;
            gap:16px;
            justify-content:center;
            flex-wrap:wrap;
        }
        .sosial-link{
            width:60px;
            height:60px;
            border-radius:10px;
            background:rgba(255,122,89,0.1);
            color:var(--accent);
            display:flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
            font-size:24px;
            transition:all 0.3s;
            border:1px solid rgba(255,122,89,0.2);
        }
        .sosial-link:hover{
            background:var(--accent);
            color:#082033;
            transform:translateY(-4px);
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
            .section-title{font-size:28px}
            .about-intro{grid-template-columns:1fr;gap:32px}
            .intro-image{height:300px}
            .pembimbing-grid{grid-template-columns:1fr}
            .testimoni-grid{grid-template-columns:1fr}
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
            <li><a href="index.php#beasiswa">Beasiswa</a></li>
            <li><a href="index.php#universitas">Universitas</a></li>
            <li><a href="about.php" class="active">Tentang</a></li>
        </ul>
        <div class="nav-buttons">
            <a href="admin_login.php" class="btn-login">Admin</a>
            <a href="daftarmember.php" class="btn-daftar">Daftar</a>
        </div>
    </div>
</nav>

<!-- BREADCRUMB -->
<div class="breadcrumb">
    <a href="index.php">Home</a> / <span>Tentang Kami</span>
</div>

<!-- INTRO SECTION -->
<section class="section">
    <h1 class="section-title">Tentang Kami</h1>
    <p class="section-subtitle">Kami adalah agensi terpercaya yang membantu ribuan siswa meraih beasiswa impian mereka ke universitas terkemuka di Indonesia dan mancanegara.</p>

    <div class="about-intro">
        <div class="intro-text">
            <h3>Misi Kami</h3>
            <p>Memberikan akses pendidikan berkualitas kepada semua orang tanpa terkendala masalah finansial. Kami berkomitmen untuk membimbing setiap siswa menemukan peluang beasiswa terbaik sesuai dengan kemampuan dan impian mereka.</p>
            <p>Dengan pengalaman lebih dari 10 tahun, tim profesional kami telah membantu lebih dari 5000 siswa mendapatkan beasiswa penuh di universitas ternama.</p>
            <p>Kami percaya bahwa setiap siswa berhak mendapatkan kesempatan untuk belajar dan berkembang melalui pendidikan berkualitas.</p>
        </div>
        <div class="intro-image">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=400&fit=crop" alt="Tim Beasiswa Manager">
        </div>
    </div>
</section>

<!-- PEMBIMBING SECTION -->
<section class="section">
    <h2 class="section-title">Tim Pembimbing Kami</h2>
    <p class="section-subtitle">Para profesional berpengalaman siap membimbing perjalanan akademik Anda</p>

    <div class="pembimbing-grid">
        <div class="pembimbing-card">
            <div class="pembimbing-image">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=350&fit=crop" alt="Budi Santoso">
            </div>
            <div class="pembimbing-content">
                <div class="pembimbing-name">Budi Santoso</div>
                <div class="pembimbing-role">Direktur Eksekutif</div>
                <div class="pembimbing-education">
                    <strong>Pendidikan:</strong><br>
                    • S3 Pendidikan - Universitas Indonesia<br>
                    • S2 Manajemen Pendidikan - ITB<br>
                    • S1 Teknik - Universitas Gadjah Mada
                </div>
                <div class="pembimbing-social">
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <div class="pembimbing-card">
            <div class="pembimbing-image">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=350&fit=crop" alt="Siti Nurhaliza">
            </div>
            <div class="pembimbing-content">
                <div class="pembimbing-name">Siti Nurhaliza</div>
                <div class="pembimbing-role">Kepala Program Beasiswa</div>
                <div class="pembimbing-education">
                    <strong>Pendidikan:</strong><br>
                    • S2 International Relations - Universitas Airlangga<br>
                    • S1 Hukum - Universitas Diponegoro<br>
                    • Sertifikasi Education Counselor
                </div>
                <div class="pembimbing-social">
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <div class="pembimbing-card">
            <div class="pembimbing-image">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=350&fit=crop" alt="Ahmad Hidayat">
            </div>
            <div class="pembimbing-content">
                <div class="pembimbing-name">Ahmad Hidayat</div>
                <div class="pembimbing-role">Konsultan Akademik</div>
                <div class="pembimbing-education">
                    <strong>Pendidikan:</strong><br>
                    • S2 Fisika - Institut Teknologi Bandung<br>
                    • S1 Fisika - Universitas Indonesia<br>
                    • Sertifikasi TOEFL & IELTS
                </div>
                <div class="pembimbing-social">
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONI SECTION -->
<section class="section">
    <h2 class="section-title">Testimoni Alumni</h2>
    <p class="section-subtitle">Kisah sukses dari alumni yang telah meraih beasiswa impian mereka</p>

    <div class="testimoni-grid">
        <div class="testimoni-card">
            <div class="testimoni-text">Berkat bimbingan tim Beasiswa Manager, saya berhasil mendapatkan beasiswa penuh ke Universitas Indonesia. Proses konsultasi sangat detail dan membantu saya mempersiapkan aplikasi dengan sempurna. Rekomendasi saya, percayakan perjalanan akademik Anda kepada mereka!</div>
            <div class="testimoni-author">
                <div class="testimoni-avatar">RD</div>
                <div class="testimoni-info">
                    <h4>Raditya Dimas</h4>
                    <p>Mahasiswa UI - Teknik Informatika</p>
                    <div class="testimoni-rating">★★★★★</div>
                </div>
            </div>
        </div>

        <div class="testimoni-card">
            <div class="testimoni-text">Saya awalnya merasa pesimis untuk mendapatkan beasiswa karena persaingan yang ketat. Namun setelah berkonsultasi dengan team Beasiswa Manager, mindset saya berubah. Mereka memberikan strategi jitu dan dukungan moral yang luar biasa.</div>
            <div class="testimoni-author">
                <div class="testimoni-avatar">AN</div>
                <div class="testimoni-info">
                    <h4>Aisya Nur</h4>
                    <p>Mahasiswa ITB - Teknik Sipil</p>
                    <div class="testimoni-rating">★★★★★</div>
                </div>
            </div>
        </div>

        <div class="testimoni-card">
            <div class="testimoni-text">Layanan mereka sangat profesional dan responsif. Setiap pertanyaan saya dijawab dengan detail, dan mereka membantu saya dari awal hingga akhir proses pendaftaran. Akhirnya saya diterima di UGM dengan beasiswa penuh!</div>
            <div class="testimoni-author">
                <div class="testimoni-avatar">MR</div>
                <div class="testimoni-info">
                    <h4>Muhammad Rifqi</h4>
                    <p>Mahasiswa UGM - Kedokteran</p>
                    <div class="testimoni-rating">★★★★★</div>
                </div>
            </div>
        </div>

        <div class="testimoni-card">
            <div class="testimoni-text">Saya sangat puas dengan konsultasi dan bimbingan yang diberikan. Tim mereka sangat memahami kebutuhan saya dan memberikan solusi yang tepat sasaran. Sekarang saya belajar di universitas impian saya dengan beasiswa penuh!</div>
            <div class="testimoni-author">
                <div class="testimoni-avatar">SP</div>
                <div class="testimoni-info">
                    <h4>Sinta Puspita</h4>
                    <p>Mahasiswa UNAIR - Psikologi</p>
                    <div class="testimoni-rating">★★★★★</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SOSIAL MEDIA SECTION -->
<section class="section">
    <div class="sosial-container">
        <h2 class="sosial-title">Ikuti Kami di Media Sosial</h2>
        <p class="sosial-subtitle">Dapatkan tips, berita beasiswa, dan informasi terbaru langsung dari kami</p>
        <div class="sosial-links">
            <a href="https://facebook.com/beasiswamanager" title="Facebook" target="_blank">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://instagram.com/beasiswamanager" title="Instagram" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://twitter.com/beasiswamanager" title="Twitter" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://linkedin.com/company/beasiswamanager" title="LinkedIn" target="_blank">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="https://youtube.com/beasiswamanager" title="YouTube" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="mailto:info@beasiswa.com" title="Email">
                <i class="fas fa-envelope"></i>
            </a>
            <a href="https://wa.me/628123456789" title="WhatsApp" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
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