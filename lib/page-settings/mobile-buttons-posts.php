<?php //モバイルボタン設定をデータベースに保存
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */

//モバイルボタンレイアウト
update_theme_option(OP_MOBILE_BUTTON_LAYOUT_TYPE);

//スライドインメニュー表示の際にメインコンテンツ下にサイドバーを表示するか
update_theme_option(OP_SLIDE_IN_CONTENT_BOTTOM_SIDEBAR_VISIBLE);