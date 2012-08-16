<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lang - German
* 
* Author: 
* Rob Hussey using http://translate.google.com/
* flexicart@haseydesign.com
* haseydesign.com/flexicart
*
* Created: 22/05/2012
*
* Description:
* German language file for flexi cart
*
* !IMPORTANT NOTE: This language file was translated from the original 'English' file via Google Translate, and may therefore contain inaccurate translations.
* If anyone fluent in German would be willing to translate this language file, it would be greatly appreciated.
* Any contributions made to the library will be fully credited.
*
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

// Cart Item functions
$lang['items_added_successfully']					= "Ihr Artikel wurde dem Warenkorb hinzugefügt.";
$lang['no_items_added']								= "Keine Artikel wurden dem Warenkorb hinzugefügt.";
$lang['items_updated_successfully']					= "Warenkorb Ihre Artikel wurden aktualisiert.";
$lang['no_items_updated']							= "Keine Warenkorb Artikel wurden aktualisiert.";
$lang['items_deleted_successfully']					= "Ihr Artikel wurde aus dem Warenkorb gelöscht.";

// Validate Item data 
$lang['invalid_data']								= "Ungültige Daten wurde versandt.";
$lang['invalid_item_id']							= "Ungültige Element-ID, wurde versandt.";
$lang['invalid_item_name']							= "Ungültige Element-Namen, wurde versandt.";
$lang['invalid_item_quantity']						= "Ungültige Artikelmenge wurde versandt.";
$lang['invalid_item_price']							= "Ungültige Artikelpreis wurde versandt.";
$lang['invalid_custom_data']						= "Ungültige Element benutzerdefinierte Daten wurde versandt.";

// Item Statuses
$lang['item_stock_insufficient']					= "Es ist nicht genügend Lager, um die Menge der Artikel im Warenkorb erfüllen.";
$lang['item_stock_insufficient_adjusted']			= "Es ist nicht genügend Bestand für diesen Artikel, hat ihre Menge wurde entsprechend angepasst.";
$lang['item_out_of_stock']							= "Die Ware ist nicht am Lager.";
$lang['item_out_of_stock_removed']					= "Artikel wurden aus dem Warenkorb entfernt, da sie nicht mehr auf Lager sind.";
$lang['item_shipping_location_ban']					= "Dieses Element kann nicht auf die aktuelle Lieferadresse versendet werden.";
$lang['item_shipping_banned']						= "Es sind keine Artikel im Warenkorb, die zur aktuellen Lage Versand versendet werden können.";

// Shipping 
$lang['shipping_location_updated_successfully']		= "Liefer-Standort wurde aktualisiert.";
$lang['shipping_location_update_unsuccessful']		= "Liefer-Standort wurde nicht aktualisiert.";
$lang['shipping_updated_successfully']				= "Liefer wurde aktualisiert.";
$lang['shipping_update_unsuccessful']				= "Liefer konnte nicht aktualisiert werden.";

// Tax
$lang['tax_location_updated_successfully']			= "MwSt. Standort wurde aktualisiert.";
$lang['tax_location_update_unsuccessful']			= "MwSt. Standort wurde nicht aktualisiert.";
$lang['tax_updated_successfully']					= "UST wurde aktualisiert.";
$lang['tax_update_unsuccessful']					= "UST konnte nicht aktualisiert werden.";

// Discounts
$lang['discounts_updated_successfully']				= "Rabatte wurden aktualisiert.";
$lang['discount_update_unsuccessful']				= "Rabatte wurden nicht aktualisiert.";
$lang['discount_codes_valid']						= "Rabatt-Code gesetzt wurde.";
$lang['discount_codes_invalid']						= "Rabatt-Code ist ungültig.";
$lang['discount_unset_successfully']				= "Rabatt wurde entfernt.";
$lang['discount_unset_unsuccessful']				= "Rabatt konnte nicht entfernt werden.";
$lang['excluded_discount_reenabled']				= "Ausgeschlossen Rabatt wurden wieder aktiviert.";
$lang['duplicate_discount_code']					= "Ein Rabatt / Gutschein belohnt mit diesem Code existiert bereits.";

// Surcharges
$lang['surcharge_updated_successfully']				= "Zuschlag wurde aktualisiert.";
$lang['surcharge_update_unsuccessful']				= "Zuschlag konnte nicht aktualisiert werden.";
$lang['surcharge_unset_successful']					= "Zuschlag entfernt wurde.";
$lang['surcharge_unset_unsuccessful']				= "Zuschlag konnte nicht entfernt werden.";

// Currency
$lang['currency_updated_successfully']				= "Währung wurde aktualisiert.";
$lang['currency_update_unsuccessful']				= "Währung konnte nicht aktualisiert werden.";

// Save Order
$lang['cart_order_save_successful']					= "Bestellen Details wurden gespeichert.";
$lang['cart_order_save_unsuccessful']				= "Bestellen Details konnte nicht gespeichert werden.";
$lang['resave_order_does_not_exist']				= "Die Daten der Tabelle von der ursprünglichen Reihenfolge kann nicht gefunden neu zu speichern, um Daten werden.";
$lang['order_number_exists']						= "Ein Auftrag mit diesem Auftrag existiert bereits.";

// Database Cart Data
$lang['cart_data_save_successful']					= "Warenkorb Daten wurden gespeichert.";
$lang['cart_data_save_unsuccessful']				= "Warenkorb-Daten konnten nicht gespeichert werden.";
$lang['cart_data_load_successful']					= "Warenkorb-Daten geladen worden ist.";
$lang['cart_data_load_unsuccessful']				= "Warenkorb-Daten konnten nicht geladen werden.";
$lang['cart_data_delete_successful']				= "Warenkorb Daten gelöscht worden sind.";
$lang['cart_data_delete_unsuccessful']				= "Warenkorb-Daten konnten nicht gelöscht werden.";

// Misc Settings
$lang['send_email_successful']						= "Die Email wurde verschickt.";
$lang['send_email_unsuccessful']					= "Die war ein Fehler beim Senden der E-Mail.";
$lang['database_table_column_disabled']				= "Die Datenbank Nachschlagetabelle und / oder Spalte wird deaktiviert.";
$lang['cart_emptied']								= "Alle Gegenstände wurden aus dem Warenkorb entfernt.";
$lang['cart_destroyed']								= "Alle Warenkorb Elemente und Einstellungen wurden zerstört.";

// Data Updated
$lang['session_config_data_updated']				= "Warenkorb Konfiguration wurde aktualisiert.";
$lang['database_data_inserted']						= "Daten wurden eingefügt.";
$lang['database_data_updated']						= "Daten wurde aktualisiert.";
$lang['database_data_deleted']						= "Daten wurden gelöscht.";