<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lang - Spanish
* 
* Author: 
* Rob Hussey using http://translate.google.com/
* flexicart@haseydesign.com
* haseydesign.com/flexicart
*
* Created: 22/05/2012
*
* Description:
* Spanish language file for flexi cart
*
* !IMPORTANT NOTE: This language file was translated from the original 'English' file via Google Translate, and may therefore contain inaccurate translations.
* If anyone fluent in Spanish would be willing to translate this language file, it would be greatly appreciated.
* Any contributions made to the library will be fully credited.
*
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

// Cart Item functions
$lang['items_added_successfully']					= "El artículo ha sido añadido a la cesta de la compra.";
$lang['no_items_added']								= "No hay elementos se han añadido a la cesta de la compra.";
$lang['items_updated_successfully']					= "Carro de la compra han sido actualizadas.";
$lang['no_items_updated']							= "No hay artículos en el carrito de compras se han actualizado.";
$lang['items_deleted_successfully']					= "El artículo ha sido borrado de la cesta de la compra.";

// Validate Item data 
$lang['invalid_data']								= "Datos no válidos se ha presentado.";
$lang['invalid_item_id']							= "ID no válido artículo ha sido presentado.";
$lang['invalid_item_name']							= "Nombre del elemento no válido se ha presentado.";
$lang['invalid_item_quantity']						= "Cantidad de artículos no válido se ha presentado.";
$lang['invalid_item_price']							= "El precio del artículo no válido se ha presentado.";
$lang['invalid_custom_data']						= "Datos no válidos de elementos personalizados se ha presentado.";

// Item Statuses
$lang['item_stock_insufficient']					= "Hay existencias suficientes para cumplir con la cantidad de artículos en el carrito de la compra.";
$lang['item_stock_insufficient_adjusted']			= "Hay existencias suficientes para este tema, su cantidad se ha ajustado en consecuencia.";
$lang['item_out_of_stock']							= "Artículo está agotado.";
$lang['item_out_of_stock_removed']					= "Punto han sido eliminados de la cesta, ya que ya no están en stock.";
$lang['item_shipping_location_ban']					= "Este artículo no puede ser enviado a la ubicación actual de transporte marítimo.";
$lang['item_shipping_banned']						= "No hay artículos en el carrito de la compra que se pueden enviar a la ubicación actual de transporte marítimo.";

// Shipping 
$lang['shipping_location_updated_successfully']		= "Ubicación de envío ha sido actualizado.";
$lang['shipping_location_update_unsuccessful']		= "Ubicación de envío no se ha actualizado.";
$lang['shipping_updated_successfully']				= "Gastos de envío ha sido actualizado.";
$lang['shipping_update_unsuccessful']				= "Gastos de envío no se pudo actualizar.";

// Tax
$lang['tax_location_updated_successfully']			= "Impuesto sobre la ubicación ha sido actualizado.";
$lang['tax_location_update_unsuccessful']			= "Impuesto sobre la ubicación no se actualizó.";
$lang['tax_updated_successfully']					= "Impuestos se ha actualizado.";
$lang['tax_update_unsuccessful']					= "El impuesto no se pudo actualizar.";

// Discounts
$lang['discounts_updated_successfully']				= "Descuentos se han actualizado.";
$lang['discount_update_unsuccessful']				= "Los descuentos no se han actualizado.";
$lang['discount_codes_valid']						= "Código de descuento se ha establecido.";
$lang['discount_codes_invalid']						= "Código de descuento no es válido.";
$lang['discount_unset_successfully']				= "Descuento se ha eliminado.";
$lang['discount_unset_unsuccessful']				= "El descuento no puede ser removido.";
$lang['excluded_discount_reenabled']				= "Quedan excluidos de descuento han sido re-habilitado.";
$lang['duplicate_discount_code']					= "Un vale de descuento / premio con este código ya existe.";

// Surcharges
$lang['surcharge_updated_successfully']				= "Recargo ha sido actualizado.";
$lang['surcharge_update_unsuccessful']				= "Recargo No se pudo actualizar.";
$lang['surcharge_unset_successful']					= "Recargo se ha eliminado.";
$lang['surcharge_unset_unsuccessful']				= "Recargo no puede ser eliminado.";

// Currency
$lang['currency_updated_successfully']				= "De divisas se ha actualizado.";
$lang['currency_update_unsuccessful']				= "De divisas no se pudo actualizar.";

// Save Order
$lang['cart_order_save_successful']					= "Detalles de los pedidos se han salvado.";
$lang['cart_order_save_unsuccessful']				= "Detalles del pedido no se pudo guardar.";
$lang['resave_order_does_not_exist']				= "Los datos de la tabla de la orden original no se puede encontrar para volver a guardar los datos en.";
$lang['order_number_exists']						= "Una orden con este número de orden que ya existe.";

// Database Cart Data
$lang['cart_data_save_successful']					= "Carrito de la compra de datos se ha guardado.";
$lang['cart_data_save_unsuccessful']				= "Carrito de la compra de datos no se pudo guardar.";
$lang['cart_data_load_successful']					= "Carrito de la compra de datos se ha cargado.";
$lang['cart_data_load_unsuccessful']				= "Carrito de la compra de datos no se pudo cargar.";
$lang['cart_data_delete_successful']				= "Carrito de la compra de datos ha sido eliminado.";
$lang['cart_data_delete_unsuccessful']				= "Carrito de la compra de datos no pudo ser eliminado.";

// Misc Settings
$lang['send_email_successful']						= "E-mail ha sido enviado.";
$lang['send_email_unsuccessful']					= "El fue un error al enviar el correo electrónico.";
$lang['database_table_column_disabled']				= "La tabla de búsqueda de base de datos y / o columna está desactivado.";
$lang['cart_emptied']								= "Todos los artículos han sido eliminados de la cesta de la compra.";
$lang['cart_destroyed']								= "Todos los artículos en el carrito de compras y los ajustes han sido destruidos.";

// Data Updated
$lang['session_config_data_updated']				= "Compras configuración de compra ha sido actualizado.";
$lang['database_data_inserted']						= "Los datos han sido insertada.";
$lang['database_data_updated']						= "Datos han sido actualizados.";
$lang['database_data_deleted']						= "Los datos han sido eliminados.";