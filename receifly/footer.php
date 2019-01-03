        <div class="clear"></div>
    </div>

        <footer id="footer" role="contentinfo">
            <div class="container" id="copyright">
                <?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'receifly' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); echo sprintf( __( ' Theme By %1$s.', 'receifly' ), '<a href="http://ynodesigns.com/">YNODesigns</a>' ); ?>
            </div>
        </footer>
                
        <?php wp_footer(); ?>
        <!-- Core JavaScript -->
        <script src="<?php echo get_stylesheet_directory_uri().'/js/jquery-3.3.1.slim.min.js'?>"></script>
        <script src="<?php echo get_stylesheet_directory_uri().'/js/bootstrap.bundle.min.js'?>"></script>

        <!-- Plugin JavaScript -->
        <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

        <!-- Custom scripts for this template -->
        <script src="<?php echo get_stylesheet_directory_uri().'/js/main.js' ?>"></script>

    </body>
</html>