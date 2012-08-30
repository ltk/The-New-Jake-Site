<link rel="stylesheet/less" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/less/bootstrap.less">

<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/less-1.3.0.min.js" type="text/javascript"></script>

<script type="text/javascript">
function destroyLessCache(pathToCss) { // e.g. '/css/' or '/stylesheets/'
  if (!window.localStorage ) {
    return;
  }
  var host = window.location.host;
  var protocol = window.location.protocol;
  var keyPrefix = protocol + '//' + host + pathToCss;
  for (var key in window.localStorage) {
    if (key.indexOf(keyPrefix) === 0) {
      delete window.localStorage[key];
    }
  }
}
destroyLessCache('/css/less/');
</script>