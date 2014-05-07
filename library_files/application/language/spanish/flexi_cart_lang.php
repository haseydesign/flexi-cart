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
$lang['items_added_successfully']					= "El artículo ha sido añadido al carrito de compras.";
$lang['no_items_added']								= "Ningún elemento se ha añadido al carrito de compras.";
$lang['items_updated_successfully']					= "Se ha actualizado el carro de compras.";
$lang['no_items_updated']							= "Ningún elemento se ha actualizado en el carrito de compras.";
$lang['items_deleted_successfully']					= "El artículo ha sido borrado del carrito de compras.";

// Validate Item data 
$lang['invalid_data']								= "Datos inválidos.";
$lang['invalid_item_id']							= "ID no válido del artículo.";
$lang['invalid_item_name']							= "Nombre no válido del elemento.";
$lang['invalid_item_quantity']						= "Cantidad de artículos no válido.";
$lang['invalid_item_price']							= "El precio del artículo no es válido.";
$lang['invalid_custom_data']						= "Datos no válidos de los elementos personalizados.";

// Item Statuses
$lang['item_stock_insufficient']					= "No hay existencias suficientes para cumplir con la cantidad de artículos en el carrito de compras.";
$lang['item_stock_insufficient_adjusted']			= "No hay existencias suficientes para este elemento, la cantidad se ha ajustado en consecuencia.";
$lang['item_out_of_stock']							= "El artículo está agotado.";
$lang['item_out_of_stock_removed']					= "Algunos elementos han sido eliminados del carro de compras, ya que ya no están en stock.";
$lang['item_shipping_location_ban']					= "Este artículo no puede ser enviado a la ubicación seleccionada.";
$lang['item_shipping_banned']						= "No hay artículos en el carrito de compras que se puedan enviar a la ubicación seleccionada.";

// Shipping 
$lang['shipping_location_updated_successfully']		= "Se ha actualizado la ubicación de envío.";
$lang['shipping_location_update_unsuccessful']		= "No se pudo actualizadar la ubicación de envío.";
$lang['shipping_updated_successfully']				= "Se han actualizado los gastos de envío.";
$lang['shipping_update_unsuccessful']				= "No se pudo actualizar los gastos de envío.";

// Tax
$lang['tax_location_updated_successfully']			= "Se ha actualizado la ubicación del impuesto.";
$lang['tax_location_update_unsuccessful']			= "No se pudo actualizadar la ubicación del impuesto.";
$lang['tax_updated_successfully']					= "Se actualizó el impuesto.";
$lang['tax_update_unsuccessful']					= "No se pudo actualizar el impuesto.";

// Discounts
$lang['discounts_updated_successfully']				= "Se han actualizado los descuentos.";
$lang['discount_update_unsuccessful']				= "No se pudieron actualizar los descuentos.";
$lang['discount_codes_valid']						= "Se han establecido los códigos de descuento.";
$lang['discount_codes_invalid']						= "Código de descuento inválido.";
$lang['discount_unset_successfully']				= "Se ha eliminado el descuento.";
$lang['discount_unset_unsuccessful']				= "El descuento no puede ser removido.";
$lang['excluded_discount_reenabled']				= "Los descuentos excluidos han sido re-habilitados.";
$lang['duplicate_discount_code']					= "Ya existe un descuento/premio con este código.";

// Surcharges
$lang['surcharge_updated_successfully']				= "El recargo ha sido actualizado.";
$lang['surcharge_update_unsuccessful']				= "El recargo no se pudo actualizar.";
$lang['surcharge_unset_successful']					= "El recargo se ha eliminado.";
$lang['surcharge_unset_unsuccessful']				= "El recargo no puede ser eliminado.";

// Currency
$lang['currency_updated_successfully']				= "Las divisas se ha actualizado.";
$lang['currency_update_unsuccessful']				= "Las divisas no se pudieron actualizar.";

// Save Order
$lang['cart_order_save_successful']					= "Se han guardado los detalles del pedido.";
$lang['cart_order_save_unsuccessful']				= "No se pudo guardar los detalles del pedido.";
$lang['resave_order_does_not_exist']				= "Los datos de la tabla del pedido original no se pudieron encontrar para volver a guardar los datos.";
$lang['order_number_exists']						= "Ya existe una orden con este número.";

// Database Cart Data
$lang['cart_data_save_successful']					= "Se ha guardado los datos del carrito de compras.";
$lang['cart_data_save_unsuccessful']				= "No se pudo guardar los datos del carrito de compras.";
$lang['cart_data_load_successful']					= "Se han cargado los datos del carrito de compras.";
$lang['cart_data_load_unsuccessful']				= "No se puedo cargar los datos del carrito de compras.";
$lang['cart_data_delete_successful']				= "Se han eliminado los datos del carrito de compras.";
$lang['cart_data_delete_unsuccessful']				= "No se pudo eliminar los datos del carrito de compras.";

// Misc Settings
$lang['send_email_successful']						= "Se ha enviado un correo electrónico.";
$lang['send_email_unsuccessful']					= "Hubo un error al enviar el correo electrónico.";
$lang['database_table_column_disabled']				= "La tabla y/o columna de búsqueda de la base de datos está desactivada.";
$lang['cart_emptied']								= "Todos los artículos han sido eliminados del carrito de compras.";
$lang['cart_destroyed']								= "Todos los artículos en el carrito de compras y los ajustes han sido eliminados.";

// Data Updated
$lang['session_config_data_updated']				= "Se ha actualizado la configuración del carrito de compras.";
$lang['database_data_inserted']						= "Los datos han sido insertados.";
$lang['database_data_updated']						= "Datos han sido actualizados.";
$lang['database_data_deleted']						= "Los datos han sido eliminados.";