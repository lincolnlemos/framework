<?php
/* key acf google maps */
function my_acf_init() {
  acf_update_setting('google_api_key', 'xxx');
}
add_action('acf/init', 'my_acf_init');


/**
 * Limitar o número de caracteres baseado na $excerpt
 *
 * @since Bruno Souza 2.0
 */
/* <p><?php echo excerpt('40'); ?></p> */
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

/**
 * Limitar o número de caracteres baseado na $excerpt
 *
 * @since Bigo 2.0
 */
/* Modo de uso <?php echo content(10); ?> */
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

/* Modo de uso <section id="topo" <?php thumbnail_bg( 'paginas-destaque' ); ?>> */
function thumbnail_bg ( $tamanho = 'full' ) {
    global $post;
    $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $tamanho, false, '' );
    if ($get_post_thumbnail) {
      echo 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
    } else if ($post->post_parent > 0 ) {
      $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), $tamanho, false, '' );
      echo 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
    } {
      echo "no-bg";
    }    
}

function get_thumbnail_bg ( $tamanho = 'full' ) {
    global $post;
    $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $tamanho, false, '' );
    if ($get_post_thumbnail) {
      return 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
    } else if ($post->post_parent > 0 ) {
      $get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), $tamanho, false, '' );
      return 'style="background-image: url('.$get_post_thumbnail[0].' );"';  
    } {
      return "no-bg";
    }    
}

/* É preciso setar o ACF para retornar apenas a URL. */
/* ----------------------------------------- */
  function acf_thumbnail_bg ( $nomeField ) {
    global $post;      
      if (get_field($nomeField)) {
        $src = get_field($nomeField);  
      } else {
        return;
      }      
      echo 'style="background-image: url('. $src .' );"';
  }

/* ----------------------------------------- É preciso setar o ACF para retornar apenas a URL. */    




function mascara_string($mascara,$string) {
   $string = str_replace(" ","",$string);
   for($i=0;$i<strlen($string);$i++)
   {
      $mascara[strpos($mascara,"#")] = $string[$i];
   }
   return $mascara;
}


function clear_url($input) {
  // in case scheme relative URI is passed, e.g., //www.google.com/
  $input = trim($input, '/');

  // If scheme not included, prepend it
  if (!preg_match('#^http(s)?://#', $input)) {
      $input = 'http://' . $input;
  }

  $urlParts = parse_url($input);

  // remove www
  $domain = preg_replace('/^www\./', '', $urlParts['host']);

  return $domain;

}


function images_url($file) {
  echo get_stylesheet_directory_uri() . '/assets/images/'. $file;
}

function get_images_url($file) {
  return get_stylesheet_directory_uri() . '/assets/images/'. $file;
}

function get_excerpt_twitter($length = 20) {
  $excerpt = get_the_excerpt();
  $the_str = substr($excerpt, 0, $length);
  $the_str = trim(preg_replace( '/\s+/', ' ', $the_str));
  return $the_str . '...';
}
