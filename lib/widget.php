<?php //ウィジェット操作関連の関数

//タグクラウドのカスタマイズ
add_filter( 'widget_tag_cloud_args', 'widget_tag_cloud_args_custom' );
if ( !function_exists( 'widget_tag_cloud_args_custom' ) ):
function widget_tag_cloud_args_custom($args) {
  $defaults = array(
    'orderby' => 'count', //使用頻度順
    'order' => 'DESC', // 降順（使用頻度の高い順）
    'number' => 60, // 表示数
  );
  $args = wp_parse_args($args, $defaults);
  //var_dump($args);
  return $args;
}
endif;

//カテゴリウィジェットの投稿数のカッコを取り除く
add_filter( 'wp_list_categories', 'remove_post_count_parentheses' );
add_filter( 'get_archives_link',  'remove_post_count_parentheses' );
if ( !function_exists( 'remove_post_count_parentheses' ) ):
function remove_post_count_parentheses( $output ) {
  $output = preg_replace('/<\/a>.*\((\d+)\)/','<span class="post-count">$1</span></a>',$output);
  return $output;
}
endif;

//タグクラウドの出力変更
add_filter( 'wp_tag_cloud', 'wp_tag_cloud_custom');
if ( !function_exists( 'wp_tag_cloud_custom' ) ):
function wp_tag_cloud_custom( $output ) {
  //style属性を取り除く
  //_v($output);
  $output = preg_replace( '/\s*?style="[^"]+?"/i', '',  $output);
  //カッコを取り除く
  $output = str_replace( ' (', '',  $output);
  $output = str_replace( ')', '',  $output);
  return $output;
}
endif;



