=== Perfect WooCommerce Brands ===
Contributors: titodevera
Donate link: mailto:hola@albertodevera.es
Tags: woocommerce, brands, brand taxonomy, product brands, woocommerce manufacturer, woocommerce supplier, e-commerce
Requires at least: 4.4
Tested up to: 5.0
Stable tag: 1.7.1
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.en.html

Perfect WooCommerce Brands allows you to show product brands in your WooCommerce based store

== Description ==
Whether we like to admit it or not, we are all influenced by brands. Brands are a guarantee for quality, they assure product recognition in customers.
Is essential to work with product brands for increase sales and generate reliability on your e-commerce site.
With this extension you can add product brands to your WooCommerce site.

= Requirements =
> * PHP 5.4 or higher (PHP7 recommended)
> * WordPress 4.4 or higher
> * WooCommerce 2.6.0 or higher
> * Visual Composer (recommended)

= Features =
> * Very easy to use, 100% free, no ads, no premium version exists
> * Assign brands to products
> * Associate a banner and a link to each brand
> * Translation-ready (English and Spanish included)
> * Visual Composer support
> * Minimalist design and fully responsive
> * Very lightweight
> * Shortcode: Display all brands
> * Shortcode: Display brands carousel
> * Shortcode: Display product carousel by brand
> * Shortcode: Display brands for a specific product
> * Shortcode: A-Z Listing
> * Widget: Display brands as dropdown
> * Widget: Display brands as list (brand names or brand logos)
> * Widget: Filter products by brand
> * Customizable brands slug
> * Show the brands in products loop
> * Import brands (migrate) from other brands plugins
> * Dummy data installer (logos by heroturko)
> * WooCommerce REST API support
> * WooCommerce built-in product importer/exporter support (WooCommerce 3.1.0+)
> * Brand tab for single product page
> * Favorite brands
> * Brands json import/export
> * And much more!


== Installation ==
1. Upload the plugin to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.


== Frequently Asked Questions ==
= Is Perfect WooCommerce Brands free? =
Yes, of course. This plugin is 100% free. No ads, no premium version exists.

= Where are plugin settings? =
Go to `WooCommerce/Settings/` and click on `Brands` tab

= How can i use the available shortcodes without Visual Composer? =
[Click here](https://github.com/titodevera/perfect-woocommerce-brands/wiki/How-can-i-use-the-available-shortcodes-without-Visual-Composer%3F)

= How to import brands from other brands plugin? =
[Click here](https://github.com/titodevera/perfect-woocommerce-brands/wiki/How-to-import-brands-from-other-brands-plugin)

= REST API docs =
[Click here](https://github.com/titodevera/perfect-woocommerce-brands/wiki/REST-API-docs)


== Screenshots ==
1. Brands carousel
2. Brands page
3. Brands taxonomy
4. Brands shortcodes (with Visual Composer)
5. Product carousel by brand


== Changelog ==
= 1.7.1 =
* Feature: Extends the [products] shortcode to allow 'brands' attribute
* Feature: The brands column is sortable now
* Catalan translation (thanks to Lluisma)
* Enhancement: Easier select brands page link in breadcrumbs
* Enhancement: Configure the brand banner and the brand description position independently
* Dev: New filter 'pwb_taxonomy_rewrite' to change the rewrite slug
* Dev: New filter 'pwb_taxonomy_with_front' to change default "with_front" value
* Fix: Fatal error in PHP5.4
= 1.7.0 =
* Feature: A-Z Listing shortcode
* Feature: New brands exporter/importer introduced
* Fix: Missing some brands to filter
* Fix: Coupon doesn’t work for product variations (thanks @gekomees)
* Fix: The brand description is not shown if there are no products
* Enhancement: wpautop() for brand descriptions
* Enhancement: Other filter by brand widget enhancements
* Enhancement: Brands page link in breadcrumbs
* Enhancement: Enqueue the carousel lib conditionally
* Dev: New filter hook 'pwb_description_allowed_tags'
* Update: WC 3.5 compatibility
= 1.6.5 =
* Include icon and banner brand image in api response (thanks @qbig)
* Feature: New option for show only favorite brands in the dropdown widget and the list widget
* Feature: New option for configure the max number of brands in filter by brand widget
* Feature: Filter by brand without submit button
* Feature: New option for randomize brand logos in the list widget
* Feature: Hide empty brands in brand carousel
* Enhancement: Hide widgets when there are no results to show
* Fix: "Dokan Multivendor Marketplace" JavaScript conflict in admin
= 1.6.4 =
* Feature: Visual editor with shortcode support added to brand description
* Feature: Hide empty brands in brand widgets
* Feature: Place brand description before or after product loop
* Fix: WC import not assigning brands
* Minor fixes and tweaks
= 1.6.3 =
* Requirements: No more longer support for very old php versions (5.4 minimum)
* Fix: Product carousels shortcode display fixes
* Fix: Missing .pot file
* Fix: Coupon codes stopped working since latest update
* Fix: Carousel preloader is not working
= 1.6.2 =
* Fix: Carousels problems on responsive after the last update
= 1.6.1 =
* Feature: Favorite brands
* Fix: Brand logo full size option for single product
* Fix: Coupons brands restriction (thanks @josk79)
* Fix: Import products fixes
* Fix: PHP7 warning on 'class-perfect-woocommerce-brands.php'
* Fix: Brand not added when Duplicating Product
* Enhancement: Filter by brand widget enhancements
* Enhancement: Carousels enhancements
* Enhancement: JS and CSS minified
= 1.6.0 =
* Feature: Migrate brands from the official WooCommerce Brand's plugin (pull request, thanks Chunkford)
* Feature: Support for the new WooCommerce product importer/exporter
* Feature: Brand tab in single product page
* Enhancement: Brands dropdown widget selects the current brand if is a brand archive page
* Enhancement: Hide the brand name in "Display all brands" shortcode (title_position="none")
* Enhancement: Important enhancements for the REST API
* Fix: The brand property is not recognized by Google
* Fix: No shortcode appeared in some Visual Composer versions
* Fix: Filter by brand widget fixes
* Fix: Brand description adds description twice
* Other minor bug fixes and code improvements
