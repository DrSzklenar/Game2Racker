<footer class="footer">
  <div class="footer-container">
    <div class="row">
      <div class="footer-col">
        <h4>company</h4>
        <ul>
          <li><a href="login/login.php">Login</a></li>
          <li><a href="login/register.php">Register</a></li>
          <li id="kijelentkezes"><a href="#">Logout</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>get help</h4>
        <ul>
          <li><a href="index.php">home</a></li>
          <?php
          echo  "<li><a href=\"profile.php?user=" . $userData['nev'] . "&userid=" . $userData['userID'] . "\">profile</a></li>";

          ?>

          <li><a href="termsangol.php">General Terms and Conditions</a></li>



        </ul>
      </div>

      <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-links">
          <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/Game2Racker"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <div class="footer-col subscribe-form">
        <h4>Get updates</h4>
        <form action="index.php">
          <input type="text" placeholder="Email Address">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </div>
    </div>
  </div>
</footer>