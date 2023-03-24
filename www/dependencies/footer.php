<footer class="footer">
  <div class="footer-container">
    <div class="row">
      <div class="footer-col">
        <h4>company</h4>
        <ul>
          <li><a href="index.php">home</a></li>
          <?php
          echo  "<li><a href=\"profile.php?user=" . $userData['nev'] . "&userid=" . $userData['userID'] . "\">profile</a></li>";
          ?>
          <li><a href="#">General Terms and Conditions</a></li>
          
        </ul>
      </div>
      <div class="footer-col">
        <h4>get help</h4>
        <ul>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">shipping</a></li>
          <li><a href="#">returns</a></li>
          
          
        </ul>
      </div>
      <div class="footer-col">
        <h4>online shop</h4>
        <ul>
          <li><a href="#">watch</a></li>
          <li><a href="#">bag</a></li>
          <li><a href="#">shoes</a></li>
          
        </ul>
      </div>
      <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-links">
          <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>