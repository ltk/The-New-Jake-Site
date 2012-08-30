<?php
$template_sidebar = isset( $template_options['sidebar'] ) ? $template_options['sidebar'] : null ;
$template_loop = isset( $template_options['loop'] ) ? $template_options['loop'] : 'page' ;
$template_after_loop = isset( $template_options['after_loop'] ) ? $template_options['after_loop'] : null ;
$template_before_loop = isset( $template_options['before_loop'] ) ? $template_options['before_loop'] : null ;
$template_content_class = isset( $template_options['content_class'] ) ? $template_options['content_class'] : 'page' ;
$template_sidebar_box_contents = isset( $template_options['sidebar_box_contents'] ) ? $template_options['sidebar_box_contents'] : '<img src="/img/where-we-work-temp.png" alt="Where We Work" />' ;
$template_sidebar_bottom = isset( $template_options['sidebar_bottom'] ) ? $template_options['sidebar_bottom'] : null ;
$template_sidebar_class = isset( $template_options['sidebar_class'] ) ? $template_options['sidebar_class'] : null ;
$template_show_sidebar = isset( $template_options['show_sidebar'] ) ? $template_options['show_sidebar'] : true ;
$template_show_loop = isset( $template_options['show_loop'] ) ? $template_options['show_loop'] : true ;

get_header(); ?>
  <?php roots_content_before(); ?>
  <div class="breadcrumbs container">
      <?php Jake::display_breadcrumbs(); ?>
  </div>
    <div id="content" class="<?php echo $template_content_class; ?> container">
        <div clas="span12">
          <?php if( $template_show_sidebar ) {

            roots_sidebar_before(); ?>
          <aside id="sidebar" class="<?php echo $template_sidebar_class; ?> <?php echo SIDEBAR_CLASSES; ?>" role="complementary">
            <?php roots_sidebar_inside_before(); ?>
              <?php get_sidebar( $template_sidebar ); ?>
            <?php roots_sidebar_inside_after(); ?>
            <div class="sidebar-content-box-wrapper">
              <div class="sidebar-content-box">
                <?php echo $template_sidebar_box_contents; ?>
              </div>
            </div>
            <?php echo $template_sidebar_bottom; ?>
          </aside><!-- /#sidebar -->
          <?php roots_sidebar_after();
          }
          ?>

          <?php echo $template_before_loop; ?>

          <?php if($template_show_loop){ ?>
          <?php roots_loop_before(); ?>
          <?php get_template_part( 'loop', $template_loop ); ?>
          <?php roots_loop_after(); ?>
          <?php } ?>

          <?php echo $template_after_loop; ?>

        </div>
    </div><!-- /#content -->
  <?php roots_content_after(); ?>
<?php get_footer(); ?>