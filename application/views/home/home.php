<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kasirku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Owl Carousel Stylesheet -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 60px; 
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 20px; 
            cursor: pointer;
            font-size: 30px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chatbot-button:hover {
            background-color: #0056b3;
        }

        .chatbot-button .fa-robot {
            font-size: 24px;
        }
    .chat-button {
      position: fixed;
      bottom: 20px;
      right: 50px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 70%;
      padding: 20px;
      cursor: pointer;
      font-size: 24px;
    }
    .chat-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 400px; /* Adjusted width */
            height: 650px; /* Adjusted height */
            border: 3px solid #f1f1f1;
            z-index: 9;
            display: none;
            opacity: 0;
            transform: scale(0.7);
            transition: all 0.3s ease-in-out;
        }

        .chat-popup.show {
            display: block;
            opacity: 1;
            transform: scale(1);
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .chat-header {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            text-align: center;
            position: relative;
        }

        .chat-close {
            position: absolute;
            right: 10px;
            top: 5px;
            font-size: 20px;
            cursor: pointer;
        }

        .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .chat-footer {
            display: flex;
            flex-direction: column;
        }

        .template-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 5px;
            background-color: #f1f1f1;
            border-bottom: 1px solid #ddd;
        }

        .template-buttons button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .template-buttons button:hover {
            background-color: #0056b3;
        }

        .chat-input-container {
            display: flex;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-right: none;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .chat-send {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            cursor: pointer;
        }

        .chat-send:hover {
            background-color: #0056b3;
        }

        .user-inbox, .bot-inbox {
            display: flex;
            margin: 10px 0;
        }

        .user-inbox .msg-header, .bot-inbox .msg-header {
            border-radius: 15px;
            padding: 10px;
            max-width: 75%;
            word-wrap: break-word;
        }

        .user-inbox {
            justify-content: flex-end;
        }

        .user-inbox .msg-header {
            background-color: #007BFF;
            color: white;
        }

        .bot-inbox {
            justify-content: flex-start;
        }

        .bot-inbox .msg-header {
            background-color: #e1e1e1;
            color: black;
        }

        .bot-inbox .icon {
            margin-right: 10px;
        }

        .bot-inbox .icon img {
            width: 40px; 
            height: 40px; 
            border-radius: 50%;
        }
    </style>
  </style>
</head>

<body>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</head>
<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          <div>
            <h1>Kasirku</h1>
            <h2>Memberikan anda kemudahahan dalam mengelola dan mengatur usaha anda dengan Kasirku</h2>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= App Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title">
          <h2>Fitur aplikasi</h2>
          <p>Terdapat beberapa fitur yang akan membantu anda dalam mengelola toko</p>
        </div>

        <div class="row no-gutters">
          <div class="col-xl-7 d-flex align-items-stretch order-2 order-lg-1">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-box"></i>
                  <h4>Pengelolaan data barang</h4>
 
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-receipt"></i>
                  <h4>Laporan</h4>

                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-truck"></i>
                  <h4>Pengelolaan data supplier</h4>
 
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-receipt"></i>
                  <h4>Pengelolaan data transaksi</h4>

                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-user"></i>
                  <h4>Pengelolaan data karyawan</h4>

                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                  <i class="bx bx-category"></i>
                  <h4>Pengelolaan data kategori</h4>

                </div>
              </div>
            </div>
          </div>
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/features.svg" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </section><!-- End App Features Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">

        <div class="section-title">
          <h2>Biaya langganan</h2>
          <p>Nikmati berbagai fitur dari kami dengan berlangganan yang cukup terjangkau</p>
        </div>

        <div class="row no-gutters">

  

          <div class="col-lg-4 box featured" data-aos="fade-up">
            <h3>1 Bulan</h3>
            <h4>Rp. 20.000<span>Rekomendasi</span></h4>
            <ul>
              <li><i class="bx bx-check"></i> Masa aktif selama 30 hari sejak aktif</li>
              <li><i class="bx bx-check"></i> Akses ke semua fitur kasirku</li>
            </ul>
            <a href="<?php echo base_url('index.php/userpanel');?>" class="get-started-btn">Mulai berlangganan</a>
          </div>
        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Berikan masukan anda, karena saran dan kritik anda akan membuat kami berkembang</p>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-6 info">
                <i class="bx bx-map"></i>
                <h4>Alamat</h4>
                <p>Jln. Jambusari Raya<br>Sleman, D.I Yogyakarta</p>
              </div>
              <div class="col-lg-6 info">
                <i class="bx bx-phone"></i>
                <h4>Telepon</h4>
                <p>+62 8 560 4450 227</p>
              </div>
              <div class="col-lg-6 info">
                <i class="bx bx-envelope"></i>
                <h4>Email</h4>
                <p>rigeldonovan@gmail.com</p>
              </div>
              <div class="col-lg-6 info">
                <i class="bx bx-time-five"></i>
                <h4>Jam Kerja</h4>
                <p>Sen - Jum: 9AM - 5PM</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form" data-aos="fade-up">
              <div class="form-group">
                <input placeholder="Your Name" type="text" name="name" class="form-control" id="name" required>
              </div>
              <div class="form-group mt-3">
                <input placeholder="Your Email" type="email" class="form-control" name="email" id="email" required>
              </div>
              <div class="form-group mt-3">
                <input placeholder="Subject" type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea placeholder="Message" class="form-control" name="message" rows="5" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Kasirku</h3>
            <p>
              Jln. Jambusari Raya <br>
              Sleman, D.I Yogyakarta<br>
              <strong>No Telp:</strong> +62 8560 4450 227<br>
              <strong>Email:</strong> rigeldonovan@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Social Media Kami</h4>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- Owl Carousel Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
  $(document).ready(function () {
    $(".testimonials-carousel").owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      items: 1 // Menampilkan satu item per slide
    });
  });
</script>

<!-- Initiate Owl Carousel -->
<script>
  $(document).ready(function () {
    $(".testimonials-carousel").owlCarousel({
      autoplay: true,
      dots: true,
      loop: true,
      items: 1
    });
  });
</script>
<!-- Chatbot Button -->
<button class="chatbot-button" onclick="toggleChat()">
    <i class="fas fa-robot"></i>
</button>
<!-- Chatbot Popup -->
<div class="chat-popup" id="chatPopup">
    <div class="chat-container">
        <div class="chat-header">
            <span class="chat-close" onclick="toggleChat()">&times;</span>
            <h4>Kasirku</h4>
        </div>
        <div class="chat-body" id="chatBody">
        </div>
        <div class="chat-footer">
            <div class="template-buttons">
                <button onclick="sendTemplateMessage('Halo')">Halo</button>
                <button onclick="sendTemplateMessage('Layanan')">Layanan</button>
                <button onclick="sendTemplateMessage('Pembayaran')">Pembayaran</button>
                <button onclick="sendTemplateMessage('Cara Penggunaan Aplikasi')">Cara Penggunaan Aplikasi</button>
            </div>
            <div class="chat-input-container">
                <input type="text" id="chatInput" class="chat-input" placeholder="Ketik pesan...">
                <button class="chat-send" onclick="sendMessage()">Kirim</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function toggleChat() {
        var chatPopup = document.getElementById("chatPopup");
        if (chatPopup.classList.contains("show")) {
            chatPopup.classList.remove("show");
            setTimeout(function() {
                chatPopup.style.display = "none";
            }, 300); // Sesuaikan dengan durasi animasi
        } else {
            chatPopup.style.display = "block";
            setTimeout(function() {
                chatPopup.classList.add("show");
            }, 10); // Delay sedikit agar animasi berjalan
            showInitialMessage();
        }
    }

    function showInitialMessage() {
        if ($('#chatBody').children().length === 0) {
            var botHtml = '<div class="bot-inbox inbox"><div class="icon"><img src="<?php echo base_url('assets/img/chatbot.png');?>" alt="Bot"></div><div class="msg-header"><p>Hai, ada yang bisa saya bantu?</p></div></div>';
            $('#chatBody').append(botHtml);
        }
    }

    function sendMessage() {
        var message = $('#chatInput').val().trim();
        if (message === '') return;

        var userHtml = '<div class="user-inbox inbox"><div class="msg-header"><p>' + message + '</p></div></div>';
        $('#chatBody').append(userHtml);
        $('#chatInput').val('');

        // Tambahkan elemen loading dengan spinner Bootstrap
        var loadingHtml = '<div class="bot-inbox inbox loading"><div class="icon"><img src="<?php echo base_url('assets/img/chatbot.png');?>" alt="Bot"></div><div class="msg-header"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div></div>';
        $('#chatBody').append(loadingHtml);
        $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);

        // Mengirim pertanyaan ke server PHP
        $.ajax({
            url: "<?php echo site_url('chatbot/get_response'); ?>",
            method: "POST",
            data: { question: message },
            dataType: "json",
            success: function(data) {
                setTimeout(function() {
                    $('.loading').remove(); // Hapus elemen loading

                    var botHtml;
                    if (data.answer) {
                        botHtml = '<div class="bot-inbox inbox"><div class="icon"><img src="<?php echo base_url('assets/img/chatbot.png');?>" alt="Bot"></div><div class="msg-header"><p>' + data.answer + '</p></div></div>';
                    } else {
                        $.ajax({
                            url: "/kasirku/api",  // Sesuaikan dengan endpoint API Anda
                            method: "POST",
                            contentType: "application/json",
                            data: JSON.stringify({ question: message }),
                            success: function(data) {
                                botHtml = '<div class="bot-inbox inbox"><div class="icon"><img src="<?php echo base_url('assets/img/chatbot.png');?>" alt="Bot"></div><div class="msg-header"><p>' + data.answer + '</p></div></div>';
                                $('#chatBody').append(botHtml);
                                $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
                            },
                            error: function(xhr, status, error) {
                                console.error("Error:", error);
                                console.error("Status:", status);
                                console.error("Response:", xhr.responseText);
                                botHtml = '<div class="bot-inbox inbox"><div class="msg-header"><p>Maaf, saya tidak mengerti pertanyaan Anda saat ini.</p></div></div>';
                                $('#chatBody').append(botHtml);
                                $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
                            }
                        });
                        return;
                    }
                    $('#chatBody').append(botHtml);
                    $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
                }, 2000); 
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                console.error("Status:", status);
                console.error("Response:", xhr.responseText);
                $('.loading').remove(); 
            }
        });
    }

    function sendTemplateMessage(text) {
        $('#chatInput').val(text);
        sendMessage();
    }
</script>


