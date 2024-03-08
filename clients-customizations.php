<?php
	/**
	 * Plugin Name: CC Clients Customizations
	 * Description: Customizes the CC Clients post type, setting post titles automatically from the 'nombre_cliente' custom field.
	 * Version: 1.0
	 * Author: Tarek Tarabichi
	 */

// Function to automatically update post title based on the 'nombre_cliente' custom field.
	function custom_field_as_post_title_for_clients( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( 'cc_clientes' != get_post_type( $post_id ) ) return;
		$nombre_cliente = get_post_meta( $post_id, 'nombre_cliente', true );
		if ($nombre_cliente && get_the_title($post_id) !== $nombre_cliente) {
			remove_action('save_post', 'custom_field_as_post_title_for_clients');
			wp_update_post( array(
				'ID'         => $post_id,
				'post_title' => $nombre_cliente,
			) );
			add_action('save_post', 'custom_field_as_post_title_for_clients');
		}
	}
	add_action( 'save_post', 'custom_field_as_post_title_for_clients' );
//------------------------------------------------------------------------------------
// Function to automatically update Invoice post title based on the 'cliente_factura'+numero_factura+date  custom field.
	//------------------------------------------------------------------------------------
	function update_cc_invoice_title_on_save_with_total( $post_id ) {
		if ( 'cc_invoices' != get_post_type( $post_id ) ) return;
		
		remove_action('save_post', 'update_cc_invoice_title_on_save_with_total');
		
		// Get metadata values
		$cliente_factura_id = get_post_meta( $post_id, 'cliente_factura', true );
		$numero_factura = get_post_meta( $post_id, 'numero_factura', true );
		$cliente_factura_name = get_the_title( $cliente_factura_id ); // Fetching the client name
		$items_factura = get_post_meta( $post_id, 'items_factura', true );
		
		// Calculate total from line items
		$total = 0;
		if (is_array($items_factura)) {
			foreach ($items_factura as $item) {
				$price = isset($item['item_factura_price']) ? floatval($item['item_factura_price']) : 0;
				$qty = isset($item['item_factura_qty']) ? intval($item['item_factura_qty']) : 0;
				$total += $price * $qty;
			}
		}
		
		$publish_date = get_the_date( 'Y-m-d', $post_id );
		$formatted_total = number_format($total, 2, '.', ','); // Format the total as needed
		
		$new_title = $cliente_factura_name . ' - Invoice: ' . $numero_factura . ' - Date: ' . $publish_date . ' - Total: ' . $formatted_total;
		
		// Update the post
		wp_update_post( array(
			'ID'         => $post_id,
			'post_title' => $new_title,
			'post_name'  => sanitize_title($new_title)
		));
		
		add_action('save_post', 'update_cc_invoice_title_on_save_with_total');
	}
	add_action( 'save_post', 'update_cc_invoice_title_on_save_with_total' );
	//------------------------------------------------------------------------------------
	// Function to automatically update Quotations post title based on the 'cliente_presupuesto'++date  custom field.
	//------------------------------------------------------------------------------------
	function update_cc_presupuesto_title_on_save( $post_id ) {
		if ( 'cc_presupuestos' != get_post_type( $post_id ) ) return;
		
		remove_action('save_post', 'update_cc_presupuesto_title_on_save');
		
		$cliente_presupuesto_id = get_post_meta( $post_id, 'cliente_presupuesto', true );
		// Fetch the client name using the post ID
		$cliente_presupuesto_name = get_the_title( $cliente_presupuesto_id );
		
		$publish_date = get_the_date( 'Y-m-d', $post_id );
		
		$new_title = $cliente_presupuesto_name . ' - Quote: ' . $publish_date;
		
		wp_update_post( array(
			'ID'         => $post_id,
			'post_title' => $new_title,
			'post_name'  => sanitize_title($new_title)
		));
		
		add_action('save_post', 'update_cc_presupuesto_title_on_save');
	}
	add_action( 'save_post', 'update_cc_presupuesto_title_on_save' );
