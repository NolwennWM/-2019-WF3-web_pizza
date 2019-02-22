</div>
    <!-- end #main-content -->
    <?php 
    // ou l'intégrer sur chaque page indépendament pour plus de modularité.
        $noContact = ['order', 'account'];
        if(!in_array($GLOBALS['route_active'], $noContact)){
            include_once "../private/src/views/contact/form.php";
        }

    ?>

    <!-- Main Footer -->
    <footer id="main-footer">

        <!-- Footer Copyright -->
        <div class="footer-legal">
            <div class="container">
                <?= "Copyright &copy; 2018 - ".date('Y')." Web Pizza." ?>
            </div>
        </div>

    </footer>
    <!-- end #main-footer -->

    <!-- JS Library -->
    <script src="assets/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="assets/js/popper.min.js" ></script>
    <script src="assets/js/bootstrap.min.js" ></script>

    <!-- App JS -->
    <script src="assets/js/app.js?<?= time() ?>"></script>

</body>

</html>