<?php
/**
 * Auto Update Price in Product Page for WooCommerce
 *
 * @package   Auto_Update_Price_Product_Page_WooCommerce
 * @author    Luan Piegas <luan@luan.des.br>
 * @link      https://luan.des.br
 * @copyright 2021 Studio Visual
 *
 * @wordpress-plugin
 * Plugin Name:       Auto Update Price in Product Page for WooCommerce
 * Plugin URI:        https://luan.des.br
 * Description:       Update the price in product page when quantity changed.
 * Version:           1.0.2
 * Author:            Luan Piegas
 * Author URI:        https://luan.des.br
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('wp_footer', 'auto_update_price_product_page');
function auto_update_price_product_page() {
    if ( is_product() ) {
?>
    <script id="auppp">
        jQuery(function($){
            var price;

            $( '.variations_form' ).each( function() {
                $(this).on( 'found_variation', function( event, variation ) {
                    price = variation.display_price;
                });
            });
            
            $('.qty').on('change', function() {
                let quantity = $('.qty').val();
                let updatedPrice = price * quantity;
                let formatter = new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
                let formatedPrice = formatter.format(updatedPrice);
                $('.woocommerce-variation-price bdi').text(formatedPrice);
            });
        })
    </script>
<?php
    }
}

?>