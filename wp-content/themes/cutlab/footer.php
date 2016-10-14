<?php
  /**
  * The template for displaying the footer.
  *
  * @package WordPress
  * @subpackage ReadyMobile
  * @since Ready Mobile 2012 1.0
  */
  ?>

</div> <!-- main -->

<div class="footer-border">
</div>
<footer id="footer" class="footer">

 <div class="copyright">
   <div class="wrapper">
    <?php /*
     <div class="footer-nav"><?php wp_nav_menu( array( 'container' => 'nav', 'fallback_cb' => 'readymobile_menu', 'theme_location' => 'primary', 'link_before' => '' ) ); ?></div>   
    */?> 
    <div class="copy">&copy;<?php echo date('Y') . " " . get_bloginfo('name'); ?> All rights reserved</div>
    <div class="dev-jason">
      Developed with <i class="fa fa-coffee"></i> by: <a href="www.jasonyangdev.com">Jason Yang</a>
    </div>
  </div>
</div>


</footer>

</div> <!-- container -->

<?php    wp_footer();   ?>
</body>
</html>



