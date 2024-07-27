<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Harum Asri Jambu</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        
        .bg-image {
            /* The image used */
            background-image: url('assets/img/BG_1.jpg');

            /* Add the blur effect */
            /* filter: blur(8px);
            -webkit-filter: blur(8px); */

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-text {
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.7);
            /* Black w/opacity/see-through */
            color: white;
            font-weight: bold;
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 80%;
            padding: 20px;
            text-align: center;
        }

        .btn-login {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
        }

        h3 {
            font-size: 22px;
            font-weight: 200;
        }

        p {
            font-size: 19px;
            font-weight: 200;
        }



        .footer {
            background-color: #022c43;
            color: #fff;
            padding: 40px 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-columns {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }

        .column {
            flex: 1;
            min-width: 180px;
            margin: 20px 0;
        }

        .column h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .column ul {
            list-style: none;
            padding: 0;
        }

        .column ul li {
            margin-bottom: 10px;
        }

        .column ul li a {
            color: #fff;
            text-decoration: none;
        }

        .column ul li a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            margin-right: 10px;
        }

        .social-icons img {
            width: 24px;
            height: 24px;
        }

        .apps a {
            display: inline-block;
            margin-right: 10px;
        }

        .apps img {
            width: 120px;
            height: 40px;
        }

        .cara-bergabung-section{
            margin: 100px auto;
        }

        .bank-sampah-section,
        .cara-bergabung-section {

            text-align: center;
            padding: 70px 20px;
            margin: auto;
            max-width: 800px;
            /* border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .bg {
            /* The image used */
            background-image: url('assets/img/bg_2.jpg');
            /* Add the blur effect */
            /* filter: blur(8px);
-webkit-filter: blur(8px); */
            /* Full height */
            height: 100%;
            padding-bottom: 100px;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .section-title {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        .section-description {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
        }

        .footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    flex-wrap: wrap;
}

.footer-section {
    flex: 1;
    min-width: 250px;
    margin: 10px;
}

.footer-logo {
    max-width: 100px;
    margin-bottom: 10px;
}

.footer-section p {
    margin: 10px 0;
    line-height: 1.6;
}

.contact-info i, .social-media i {
    margin-right: 10px;
}

.social-icons {
    display: flex;
    gap: 15px;
}

.social-icons a {
    color: #fff;
    font-size: 1.5em;
    text-decoration: none;
}

.social-icons a:hover {
    color: #ddd;
}
    </style>
</head>

<body>
    <div class="bg-image"></div>
    <div class="bg-text">
        <h2>Selamat Datang Di Website Bank Sampah Karang Taruna Unit Rw 013</h2>
        <h3>Jadikan Sampah Bernilai !</h3>
        <button class="btn-login" onclick="login()">Login</button>
        <p></p>
    </div>

    <script>

        function login() {
            // Add your login functionality here
            window.location.href = "<?= base_url('C_Dashboard'); ?>";
        }
    </script>
    <div class="bg">
        <section class="bank-sampah-section">
            <h2 class="section-title">BANK SAMPAH</h2>
            <p class="section-description">
                Mari bergabung dengan Program Bank Sampah Karang Taruna Unit RW 013 dan bersama-sama kita ciptakan lingkungan yang bersih dan sehat! Dengan partisipasi Anda, kita dapat mengubah sampah menjadi sumber daya yang bernilai, mengurangi pencemaran, dan meningkatkan kesadaran akan pentingnya daur ulang. Setiap sampah yang Anda kumpulkan bukan hanya membantu menjaga kebersihan lingkungan, tetapi juga dapat memberikan manfaat ekonomi bagi keluarga dan organisasi kami. Bergabunglah sekarang dan jadilah bagian dari perubahan positif di lingkungan RW 013!
            </p>
        </section>
        <section class="cara-bergabung-section">
            <h2 class="section-title">BAGAIMANA CARA BERGABUNG BANK SAMPAH KARTAR 13 ?!</h2>
            <p class="section-description" style="text-align: left">
                Tahap Bergabung Program Bank Sampah:<br>
                1. Pendaftaran : Masyarakat yang ingin menyetorkan sampah harus mendaftar terlebih dahulu kepada admin bank sampah. <br>
                2. Pemilahan : Sampah harus Dipilah berdasarkan jenisnya <br>
                3. Penimbangan : Sampah Ditimbang untuk mengetahui berat sampah yang akan di setorkan <br>
                4. Mendapatkan Keuntungan : Masyarakat dapat memperoleh sejumlah uang jika sampah berhasih dijual.<br>

            </p>
        </section>
    </div>
  
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section logo-address">
                <img src="assets/img/logo.png"  alt="Bank Sampah Logo" class="footer-logo" style="width: 150px; height: auto;">
                <p>Karang Taruna Unit Rw 013<br>
                </p>
            </div>
            <div class="footer-section contact-info">
                <p><i class="fas fa-map"></i> Bekasi, Perum Bojong Menteng Indah RW 013</p>
                <p><i class="fas fa-phone-alt"></i> (+62) 81298130895</p>
                <p><i class="fas fa-envelope"></i> kartarbmi13@gmail.com</p>
            </div>
            <div class="footer-section social-media">
                <p>Kunjungi Sosial Media Kami!</p>
                <!-- <p>Untuk yang ingin lebih dekat dengan Bank Sampah, silahkan kunjungi sosial media kami dibawah ini!</p> -->
                <div class="social-icons">
                    <a href="https://www.instagram.com/kartar.13"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@kartarbmi13"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.youtube.com/@karangtarunabmi8457"><i class="fab fa-youtube"></i></a>
                    
                </div>
            </div>
        </div>
    </footer>

</body>

</html>