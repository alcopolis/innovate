
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{ if alcopolis:site_status }}
        {{ theme:partial name="metadata" }}
        {{ else }}
        {{ theme:partial name="maintenance" }}
        {{ endif }}
    </head>
    <body class="eternity-form">

        <section class="colorBg1 colorBg" id="demo1" data-panel="first">
            <div class=" container">
                <br />
                <br />
                <!-- #region Registration Form -->
                <div class="registration-form-section">
                    <?php
                    if (isset($success)) {
                        echo '<div class="section-title reg-header " data-animation="fadeInDown"><p style="text-align: center;"><strong>' . $success . '</strong></p></div>';
                    } else {
                        ?>
                        <?php echo form_open('ott_registrasi'); ?>
                        <div class="section-title reg-header " data-animation="fadeInDown">
                            <h3>Get your InnovateGo Account Here </h3>

                        </div>
                        <div class="clearfix">
                            <div class="col-sm-6 registration-left-section  " data-animation="fadeInUp">
                                <div class="reg-content">
                                    <div class="textbox-wrap">
                                        <div class="input-group">
                                            <span class="input-group-addon "><i class="icon-envelope icon-color"></i></span>
                                            <input type="email" class="form-control" name="email" placeholder="Alamat Email Anda" required="required" />
                                            <?php echo form_error('email') ? form_error('email') : ''; ?>
                                        </div>
                                    </div>
                                    <div class="textbox-wrap">
                                        <div class="input-group">
                                            <span class="input-group-addon "><i class="icon-user icon-color"></i></span>
                                            <input type="text" class="form-control" name="custPhone" placeholder="Nomor Telepon" required="required" />
                                            <?php echo form_error('custPhone') ? form_error('custPhone') : ''; ?>
                                        </div>
                                    </div>
                                    <div class="textbox-wrap">
                                        <div class="input-group">
                                            <span class="input-group-addon "><i class="icon-user icon-color"></i></span>
                                            <input type="text" class="form-control" name="custName" placeholder="Nama Lengkap" required="required" />
                                            <?php echo form_error('custName') ? form_error('custName') : ''; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 registration-right-section " data-animation="fadeInUp">
                                <div class="reg-content">
                                    <div class="textbox-wrap">
                                        <div class="input-group">
                                            <span class="input-group-addon "><i class="icon-user icon-color"></i></span>
                                            <input type="text" class="form-control" name="username" placeholder="Username" required="required" />
                                            <?php echo form_error('username') ? form_error('username') : ''; ?>
                                        </div>
                                    </div>
                                    <div class="textbox-wrap">
                                        <div class="input-group">
                                            <span class="input-group-addon "><i class="icon-key icon-color"></i></span>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required="Password" />
                                            <?php echo form_error('password') ? form_error('password') : ''; ?>
                                        </div>
                                    </div>
                                    <div class="textbox-wrap">
                                        <div class="input-group">
                                            <span class="input-group-addon "><i class="icon-key icon-color"></i></span>
                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm-Password" required="required" />
                                            <?php echo form_error('confirm_password') ? form_error('confirm_password') : ''; ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="registration-form-action clearfix " data-animation="fadeInUp" data-animation-delay=".15s">
                            <button type="submit" class="btn btn-success pull-right blue-btn ">Register Now &nbsp; <i class="icon-chevron-right"></i></button>

                        </div>
                        <?php echo form_close(); ?>	
                        <?php
                    }
                    ?>
                </div>



            </div>
        </section>
        <script type="text/javascript">
            $(function() {
                $("input").iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    increaseArea: '20%' // optional
                });
                $(".dark input").iCheck({
                    checkboxClass: 'icheckbox_polaris',
                    increaseArea: '20%' // optional
                });
                $(".form-control").focus(function() {
                    $(this).closest(".textbox-wrap").addClass("focused");
                }).blur(function() {
                    $(this).closest(".textbox-wrap").removeClass("focused");
                });

                //On Scroll Animations


                if ($(window).width() >= 968 && !Modernizr.touch && Modernizr.cssanimations) {

                    $("body").addClass("scroll-animations-activated");
                    $('[data-animation-delay]').each(function() {
                        var animationDelay = $(this).data("animation-delay");
                        $(this).css({
                            "-webkit-animation-delay": animationDelay,
                            "-moz-animation-delay": animationDelay,
                            "-o-animation-delay": animationDelay,
                            "-ms-animation-delay": animationDelay,
                            "animation-delay": animationDelay
                        });

                    });
                    $('[data-animation]').waypoint(function(direction) {
                        if (direction == "down") {
                            $(this).addClass("animated " + $(this).data("animation"));

                        }
                    }, {
                        offset: '90%'
                    }).waypoint(function(direction) {
                        if (direction == "up") {
                            $(this).removeClass("animated " + $(this).data("animation"));

                        }
                    }, {
                        offset: $(window).height() + 1
                    });
                }

                //End On Scroll Animations


                $(".main-nav a[href]").click(function() {
                    var scrollElm = $(this).attr("href");

                    $("html,body").animate({scrollTop: $(scrollElm).offset().top}, 500);

                    $(".main-nav a[href]").removeClass("active");
                    $(this).addClass("active");
                });




                if ($(window).width() > 1000 && !Modernizr.touch) {
                    var options = {
                        $menu: ".main-nav",
                        menuSelector: 'a',
                        panelSelector: 'section',
                        namespace: '.panelSnap',
                        onSnapStart: function() {
                        },
                        onSnapFinish: function($target) {
                            $target.find('input:first').focus();
                        },
                        directionThreshold: 50,
                        slideSpeed: 200
                    };
                    $('body').panelSnap(options);

                }

                $(".colorBg a[href]").click(function() {
                    var scrollElm = $(this).attr("href");

                    $("html,body").animate({scrollTop: $(scrollElm).offset().top}, 500);

                    return false;
                });




            });
        </script>

    </body>
</html>
