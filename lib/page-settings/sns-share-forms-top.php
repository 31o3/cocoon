<?php /**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */ ?>
<!-- 本文上シェアボタン -->
<div id="sns-share-top" class="postbox">
  <h2 class="hndle"><?php _e( '本文上シェアボタン', THEME_NAME ) ?></h2>
  <div class="inside">
    <p><?php _e( '本文上シェアボタンの表示に関する設定です。※AMPページでスタイルは反映されません。', THEME_NAME ) ?></p>
    <table class="form-table">
      <tbody>

        <!-- プレビュー画面 -->
        <tr>
          <th scope="row">
            <label><?php _e( 'プレビュー', THEME_NAME ) ?></label>
          </th>
          <td>
            <div class="demo">
            <?php //テンプレートの読み込み
              if (is_sns_top_share_buttons_visible())
                get_template_part_with_option('tmp/sns-share-buttons', SS_TOP); ?>
            </div>
          </td>
        </tr>

        <!-- 本文上シェアボタンの表示 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_SNS_TOP_SHARE_BUTTONS_VISIBLE, __( '本文上シェアボタンの表示', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag( OP_SNS_TOP_SHARE_BUTTONS_VISIBLE, is_sns_top_share_buttons_visible(), __( 'メインカラム本文上シェアボタンを表示', THEME_NAME ));
            generate_tips_tag(__( '投稿・固定ページのメインカラムにある本文上シェアボタンの表示を切り替えます。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- 表示切替 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag('', __( '表示切替', THEME_NAME )); ?>
          </th>
          <td>
            <p><?php _e( '個々のシェアボタンの表示切り替え。', THEME_NAME ) ?></p>
            <ul>
              <li>
                <?php generate_checkbox_tag(OP_TOP_TWITTER_SHARE_BUTTON_VISIBLE, is_top_twitter_share_button_visible(), __( 'Twitter', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_FACEBOOK_SHARE_BUTTON_VISIBLE, is_top_facebook_share_button_visible(), __( 'Facebook', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_HATEBU_SHARE_BUTTON_VISIBLE, is_top_hatebu_share_button_visible(), __( 'はてなブックマーク', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_GOOGLE_PLUS_SHARE_BUTTON_VISIBLE, is_top_google_plus_share_button_visible(), __( 'Google', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_POCKET_SHARE_BUTTON_VISIBLE, is_top_pocket_share_button_visible(), __( 'Pocket', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_LINE_AT_SHARE_BUTTON_VISIBLE, is_top_line_at_share_button_visible(), __( 'LINE@', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_PINTEREST_SHARE_BUTTON_VISIBLE, is_top_pinterest_share_button_visible(), __( 'Pinterest', THEME_NAME )); ?>
              </li>
              <li>
                <?php generate_checkbox_tag(OP_TOP_COPY_SHARE_BUTTON_VISIBLE,  is_top_copy_share_button_visible(), __( 'タイトルとURLをコピー', THEME_NAME )); ?>
              </li>
            </ul>
            <p><?php _e( '表示するシェアボタンを選択してください。', THEME_NAME ) ?></p>
          </td>
        </tr>


        <!-- ボタンカラー -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_SNS_TOP_SHARE_BUTTON_COLOR, __( 'ボタンカラー', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            $options = array(
              'monochrome' => 'モノクロ',
              'brand_color' => 'ブランドカラー',
              'brand_color_white' => 'ブランドカラー（白抜き）',
            );
            generate_selectbox_tag(OP_SNS_TOP_SHARE_BUTTON_COLOR, $options, get_sns_top_share_button_color());
            generate_tips_tag(__( '本文上シェアボタンの配色を選択してください。', THEME_NAME ));
            ?>
          </td>
        </tr>



        <!-- カラム数 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_SNS_TOP_SHARE_COLUMN_COUNT, __( 'カラム数', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            $options = array(
              '1' => '1列',
              '2' => '2列',
              '3' => '3列',
              '4' => '4列',
              '5' => '5列',
              '6' => '6列',
            );
            generate_selectbox_tag(OP_SNS_TOP_SHARE_COLUMN_COUNT, $options, get_sns_top_share_column_count());
            generate_tips_tag(__( '本文上シェアボタンのカラム数を選択してください。', THEME_NAME ));
            ?>
          </td>
        </tr>


        <!-- ロゴ・キャプション配置 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_SNS_TOP_SHARE_LOGO_CAPTION_POSITION, __( 'ロゴ・キャプション配置', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            $options = array(
              'left_and_right' => 'ロゴ・キャプション 左右',
              'high_and_low_lc' => 'ロゴ・キャプション 上下',
              'high_and_low_cl' => 'キャプション・ロゴ 上下',
            );
            generate_selectbox_tag(OP_SNS_TOP_SHARE_LOGO_CAPTION_POSITION, $options, get_sns_top_share_logo_caption_position());
            generate_tips_tag(__( '本文上シェアボタンのロゴとキャプションの配置を選択してください。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- シェア数の表示 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_SNS_TOP_SHARE_BUTTONS_COUNT_VISIBLE, __( 'シェア数の表示', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag( OP_SNS_TOP_SHARE_BUTTONS_COUNT_VISIBLE, is_sns_top_share_buttons_count_visible(), __( 'シェア数を表示', THEME_NAME ));
            generate_tips_tag(__( '投稿・固定ページのメインカラムにある本文上シェアボタンの表示を切り替えます。', THEME_NAME ));
            ?>
          </td>
        </tr>


      </tbody>
    </table>

  </div>
</div>
