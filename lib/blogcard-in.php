<?php //内部ブログカード関数
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */

//ブログカードのサムネイルタグの取得
if ( !function_exists( 'get_blogcard_thumbnail_image_tag' ) ):
function get_blogcard_thumbnail_image_tag($url, $in = true){
  if ($in) {
    $class = ' internal-blogcard-thumb-image';
  } else {
    $class = ' external-blogcard-thumb-image';
  }
  return '<img src="'.$url.'" alt="" class="blogcard-thumb-image'.$class.'" width="'.THUMB160WIDTH_DEF.'" height="'.THUMB160HEIGHT_DEF.'" />';
}
endif;

//内部ブログカードを作成できるURLかどうか
if ( !function_exists( 'is_internal_blogcard_url' ) ):
function is_internal_blogcard_url($url){
  $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換）
  $cat = get_category_by_path($url, false);
  //_v($cat);
  //_v($url);
  if ($id || is_home_url($url) || $cat) {
    return true;
  }
}
endif;

//内部ブログカードのサムネイルサイズ
if ( !function_exists( 'get_internal_blogcard_thumbnail_size' ) ):
function get_internal_blogcard_thumbnail_size(){
  return THUMB160;
}
endif;

//内部URLからブログをカードタグの取得
if ( !function_exists( 'url_to_internal_blogcard_tag' ) ):
function url_to_internal_blogcard_tag($url){
  if ( !$url ) return;
  $url = strip_tags($url);//URL
  $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換）
  //内部ブログカード作成可能なURLかどうか
  if ( !is_internal_blogcard_url($url) ) return;
  //_v($url);

  $no_image = get_no_image_160x90_url();
  if (!$no_image) {
    $no_image = get_site_screenshot_url($url);
  }

  $thumbnail = null;
  $date_tag = null;
  //投稿・固定ページの場合
  if ($id) {
    //global $post;
    $post_data = get_post($id);
    setup_postdata($post_data);
    $exce = $post_data->post_excerpt;

    $title = $post_data->post_title;//タイトルの取得

    //メタディスクリプションの取得
    $snipet = get_the_page_meta_description($id);

    //投稿管理画面の抜粋を取得
    if (!$snipet) {
      $snipet = $post_data->post_excerpt;
    }
    //記事本文の抜粋文を取得
    if (!$snipet) {
      $snipet = get_content_excerpt($post_data->post_content, get_entry_card_excerpt_max_length());
    }
    $snipet = preg_replace('/\n/', '', $snipet);

    //日付表示
    $date = null;
    $post_date = mysql2date(get_site_date_format(), $post_data->post_date);
    switch (get_internal_blogcard_date_type()) {
      case 'post_date':
        $date = $post_date;
        break;
      case 'up_date':
        $date = mysql2date(get_site_date_format(), $post_data->post_modified);
        if (!$date) {
          $date = $post_date;
        }
        break;
    }
    if (is_internal_blogcard_date_visible()) {
      $date = '<div class="blogcard-post-date internal-blogcard-post-date">'.$date.'</div>';//日付の取得
      $date_tag = '<div class="blogcard-date internal-blogcard-date">'.$date.'</div>';
    }


    //サムネイルの取得（要160×90のサムネイル設定）
    $thumbnail = get_the_post_thumbnail($id, get_internal_blogcard_thumbnail_size(), array('class' => 'blogcard-thumb-image internal-blogcard-thumb-image', 'alt' => ''));

  } elseif (is_home_url($url)){
    //トップページの場合
    $title = get_front_page_title_caption();
    $snipet = get_front_page_meta_description();
    $image = get_ogp_home_image_url();
    if (!empty($image)) {
      $thumbnail = get_blogcard_thumbnail_image_tag($image);
    }
  } elseif ($cat = get_category_by_path($url, false)){
    //カテゴリページの場合
    $cat_id = $cat->cat_ID;
    //_v(get_category_meta($cat_id));
    $title = get_category_title($cat_id);
    $snipet = get_category_snipet($cat_id);
    $image = get_category_eye_catch($cat_id);
    //_v($image);
    if ($image) {
      $thumbnail = get_blogcard_thumbnail_image_tag($image);
    }

  }

  //サムネイルが存在しない場合
  if ( !$thumbnail ) {
    $thumbnail = get_blogcard_thumbnail_image_tag($no_image);
  }

  //ブログカードのサムネイルを右側に
  $additional_class = get_additional_internal_blogcard_classes();

  //新しいタブで開く場合
  $target = is_internal_blogcard_target_blank() ? ' target="_blank"' : '';

  //ファビコン
  $favicon_tag =
  '<div class="blogcard-favicon internal-blogcard-favicon">'.
    '<img src="//www.google.com/s2/favicons?domain='.get_the_site_domain().'" class="blogcard-favicon-image internal-blogcard-favicon-image" alt="" width="16" height="16" />'.
  '</div>';

  //サイトロゴ
  $domain = get_domain_name(punycode_decode($url));
  $site_logo_tag = '<div class="blogcard-domain internal-blogcard-domain">'.$domain.'</div>';
  $site_logo_tag = '<div class="blogcard-site internal-blogcard-site">'.$favicon_tag.$site_logo_tag.'</div>';

  //取得した情報からブログカードのHTMLタグを作成
  //_v($url);
  $tag =
  '<a href="'.$url.'" title="'.esc_attr($title).'" class="blogcard-wrap internal-blogcard-wrap a-wrap cf"'.$target.'>'.
    '<div class="blogcard internal-blogcard'.$additional_class.' cf">'.
      '<figure class="blogcard-thumbnail internal-blogcard-thumbnail">'.$thumbnail.'</figure>'.
      '<div class="blogcard-content internal-blogcard-content">'.
        '<div class="blogcard-title internal-blogcard-title">'.$title.'</div>'.
        '<div class="blogcard-snipet internal-blogcard-snipet">'.$snipet.'</div>'.

      '</div>'.
      '<div class="blogcard-footer internal-blogcard-footer cf">'.
        $site_logo_tag.$date_tag.
      '</div>'.
    '</div>'.
  '</a>';

  return $tag;
}
endif;

//本文中のURLをブログカードタグに変更する
if ( !function_exists( 'url_to_internal_blogcard' ) ):
function url_to_internal_blogcard($the_content) {
  $res = preg_match_all('/^(<p>)?(<a[^>]+?>)?https?:\/\/'.preg_quote(get_the_site_domain()).'(\/)?([-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)?(<\/a>)?(<\/p>)?/im', $the_content,$m);
  //_v($m);
  foreach ($m[0] as $match) {

    //マッチしたpタグが適正でないときはブログカード化しない
    if ( !is_p_tag_appropriate($match) ) {
      continue;
    }

    $url = strip_tags($match);//URL

    //wpForoのブログカードは外部ブログカードに任せる
    if (includes_wpforo_url($url)) {
      continue;
    }

    $tag = url_to_internal_blogcard_tag($url);


    if ( !$tag ) continue;//IDを取得できない場合はループを飛ばす

    //本文中のURLをブログカードタグで置換
    $the_content = preg_replace('{^'.preg_quote($match, '{}').'}im', $tag , $the_content, 1);
    wp_reset_postdata();

  }

  return $the_content;//置換後のコンテンツを返す
}
endif;
if ( is_internal_blogcard_enable() ) {
  add_filter('the_content', 'url_to_internal_blogcard', 11);
  add_filter('widget_text', 'url_to_internal_blogcard', 11);
  add_filter('widget_text_pc_text', 'url_to_internal_blogcard', 11);
  add_filter('widget_classic_text', 'url_to_internal_blogcard', 11);
  add_filter('widget_text_mobile_text', 'url_to_internal_blogcard', 11);
  add_filter('the_category_content', 'url_to_internal_blogcard', 11);
}

//本文中のURLショートコードをブログカードタグに変更する
if ( !function_exists( 'url_shortcode_to_blogcard' ) ):
function url_shortcode_to_blogcard($the_content) {
  //1行にURLのみが期待されている行（URL）を全て$mに取得
  $res = preg_match_all('/(<p>)?(<br ? \/?>)?\[https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+\](<br ? \/?>)?(<\/p>)?/im', $the_content, $m);
  foreach ($m[0] as $match) {
  //マッチしたURL一つ一つをループしてカードを作成
    $url = strip_tags($match);//URL
    $url = preg_replace('/[\[\]]/', '', $url);//[と]の除去
    $url = str_replace('?', '%3F', $url);//?をエンコード

    //取得した内部URLからブログカードのHTMLタグを作成
    $tag = url_to_internal_blogcard_tag($url);//外部ブログカードタグに変換
    //URLをブログカードに変換
    if ( !$tag ) {//取得したURLが外部URLだった場合
      $tag = url_to_external_blog_card($url);//外部ブログカードタグに変換
    }

    if ( $tag ) {//内部・外部ブログカードどちらかでタグを作成できた場合
      //本文中のURLをブログカードタグで置換
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
  }

  return $the_content;//置換後のコンテンツを返す
}
endif;
add_filter('the_content', 'url_shortcode_to_blogcard' ,9999);
add_filter('widget_text', 'url_shortcode_to_blogcard' ,9999);
add_filter('widget_text_pc_text', 'url_shortcode_to_blogcard', 9999);
add_filter('widget_classic_text', 'url_shortcode_to_blogcard', 9999);
add_filter('widget_text_mobile_text', 'url_shortcode_to_blogcard', 9999);
add_filter('comment_text', 'url_shortcode_to_blogcard', 9999);
add_filter('the_category_content', 'url_shortcode_to_blogcard', 9999);


//ブログカード置換用テキストにpタグが含まれているかどうか
if ( !function_exists( 'is_p_tag_appropriate' ) ):
function is_p_tag_appropriate($match){
  if (strpos($match,'p>') !== false){
    //pタグが含まれていた場合は開始タグと終了タグが揃っているかどうか
    if ( (strpos($match,'<p>') !== false) && (strpos($match,'</p>') !== false) ) {
      return true;
    }
    return false;
  }
  return true;
}
endif;
