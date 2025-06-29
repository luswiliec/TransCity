<head>
 <!-- Animation & Scripts -->
 <link href="css/animate.css" rel="stylesheet">
  <script src="js/jquery-1.12.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script> new WOW().init(); </script>
  
  <!-- Internal Styles -->
  <style>
    /* Global */
    body {
      margin:0;
      font-family: 'Open Sans', sans-serif;
      background: #0d1117;
      color: #c9d1d9;
    }
    a { text-decoration: none; color: #007bff; }
    a:hover { color: #06d28e; }
    
    /* Banner */
    .banners {
      position: relative;
      width: 100%;
      height: 400px;
      overflow: hidden;
      transition: filter .3s;
    }
    .banners-slideshow {
      position: absolute; top:0; left:0;
      width:100%; height:100%;
    }
    .banners-slideshow .slide {
      position:absolute; top:0; left:0;
      width:100%; height:100%;
      object-fit:cover; opacity:0;
      transition: opacity 1.5s ease;
    }
    .banners-slideshow .slide.active { opacity:1; }
    .banners-text {
      position: relative; z-index:2;
      display:flex; align-items:center; justify-content:center;
      height:100%; padding:0 15px;
      text-align:center;
    }
    .banners-text h1 {
      font-size:2rem; font-weight:700;
      background: rgba(0,0,0,0.4);
      padding:10px 20px; border-radius:5px;
      color: #fff;
    }

    /* Services section */
    .holiday { padding:20px 0; }
    .holiday h3 {
      text-align:center; font-weight:700;
      margin-bottom:30px; color:#fff;
    }
    .rom-btm {
      display:flex; flex-wrap:wrap;
      background:#1e2530; border-radius:6px;
      margin-bottom:30px; overflow:hidden;
      box-shadow:0 2px 8px rgba(0,0,0,0.2);
    }
    .rom-btm > div {
      flex:1; min-width:200px;
      padding:20px;
    }
    .room-left { text-align:center; background:#0d213d; }
    .room-midle { background:#0d213d; }
    .room-right { text-align:center; background:#0b2b57; }
    .room-midle h4 { color:#007bff; margin-top:0; }
    .view {
      display:inline-block; padding:8px 16px;
      background:#007bff; color:#fff;
      border-radius:4px; transition:background .3s;
      margin-top:10px;
    }
    .view.active, .view:hover {
      background:#06d28e;
      outline:none;
    }

    /* Stats section */
    .routes {
      background:#161b22; padding:40px 0;
      border-top:1px solid #30363d;
      color:#c9d1d9;
    }
    .routes .routes-left {
      text-align:center; margin-bottom:20px;
    }
    .rou-left i {
      font-size:2.5rem; margin-bottom:10px;
      color:#007bff;
    }
    .rou-rgt h3 { font-weight:700; margin-bottom:5px; }

    /* Footer */
    footer {
      background:#0d0f14; color:#c9d1d9;
      padding:40px 0;
      margin-top:40px;
    }
    .footer-container {
      display:flex; flex-wrap:wrap;
      justify-content:space-between;
      max-width:1200px; margin:0 auto;
    }
    .footer-col {
      flex:1; min-width:200px;
      margin:10px;
    }
    .footer-col h4 {
      font-size:1.2rem; margin-bottom:15px;
    }
    .footer-col ul { list-style:none; padding:0; }
    .footer-col ul li { margin-bottom:10px; }
    .footer-col ul li a { color:#c9d1d9; }
    .footer-col ul li a:hover { text-decoration:underline; }
    .footer-bottom {
      text-align:center; margin-top:20px;
      font-size:0.9rem;
    }

    /* Responsive */
    @media(max-width:768px){
      .rom-btm { flex-direction:column; }
      .footer-container { flex-direction:column; text-align:center; }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Banner scroll & slideshow
      const banners = document.querySelector('.banners');
      window.addEventListener('scroll', () => {
        const blur = Math.min(window.scrollY/50, 5);
        banners.style.filter = `blur(${blur}px)`;
      });
      const slides = document.querySelectorAll('.banners-slideshow .slide');
      let current=0;
      setInterval(() => {
        slides[current].classList.remove('active');
        current = (current+1)%slides.length;
        slides[current].classList.add('active');
      }, 4000);

      // Button highlight
      document.querySelectorAll('.view').forEach(btn => {
        btn.addEventListener('click', () => {
          document.querySelectorAll('.view').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        });
      });
    });
  </script>
</head>



<!-- Custom Footer (if not within footer.php) -->
<footer>
    <div class="footer-container">
      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="about.php">About Us</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="terms.php">Terms of Use</a></li>
          <li><a href="privacy.php">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Support</h4>
        <ul>
          <li><a href="help.php">Help Center</a></li>
          <li><a href="faq.php">FAQs</a></li>
          <li><a href="write-us.php">Write To Us</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Social</h4>
        <ul>
          <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
          <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
          <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; <?php echo date('Y'); ?> TransCity. All rights reserved.
    </div>
  </footer>
