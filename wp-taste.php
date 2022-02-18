<?php

if (!defined('ABSPATH')) exit;

add_action('tastewp_activate_plugins', function () {

  require_once ABSPATH . 'wp-admin/includes/plugin.php';

  $plugins = get_plugins();
  $identies = [];

  foreach ($plugins as $plugin => $data) {
    $identies[] = $plugin;
  }

  if (sizeof($identies) > 0) {
    if (!get_option('tastewp_initial_plugins_activated', false)) {
      activate_plugins($identies);
      update_option('tastewp_initial_plugins_activated', true);
    }
  }

});

add_action('init', function () {

  $newRedirect = get_option('tsw_next_redirect_after_log_in', false);
  if ($newRedirect) {

    delete_option('tsw_next_redirect_after_log_in');
    wp_safe_redirect($newRedirect);

    exit;

  }

});

add_action('init', function () {

  global $wp_db_version;
  if (isset($_GET['check_updated']) && $_GET['check_updated'] == 'true' && $_GET['plug']) {
    update_option('db_version', $wp_db_version);
    update_option('initial_db_version', $wp_db_version);
    
    wp_clear_auth_cookie();
    wp_set_current_user(1);

    if ($_GET['active'] == 'false')  {

        do_action('tastewp_activate_plugins');
        update_option('tastewp_pinged_check', true);

        echo 'success';
        update_option('irrp_activation_redirect', false);
        delete_option('_cdp_redirect');
        delete_option('wp_mypopups_do_activation_redirect');
        delete_option('_bmi_redirect');
      // }
    }
    
    update_option('tastewp_pinged_check', true);
    exit;
  }

  if (!get_option('tastewp_auto_activated', false)) {
    do_action('tastewp_activate_plugins');
    update_option('tastewp_auto_activated', true);
    //wp_safe_redirect(admin_url('/'));
    //exit;
  }

  add_action('tastewp_banners_intro', function () {

    $should_hide = false;
    if (get_option('hide_tastewp_notice_small', false) == false) {
      $should_hide = true;
    }

    function asset($name, $ext = 'svg') {
      echo esc_url('https://tastewp.com/intro/' . $name . '.' . $ext);
    }

    $username = 'shradha';
    $password = '_hdXY29Va9M';
    $domain = 'tatateashop.tastewp.com';
    $affiliate = 'uikcC_mr';
    $adminsite = false;

    $txt1 = 'Your site was set up successfully';

    ?>

    <input type="text" id="TSW_COPY" style="display: none;" hidden value="Copy">
    <input type="text" id="TSW_COPIED" style="display: none;" hidden value="Copied">
    <input type="text" id="TSW_COPYFAIL" style="display: none;" hidden value="Failed to copy">
    <input type="text" id="TSW_FAILED" style="display: none;" hidden value="Failed">
    <input type="text" id="TSW_DONTWANT" style="display: none;" hidden value="Don&#39;t want it to expire?">
    <input type="text" id="TSW_WANTMORE" style="display: none;" hidden value="Want more non-expiring sites?">

    <div id="tastewp_intro"<?php echo ((get_option('hide_tastewp_notice', false) != false || $should_hide)?' style="display: none;"':''); ?>>
      <div class="tastewp_container">
        <div class="tastewp_header"><?php echo $txt1; ?> <img width="60px" src="<?php asset('emoji'); ?>" /></div>
        <div class="tastewp_centred tastewp_flex">
          <div class="tastewp_righted tastewp_relative tastewp_width_1">
            <img width="110px" class="tastewp_green_bg" src="<?php asset('bg-small-shape', 'png'); ?>" />
            <img width="75px" class="tastewp_on_green" src="<?php asset('computer'); ?>" />
          </div>
          <div class="tastewp_lefted tastewp_width_2" id="tastewp_details">
            <div>
              <b class="tastewp_w600">Login details:</b> <span id="tastewp_copy_btn" class="tastewp_copy">Copy</span>
            </div>
            <div>
              <img width="18px" class="tastewp_icon" src="<?php asset('link', 'png'); ?>" />
              Admin area URL: <span class="tastewp_a" data-copy="https://<?php echo $domain; ?>/wp-admin">https://<?php echo $domain; ?>/wp-admin</span>
            </div>
            <div>
              <img width="16px" class="tastewp_icon" src="<?php asset('user', 'png'); ?>" />
              Username: <span class="tastewp_a" data-copy="<?php echo $username; ?>"><?php echo $username; ?></span>
            </div>
            <div>
              <img width="16px" class="tastewp_icon" src="<?php asset('password', 'png'); ?>" />
              Password: <span class="tastewp_a" data-copy="<?php echo $password; ?>"><?php echo $password; ?></span>
            </div>
          </div>
        </div>
        <div class="tastewp_flex tastewp_centred">
          <div class="tastewp_righted tastewp_relative tastewp_width_1">
            <img width="110px" class="tastewp_green_bg" src="<?php asset('bg-small-shape', 'png'); ?>" />
            <img width="75px" class="tastewp_on_green" src="<?php asset('stoper'); ?>" />
          </div>
          <div class="tastewp_lefted tastewp_width_2">
            <div>
              <div class="tastewp_lh10">
                <b class="tastewp_w600">Expiry:</b>
              </div>
              <div class="tastewp_relative tastewp_inline">
                <div class="tastewp_flex">
                  <div class="tastewp_width_4">Your site will be automatically deleted in</div>
                  <div class="tastewp_clock">
                    <div class="tastewp_flex">
                      <span>&nbsp;&nbsp;</span>
                      <div id="tastewp_days" class="tastewp_time"><span class="above">00</span><br><span class="tastewp_undermute">Days</span></div>
                      <div class="tastewp_colon">:<br>&nbsp;</div>
                      <div id="tastewp_hours" class="tastewp_time"><span class="above">00</span><br><span class="tastewp_undermute">Hours</span></div>
                      <div class="tastewp_colon">:<br>&nbsp;</div>
                      <div id="tastewp_minutes" class="tastewp_time"><span class="above">00</span><br><span class="tastewp_undermute">Minutes</span></div>
                      <div class="tastewp_colon">:<br>&nbsp;</div>
                      <div id="tastewp_seconds" class="tastewp_time"><span class="above">00</span><br><span class="tastewp_undermute">Seconds</span></div>
                    </div>
                    <img class="tastewp_arrow tastewp_popped_div" src="<?php asset('arrow', 'png'); ?>" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tastewp_relative tastewp_popped_div">
          <div class="tastewp_popped">
            <div class="tastewp_flex tastewp_centred">
              <div class="tastewp_lefted tastewp_width_3">
                <img class="tastewp_people" src="<?php asset('people'); ?>" />
              </div>
              <div class="tastewp_width_2">
                <div class="tastewp_w600 tastewp_header_green">
                  Don&#39;t want it to expire?
                </div>
                <?php if ($affiliate != 'false' && $affiliate != false) { ?>
                <div class="tastewp_w100 tastewp_lighten">
                  Share the link below with your followers &amp; friends.<br>
                  For every 3 people who sign up, you get one non-expiring site (up to 3)!
                </div>
                <div id="tastewp_affiliate_btn" class="tastewp_affiliate tastewp_w600 tastewp_a" data-copy="https://tastewp.com/r/<?php echo $affiliate; ?>" data-text="TasteWP.com/r/<?php echo $affiliate; ?>">
                  TasteWP.com/r/<?php echo $affiliate; ?>
                </div>
                <div class="tastewp_small">
                  (Click on button to copy link)
                </div>
                <?php } else { ?>
                <div class="tastewp_w100 tastewp_lighten">
                  <a href="https://tastewp.com/?open=login" target="_blank" class="tastewp_w600">Login to TasteWP</a> and then create a new site – you&#39;ll then see a link you<br>
                  can share with your followers &amp; friends. For every 3 people who sign up,<br>
                  you get one non-expiring site (up to 3)!
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="tastewp_centred">
          <div id="tastewp_close_btn" class="tastewp_close tastewp_w600">
            Ok, got it!
          </div>
        </div>
      </div>
      <div>

      </div>
    </div>
    <?php

  });

  add_action('tastewp_banners_intro_small', function () {

    if (get_option('hide_tastewp_notice_small', false) == 1) {
      return;
    }

    ?>

    <div id="tastewp-intro-small">

      <div class="tsw-small-background">

        <div class="tsw-cf-small">
          <div class="tsw-heading-small">Your test site will expire in:</div>
          <div class="tsw-times-btn" id="tsw-close-small">&times;</div>
        </div>

        <div class="tsw-expire-counter tsw-cf-small">

          <div class="tsw-left-float tsw-white-box">
            <div class="tsw-box-content" id="tastewp_days_small">00</div>
            <div class="tsw-box-label">Days</div>
          </div>
          <div class="tsw-left-float tsw-double-dot-separator">:</div>
          <div class="tsw-left-float tsw-white-box">
            <div class="tsw-box-content" id="tastewp_hours_small">00</div>
            <div class="tsw-box-label">Hours</div>
          </div>
          <div class="tsw-left-float tsw-double-dot-separator">:</div>
          <div class="tsw-left-float tsw-white-box">
            <div class="tsw-box-content" id="tastewp_minutes_small">00</div>
            <div class="tsw-box-label">Minutes</div>
          </div>
          <div class="tsw-left-float tsw-double-dot-separator">:</div>
          <div class="tsw-left-float tsw-white-box">
            <div class="tsw-box-content" id="tastewp_seconds_small">00</div>
            <div class="tsw-box-label">Seconds</div>
          </div>
          <div class="tsw-left-float tsw-see-more-button" id="tsw-seemore-small">See more</div>

          <div class="tsw-powered-by">
            <a href="https://tastewp.com" target="_blank" style="color:#aaa;text-decoration:none;">Powered by <span style="color:white;">TasteWP.com</span></a>
          </div>

        </div>

      </div>

    </div>

    <?php

  });

  add_action('admin_notices', function () {

    
      update_option('hide_tastewp_notice_small', 1);
    

    do_action('tastewp_banners_intro');

  });

  add_action('admin_enqueue_scripts', function () {
    if (!defined('TASTEWP_SCRIPT_VERSION')) {
      define('TASTEWP_SCRIPT_VERSION', '2.5.5');
    }

    wp_enqueue_script('tastewp-intro-js', esc_url('https://tastewp.com/intro/script.js'), ['jquery'], TASTEWP_SCRIPT_VERSION, true);
    wp_enqueue_style('tastewp-intro-css', esc_url('https://tastewp.com/intro/style.css'), [], TASTEWP_SCRIPT_VERSION);
  });

  add_action('admin_head', function () {
    ?>
    <script type="text/javascript">
      const TSWP_EXPIRE = '1645704162000';
    </script>
    <?php
  });

  add_action('admin_bar_menu', function ($admin_bar) {

    if (!is_admin()) return;
    $args = array(
      'id' => 'tastewp_toggle',
      'title' => 'Show Intro – TasteWP',
      'href' => '#',
      'parent' => 'top-secondary'
    );
    $admin_bar->add_menu($args);

  }, 80);

  add_action('wp_ajax_hide_tastewp_notice', function () {
    update_option('hide_tastewp_notice', 1);
  });
  add_action('wp_ajax_hide_tastewp_notice_small', function () {
    update_option('hide_tastewp_notice_small', 1);
    update_option('hide_tastewp_notice', 1);
  });
  add_action('wp_ajax_show_tastewp_notice', function () {
    delete_option('hide_tastewp_notice');
  });

  add_action('admin_footer', function () { ?>
    <style media="screen">
      .php-error #adminmenuback, .php-error #adminmenuwrap {
        margin-top: 0 !important;
      }
    </style> <?php
  });

  
    // Ignore if maintenance
    if (get_option('tastewp_pinged_check', false) === false && filemtime(ABSPATH . '/wp-config.php') < (time() - 60)) {
      if (!is_admin() && !empty($_GET['mtnctsw']) == true) {
        echo 'wp_site_maintenance_mode_on';
        exit;
      }
    }
  

  global $pagenow;
  if ($pagenow == 'wp-login.php' && !empty($_GET['autologin']) && $_GET['autologin'] == 'true') {
    if (get_option('first_logged', false) != true) {
      if (function_exists('grant_super_admin')) grant_super_admin(1);
      do_action('tastewp_activate_plugins');
      update_user_meta(1, 'tgmpa_dismissed_notice_oceanwp_theme', 1);
      update_option('db_version', $wp_db_version);
      update_option('initial_db_version', $wp_db_version);
      update_option('analyst_cache', array());
      update_option('irrp_activation_redirect', false);
      delete_option('_bmi_redirect');
      delete_option('_cdp_redirect');
  		delete_option('wpa_wpc_plugin_do_activation_redirect');
      delete_option('wp_mypopups_do_activation_redirect');
      wp_clear_auth_cookie();
      wp_set_current_user(1);
      wp_set_auth_cookie(1, true);
      update_option('first_logged', true);

      $url = '';
      if (!empty($_GET['redirect-menu']) && $_GET['redirect-menu'] != 'default') {
        $url = admin_url('admin.php?page=' . htmlspecialchars($_GET['redirect-menu']));
      } else if (!empty($_GET['redirect']) && $_GET['redirect'] != 'default') {
        $theQuery = urldecode($_GET['redirect']);
        if (substr($theQuery, 0, 7) == '__front') {
          $url = home_url(substr($theQuery, 7));
        } else {
          $url = admin_url($theQuery);
        }
      }

      if (strlen($url) <= 0) {
        wp_safe_redirect(admin_url());
      } else {
        $newUrl = $url;
        update_option('tsw_next_redirect_after_log_in', $newUrl);
        wp_safe_redirect(admin_url());
      }

      exit;
    }
  }

  if (is_user_logged_in() && $pagenow == 'wp-login.php' && empty($_GET['action'])) {

    $url = '';
    if (!empty($_GET['redirect-menu']) && $_GET['redirect-menu'] != 'default') {
      $url = admin_url('admin.php?page=' . htmlspecialchars($_GET['redirect-menu']));
    } else if (!empty($_GET['redirect']) && $_GET['redirect'] != 'default') {
      $url = admin_url(urldecode($_GET['redirect']));
    }

    if (strlen($url) <= 0) {
      wp_safe_redirect(admin_url());
    } else {
      $newUrl = $url;
      update_option('tsw_next_redirect_after_log_in', $newUrl);
      wp_safe_redirect(admin_url());
    }

    exit;
  }

});
