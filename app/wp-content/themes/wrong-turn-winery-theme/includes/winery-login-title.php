<?php
add_filter('login_headertitle', 'wineryLoginTitle');

function wineryLoginTitle() {
  return get_bloginfo('name');
}