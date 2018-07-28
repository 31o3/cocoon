<?php /**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
$help_text = __( '取得方法', THEME_NAME );
?>
<div class="metabox-holder">

<!-- API -->
<div id="apis" class="postbox">
  <h2 class="hndle"><?php _e( 'API設定（β機能）', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php
    _e( '各種APIやアフィリエイトIDの設定です。', THEME_NAME );
    generate_help_page_tag('https://wp-cocoon.com/amazon-link/') ?></p>

    <table class="form-table">
      <tbody>

        <!-- Amazon -->
        <tr>
          <th scope="row">
            <?php
            generate_label_tag('', __('Amazon', THEME_NAME) );
            ?>
          </th>
          <td>
            <?php
            generate_label_tag(OP_AMAZON_API_ACCESS_KEY_ID, __( 'アクセスキーID', THEME_NAME ));
            generate_necessity_input_tag();
            echo '<br>';
            generate_textbox_tag(OP_AMAZON_API_ACCESS_KEY_ID, get_amazon_api_access_key_id(), __( '', THEME_NAME ));
            generate_tips_tag(__( 'Amazon APIを使用するためのアクセスキーIDを入力してください。', THEME_NAME ).get_help_page_tag('https://wp-cocoon.com/product-advertising-api/', $help_text));

            generate_label_tag(OP_AMAZON_API_SECRET_KEY, __( 'シークレットキー', THEME_NAME ));
            generate_necessity_input_tag();
            echo '<br>';
            generate_textbox_tag(OP_AMAZON_API_SECRET_KEY, get_amazon_api_secret_key(), __( '', THEME_NAME ));
            generate_tips_tag(__( 'Amazon APIを使用するためのシークレットキーを入力してください。', THEME_NAME ).get_help_page_tag('https://wp-cocoon.com/product-advertising-api/', $help_text));

            generate_label_tag(OP_AMAZON_ASSOCIATE_TRACKING_ID, __( 'トラッキングID', THEME_NAME ));
            echo '<br>';
            generate_textbox_tag(OP_AMAZON_ASSOCIATE_TRACKING_ID, get_amazon_associate_tracking_id(), __( 'yourid-22', THEME_NAME ));
            generate_tips_tag(__( 'AmazonアソシエイトのトラッキングIDを入力してください。', THEME_NAME ).get_help_page_tag('https://wp-cocoon.com/amazon-tracking-id/', $help_text));


            echo '<div'.get_not_allowed_form_class(get_amazon_api_access_key_id() && get_amazon_api_secret_key()).'>';

            generate_checkbox_tag(OP_AMAZON_SEARCH_BUTTON_VISIBLE , is_amazon_search_button_visible(), __( 'Amazon検索ボタンを表示する', THEME_NAME ));
            generate_tips_tag(__( 'Amazonのキーワード検索ボタンを表示するか。', THEME_NAME ));

            echo '<div>';
            ?>

          </td>
        </tr>

        <!-- 楽天 -->
        <tr>
          <th scope="row">
            <?php
            generate_label_tag('', __('楽天', THEME_NAME) );
            ?>
          </th>
          <td>
            <?php
            generate_label_tag(OP_RAKUTEN_AFFILIATE_ID, __( '楽天アフィリエイトID', THEME_NAME ));
            echo '<br>';
            generate_textbox_tag(OP_RAKUTEN_AFFILIATE_ID, get_rakuten_affiliate_id(), __( '', THEME_NAME ));
            generate_tips_tag(__( '楽天アフィリエイト用のIDを入力してください。', THEME_NAME ).get_help_page_tag('https://wp-cocoon.com/rakuten-affiliate-id/', $help_text));


            echo '<div'.get_not_allowed_form_class(get_rakuten_affiliate_id()).'>';

            generate_checkbox_tag(OP_RAKUTEN_SEARCH_BUTTON_VISIBLE , is_rakuten_search_button_visible(), __( '楽天検索ボタンを表示する', THEME_NAME ));
            generate_tips_tag(__( '楽天のキーワード検索ボタンを表示するか。', THEME_NAME ));

            echo '<div>';
            ?>
          </td>
        </tr>

        <!-- Yahoo!ショッピング -->
        <tr>
          <th scope="row">
            <?php
            generate_label_tag('', __('Yahoo!ショッピング', THEME_NAME) );
            ?>
          </th>
          <td>
            <?php
            generate_label_tag(OP_YAHOO_VALUECOMMERCE_SID, __( 'バリューコマースsid', THEME_NAME ));
            echo '<br>';
            generate_textbox_tag(OP_YAHOO_VALUECOMMERCE_SID, get_yahoo_valuecommerce_sid(), __( '', THEME_NAME ));
            echo '<br>';

            generate_label_tag(OP_YAHOO_VALUECOMMERCE_PID, __( 'バリューコマースpid', THEME_NAME ));
            echo '<br>';
            generate_textbox_tag(OP_YAHOO_VALUECOMMERCE_PID, get_yahoo_valuecommerce_pid(), __( '', THEME_NAME ));

            generate_tips_tag(__( 'バリューコマースからYahoo!ショッピングに登録しsidとpidを取得してください。', THEME_NAME ).get_help_page_tag('https://wp-cocoon.com/valuecommerce-yahoo-sid-pid/', $help_text));


            echo '<div'.get_not_allowed_form_class(get_yahoo_valuecommerce_sid() && get_yahoo_valuecommerce_pid()).'>';

            generate_checkbox_tag(OP_YAHOO_SEARCH_BUTTON_VISIBLE , is_yahoo_search_button_visible(), __( 'Yahoo!検索ボタンを表示する', THEME_NAME ));
            generate_tips_tag(__( 'Yahoo!のキーワード検索ボタンを表示するか。', THEME_NAME ));

            echo '<div>';
            ?>
          </td>
        </tr>

        <!-- キャッシュの保存期間 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_API_CACHE_RETENTION_PERIOD, __( 'キャッシュの保存期間', THEME_NAME ) ); ?>
          </th>
          <td>
            <?php
            generate_number_tag(OP_API_CACHE_RETENTION_PERIOD, get_api_cache_retention_period(), '', 14, 365);
            generate_tips_tag(__( 'APIキャッシュのリフレッシュ間隔を設定します。14～365日の間隔を選べます。', THEME_NAME ));
            ?>
          </td>
        </tr>

      </tbody>
    </table>

  <p style="text-align: right;">
    <a href="<?php _e( 'https://affiliate.amazon.co.jp/help/operating/paapilicenseagreement', THEME_NAME ) ?>" target="_blank"><?php _e( 'Amazon.co.jp Product Advertising API ライセンス契約', THEME_NAME ) ?></a><br>
    <a href="<?php _e( 'https://affiliate.amazon.co.jp/help/topic/t32/ref=amb_link_4DzstEfuM3il9tu_VfGMaw_3?pf_rd_p=cbe5b1ea-57a4-41b3-952a-34cb16b7abfb', THEME_NAME ) ?>" target="_blank"><?php _e( 'Product Advertising API (PA-API) の利用ガイドライン', THEME_NAME ) ?></a></p>

  </div>
</div>

</div><!-- /.metabox-holder -->