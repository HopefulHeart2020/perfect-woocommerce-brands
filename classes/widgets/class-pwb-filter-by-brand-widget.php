<?php

namespace Perfect_Woocommerce_Brands\Widgets;

use WP_Query;

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

class PWB_Filter_By_Brand_Widget extends \WP_Widget {

	function __construct() {
		$params = array(
			'description' => __( 'Recommended for product categories or shop page', 'perfect-woocommerce-brands' ),
			'name'        => __( 'Filter products by brand', 'perfect-woocommerce-brands' ),
		);
		parent::__construct( 'PWB_Filter_By_Brand_Widget', '', $params );
	}

	public function form( $instance ) {
		extract( $instance );

		$title                   = ( isset( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Brands', 'perfect-woocommerce-brands' );
		$limit                   = ( isset( $instance['limit'] ) ) ? $instance['limit'] : 20;
		$hide_submit_btn         = ( isset( $hide_submit_btn ) && $hide_submit_btn == 'on' ) ? true : false;
		$only_first_level_brands = ( isset( $only_first_level_brands ) && $only_first_level_brands == 'on' ) ? true : false;
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'perfect-woocommerce-brands' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>">
				<?php esc_html_e( 'Max number of brands', 'perfect-woocommerce-brands' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
		</p>

		<p>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hide_submit_btn' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_submit_btn' ) ); ?>" <?php checked( $hide_submit_btn ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hide_submit_btn' ) ); ?>">
				<?php esc_html_e( 'Hide filter button', 'perfect-woocommerce-brands' ); ?>
			</label>
		</p>

		<p>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'only_first_level_brands' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'only_first_level_brands' ) ); ?>" <?php checked( $only_first_level_brands ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'only_first_level_brands' ) ); ?>">
				<?php esc_html_e( 'Show only first level brands', 'perfect-woocommerce-brands' ); ?>
			</label>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$limit = trim( wp_strip_all_tags( $new_instance['limit'] ) );
		$limit = filter_var( $limit, FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) );

		$instance                            = array();
		$instance['title']                   = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['limit']                   = ( $limit != false ) ? $limit : $old_instance['limit'];
		$instance['hide_submit_btn']         = ( isset( $new_instance['hide_submit_btn'] ) ) ? $new_instance['hide_submit_btn'] : '';
		$instance['only_first_level_brands'] = ( isset( $new_instance['only_first_level_brands'] ) ) ? $new_instance['only_first_level_brands'] : '';
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		if ( ! is_tax( 'pwb-brand' ) && ! is_product() ) {

			$hide_submit_btn         = ( isset( $hide_submit_btn ) && $hide_submit_btn == 'on' ) ? true : false;
			$only_first_level_brands = ( isset( $only_first_level_brands ) && $only_first_level_brands == 'on' ) ? true : false;

			$show_widget      = true;
			$current_products = false;
			if ( is_product_taxonomy() || is_shop() ) {
				$current_products = $this->current_products_query();
				if ( empty( $current_products ) ) {
					$show_widget = false;
				}
			}

			if ( $show_widget ) {

				$title = ( isset( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Brands', 'perfect-woocommerce-brands' );
				$title = apply_filters( 'widget_title', $title );
				$limit = ( isset( $instance['limit'] ) ) ? $instance['limit'] : 20;

				echo $args['before_widget']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				if ( ! empty( $title ) ) {
					echo $args['before_title'] . $title . $args['after_title']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				}
				$this->render_widget( $current_products, $limit, $hide_submit_btn, $only_first_level_brands );
				echo $args['after_widget']; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			}
		}
	}

	public function render_widget( $current_products, $limit, $hide_submit_btn, $only_first_level_brands ) {
		$result_brands = array();

		if ( is_product_taxonomy() || is_shop() ) {

			// obtains brands ids
			if ( ! empty( $current_products ) ) {
				$result_brands = $this->get_products_brands( $current_products );
			}

			// excludes the child brands if needed
			if ( $only_first_level_brands ) {
				$result_brands = $this->exclude_child_brands( $result_brands );
			}

			if ( is_shop() ) {
				$cate_url = get_permalink( wc_get_page_id( 'shop' ) );
			} else {
				$cate     = get_queried_object();
				$cateID   = $cate->term_id;
				$cate_url = get_term_link( $cateID );
			}
		} else {
			// no product category
			$cate_url      = get_permalink( wc_get_page_id( 'shop' ) );
			$result_brands = get_terms(
				'pwb-brand',
				array(
					'hide_empty' => true,
					'fields'     => 'ids',
				)
			);
		}

		if ( $limit > 0 ) {
			$result_brands = array_slice( $result_brands, 0, $limit );
		}

		global $wp;
		$current_url = home_url( add_query_arg( array(), $wp->request ) );

		if ( ! empty( $result_brands ) ) {

			$result_brands_ordered = array();
			foreach ( $result_brands as $brand ) {
				$brand                                 = get_term( $brand );
				$result_brands_ordered[ $brand->name ] = $brand;
			}
			ksort( $result_brands_ordered );

			$result_brands_ordered = apply_filters( 'pwb_widget_brand_filter', $result_brands_ordered );

			echo \Perfect_Woocommerce_Brands\Perfect_Woocommerce_Brands::render_template(// phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
				'filter-by-brand',
				'widgets',
				array(
					'cate_url'        => $cate_url,
					'brands'          => $result_brands_ordered,
					'hide_submit_btn' => $hide_submit_btn,
				),
				false
			);
		}
	}

	private function exclude_child_brands( $brands ) {
		// gets parent for all brands
		foreach ( $brands as $brand_key => $brand ) {

			$brand_o = get_term( $brand, 'pwb-brand' );

			if ( $brand_o->parent ) {

				// exclude this child brand and include the parent
				unset( $brands[ $brand_key ] );
				if ( ! in_array( $brand_o->parent, $brands ) ) {
					$brands[ $brand_key ] = $brand_o->parent;
				}
			}
		}

		// reset keys
		$brands = array_values( $brands );

		return $brands;
	}

	private function current_products_query() {
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'tax_query'      => array(
				array(
					'taxonomy' => 'pwb-brand',
					'operator' => 'EXISTS',
				),
			),
			'fields'         => 'ids',
		);

		$cat = get_queried_object();
		if ( is_a( $cat, 'WP_Term' ) ) {
			$cat_id              = $cat->term_id;
			$cat_id_array        = get_term_children( $cat_id, $cat->taxonomy );
			$cat_id_array[]      = $cat_id;
			$args['tax_query'][] = array(
				'taxonomy' => $cat->taxonomy,
				'field'    => 'term_id',
				'terms'    => $cat_id_array,
			);
		}

		if ( get_option( 'woocommerce_hide_out_of_stock_items' ) === 'yes' ) {
			$args['meta_query'] = array(
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT IN',
				),
			);
		}

		$wp_query = new WP_Query( $args );
		wp_reset_postdata();

		return $wp_query->posts;
	}

	private function get_products_brands( $product_ids ) {
		$product_ids = implode( ',', array_map( 'intval', $product_ids ) );

		global $wpdb;

		$brand_ids = $wpdb->get_col(
			"SELECT DISTINCT t.term_id
			FROM {$wpdb->prefix}terms AS t
			INNER JOIN {$wpdb->prefix}term_taxonomy AS tt
			ON t.term_id = tt.term_id
			INNER JOIN {$wpdb->prefix}term_relationships AS tr
			ON tr.term_taxonomy_id = tt.term_taxonomy_id
			WHERE tt.taxonomy = 'pwb-brand'
			AND tr.object_id IN ($product_ids)
		"
		);

		return ( $brand_ids ) ? $brand_ids : false;
	}
}
