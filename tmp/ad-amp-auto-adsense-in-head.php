<?php //AdSense AMP自動広告の</head>手前コード
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */

if (is_ads_visible() && is_auto_adsense_enable()): ?>
<!-- Google AMP Auto AdSense script -->
<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>
<!-- End Google AMP Auto AdSense script -->
<?php endif ?>