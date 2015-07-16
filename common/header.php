<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
      <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>
    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>
    <!-- fcd1, 07/16/15: add following fire_plugin_hook -->
    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>
    <!-- Stylesheets -->
    <?php
      queue_css_file('highslide','all',NULL,'/javascripts/highslide');
      queue_css_file('exhibitLayouts');
      queue_css_file('screen');
      echo head_css();
    ?>
    <?php
      $env = "";
      if (stristr($_SERVER['SERVER_NAME'], "-test")) {
        $env = "test";
      }
      else if (stristr($_SERVER['SERVER_NAME'], "-dev")) {
        $env = "dev";
      }
    ?>
    <?php
      queue_js_file('highslide/highslide');
      echo head_js();
    ?>
    <script type="text/javascript">
      hs.graphicsDir = "<?= url( 'application/views/scripts/javascripts/highslide/graphics/' ) ?>";
      hs.outlineType = 'rounded-white';
    </script>
    <?php if ($env == ""): ?>
      <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-796949-17']);
        _gaq.push(['_trackPageview']);
        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + 
                   '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
      </script>
    <?php endif; ?>
  </head>
  <?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <div id="wrap">
