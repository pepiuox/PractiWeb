<!-- footer -->

<div class="container-fluid pt-3">   
    <div class="row">       
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="social"> 
                                <div class="icon">
                                    <?php
                                    $rsl = $database->query("SELECT social_name, social_url FROM social_link");
                                    while ($sl = $rsl->fetch_array()) {
                                        if (!empty($sl['social_url'])) {
                                            echo '<a href="' . $sl['social_url'] . '" target="_blank"><img src="' . B_URL . 'img/' . $sl['social_name'] . '.png" /></a> ';
                                        }
                                    }
                                    ?>  
                                    <br>
                                </div>
                                <div class="lang">                            
                                    <a class="verEs" name='espanol' id='espanol' href="<?php echo B_URL; ?>"> English</a> - 
                                    <?php
                                    $slp2 = mysqli_fetch_array($database->query("SELECT id, language, link FROM page WHERE language= '2' AND link='proyectos'"));
                                    ?> 
                                    <a class="verEn" name="english" id="english" href="<?php echo B_URL . $slp2['link']; ?>">Español</a> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">

        </div>
        <div class="col-md-3">
            <div class="develop">
                <p>Develop & Design by <a href="http://www.pepiuox.net" target="_blank">PePiuoX</a>
                </p>
            </div>
        </div>

    </div>
</div>
<!-- end page -->

<script src="<?php echo B_URL; ?>system/js/popper.min.js"></script>
<script src="<?php echo B_URL; ?>system/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo B_URL; ?>system/js/jquery-ui.min.js" type="text/javascript"></script>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-92229954-1', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>