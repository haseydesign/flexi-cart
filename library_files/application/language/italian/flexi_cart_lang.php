<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lang - Italian
* 
* Author: 
* koichirose
* koichirose@gmail.com
*
* Created: 15/05/2012
*
* Description:
* Italian language file for flexi cart
*
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

// Cart Item functions
$lang['items_added_successfully']					= "Articolo aggiunto al carrello.";
$lang['no_items_added']								= "Nessun articolo aggiunto al carrello.";
$lang['items_updated_successfully']					= "Carrello aggiornato.";
$lang['no_items_updated']							= "Nessun articolo aggiornato.";
$lang['items_deleted_successfully']					= "Articoli rimossi dal carrello.";

// Validate Item data 
$lang['invalid_data']								= "Dati non validi.";
$lang['invalid_item_id']							= "ID articolo non valido.";
$lang['invalid_item_name']							= "Nome articolo non valido.";
$lang['invalid_item_quantity']						= "Quantità non valida.";
$lang['invalid_item_price']							= "Prezzo non valido.";
$lang['invalid_custom_data']						= "Dati personalizzati non validi.";

// Item Statuses
$lang['item_stock_insufficient']					= "Non ci sono sufficienti articoli disponibili per soddisfare la richiesta.";
$lang['item_stock_insufficient_adjusted']			= "Non ci sono sufficienti articoli disponibili. Disponibilità aggiornata automaticamente.";
$lang['item_out_of_stock']							= "Articolo non disponibile.";
$lang['item_out_of_stock_removed']					= "Alcuni articoli sono stati rimossi dal carrello in quanto non più disponibili.";
$lang['item_shipping_location_ban']					= "Questo articolo non può essere spedito nella località selezionata.";
$lang['item_shipping_banned']						= "Nessun articolo nel carrello può essere spedito nella località selezionata.";

// Shipping 
$lang['shipping_location_updated_successfully']		= "Località di spedizione aggiornata.";
$lang['shipping_location_update_unsuccessful']		= "Impossibile aggiornare la località di spedizione.";
$lang['shipping_updated_successfully']				= "Costi di spedizione aggiornati.";
$lang['shipping_update_unsuccessful']				= "Impossibile aggiornare i costi di spedizione.";

// Tax
$lang['tax_location_updated_successfully']			= "Località tasse aggiornata.";
$lang['tax_location_update_unsuccessful']			= "Impossibile aggiornare la località tasse.";
$lang['tax_updated_successfully']					= "Tasse aggiornate.";
$lang['tax_update_unsuccessful']					= "Impossibile aggiornare le tasse.";

// Discounts
$lang['discounts_updated_successfully']				= "Sconti aggiornati.";
$lang['discount_update_unsuccessful']				= "Impossibile aggiornare gli sconti.";
$lang['discount_codes_valid']						= "Codice sconto inserito con successo.";
$lang['discount_codes_invalid']						= "Codice sconto invalido.";
$lang['discount_unset_successfully']				= "Codice sconto rimosso con successo.";
$lang['discount_unset_unsuccessful']				= "Impossibile rimuovere il codice sconto.";
$lang['excluded_discount_reenabled']				= "I codici sconto in precedenza disabilitati sono stati riabilitati.";
$lang['duplicate_discount_code']					= "E' già presente uno sconto con questo codice.";

// Surcharges
$lang['surcharge_updated_successfully']				= "Sovrattassa aggiornata.";
$lang['surcharge_update_unsuccessful']				= "Impossibile aggiornare sovrattassa.";
$lang['surcharge_unset_successful']					= "Sovrattassa rimossa.";
$lang['surcharge_unset_unsuccessful']				= "Impossibile rimuovere la sovrattassa.";

// Currency
$lang['currency_updated_successfully']				= "Valuta aggiornata.";
$lang['currency_update_unsuccessful']				= "Impossibile aggiornare la valuta.";

// Save Order
$lang['cart_order_save_successful']					= "Ordine salvato con successo.";
$lang['cart_order_save_unsuccessful']				= "Impossibile salvare l'ordine.";
$lang['resave_order_does_not_exist']				= "Impossibile trovare l'ordine nella tabella specificata.";
$lang['order_number_exists']						= "E' già presente un ordine con questo numero.";

// Database Cart Data
$lang['cart_data_save_successful']					= "Carrello salvato.";
$lang['cart_data_save_unsuccessful']				= "Impossibile salvare il carrello.";
$lang['cart_data_load_successful']					= "Carrello caricato.";
$lang['cart_data_load_unsuccessful']				= "Impossibile caricare il carrello.";
$lang['cart_data_delete_successful']				= "Carrello cancellato.";
$lang['cart_data_delete_unsuccessful']				= "Impossibile cancellare il carrello.";

// Misc Settings
$lang['send_email_successful']						= "Email inviata con successo.";
$lang['send_email_unsuccessful']					= "Impossibile inviare l'email.";
$lang['database_table_column_disabled']				= "La tabella del database è disabilitata.";
$lang['cart_emptied']								= "Carrello svuotato con successo.";
$lang['cart_destroyed']								= "Il carrello e le sue opzioni sono stati eliminati.";

// Data Updated
$lang['session_config_data_updated']				= "Configurazione del carrello aggiornata.";
$lang['database_data_inserted']						= "Dati salvati.";
$lang['database_data_updated']						= "Dati aggiornati.";
$lang['database_data_deleted']						= "Dati cancellati.";