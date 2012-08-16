<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: flexi cart lang - French
* 
* Author: 
* Rob Hussey using http://translate.google.com/
* flexicart@haseydesign.com
* haseydesign.com/flexicart
*
* Created: 22/05/2012
*
* Description:
* French language file for flexi cart
*
* !IMPORTANT NOTE: This language file was translated from the original 'English' file via Google Translate, and may therefore contain inaccurate translations.
* If anyone fluent in French would be willing to translate this language file, it would be greatly appreciated.
* Any contributions made to the library will be fully credited.
*
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

// Cart Item functions
$lang['items_added_successfully']					= "Article a été ajouté à votre panier.";
$lang['no_items_added']								= "Aucun élément n'a été ajouté au panier.";
$lang['items_updated_successfully']					= "Panier articles ont été mis à jour.";
$lang['no_items_updated']							= "No shopping cart items have been updated.";
$lang['items_deleted_successfully']					= "Pas de panier articles ont été mis à jour.";

// Validate Item data 
$lang['invalid_data']								= "Des données non valides a été soumis.";
$lang['invalid_item_id']							= "Blancs ID de l'élément a été soumis.";
$lang['invalid_item_name']							= "Nom de l'élément non valide a été soumis.";
$lang['invalid_item_quantity']						= "Quantité d'articles non valide a été soumis.";
$lang['invalid_item_price']							= "Prix ​​de l'article non valide a été soumis.";
$lang['invalid_custom_data']						= "Données de l'élément non valides personnalisés a été soumis.";

// Item Statuses
$lang['item_stock_insufficient']					= "Il ya des stocks insuffisants pour remplir la quantité d'articles dans le panier.";
$lang['item_stock_insufficient_adjusted']			= "Il ya des stocks insuffisants pour cet article, la quantité a été ajusté en conséquence.";
$lang['item_out_of_stock']							= "L'article est en rupture de stock.";
$lang['item_out_of_stock_removed']					= "Articles ont été retirés du panier d'achat car ils ne sont plus en stock.";
$lang['item_shipping_location_ban']					= "Cet article ne peut pas être expédié à l'adresse d'expédition en cours.";
$lang['item_shipping_banned']						= "Il n'y a aucun article dans le panier d'achat qui peuvent être expédiés à l'emplacement actuel de l'envoi.";

// Shipping 
$lang['shipping_location_updated_successfully']		= "Lieu de livraison a été mis à jour.";
$lang['shipping_location_update_unsuccessful']		= "Lieu de livraison n'a pas été mis à jour.";
$lang['shipping_updated_successfully']				= "Frais de port a été mis à jour.";
$lang['shipping_update_unsuccessful']				= "Frais de port n'a pas pu être mis à jour.";

// Tax
$lang['tax_location_updated_successfully']			= "Lieu de l'impôt a été mis à jour.";
$lang['tax_location_update_unsuccessful']			= "Lieu de taxe n'a pas été mis à jour.";
$lang['tax_updated_successfully']					= "Impôt a été mis à jour.";
$lang['tax_update_unsuccessful']					= "Impôt ne pouvait pas être mis à jour.";

// Discounts
$lang['discounts_updated_successfully']				= "Réduction ont été mis à jour.";
$lang['discount_update_unsuccessful']				= "Réduction n'ont pas été mis à jour.";
$lang['discount_codes_valid']						= "Code de réduction a été fixé.";
$lang['discount_codes_invalid']						= "Code de réduction est invalide.";
$lang['discount_unset_successfully']				= "Remise a été supprimé.";
$lang['discount_unset_unsuccessful']				= "Remise ne pouvait pas être enlevée.";
$lang['excluded_discount_reenabled']				= "Rabais exclus ont été ré-activé.";
$lang['duplicate_discount_code']					= "Un bon de réduction / récompense avec ce code existe déjà.";

// Surcharges
$lang['surcharge_updated_successfully']				= "La surtaxe a été mis à jour.";
$lang['surcharge_update_unsuccessful']				= "Supplément n'a pas pu être mis à jour.";
$lang['surcharge_unset_successful']					= "La surtaxe a été supprimée.";
$lang['surcharge_unset_unsuccessful']				= "Supplément ne pouvait pas être enlevée.";

// Currency
$lang['currency_updated_successfully']				= "Monnaie a été mis à jour.";
$lang['currency_update_unsuccessful']				= "Devise ne pouvait pas être mis à jour.";

// Save Order
$lang['cart_order_save_successful']					= "Détails de la commande ont été enregistrées.";
$lang['cart_order_save_unsuccessful']				= "Détails de la commande n'a pas pu être sauvé.";
$lang['resave_order_does_not_exist']				= "Les données de la table de l'ordre d'origine ne peut être trouvé à nouveau enregistrer des données sur.";
$lang['order_number_exists']						= "Une commande avec ce numéro d'ordre qui existe déjà.";

// Database Cart Data
$lang['cart_data_save_successful']					= "Panier de données a été enregistré.";
$lang['cart_data_save_unsuccessful']				= "Panier d'achat des données n'a pas pu être sauvé.";
$lang['cart_data_load_successful']					= "Panier de données a été chargé.";
$lang['cart_data_load_unsuccessful']				= "Panier d'achat des données ne peut être chargé.";
$lang['cart_data_delete_successful']				= "Panier de données a été supprimé.";
$lang['cart_data_delete_unsuccessful']				= "Panier de data une Supprimé Été.";

// Misc Settings
$lang['send_email_successful']						= "Le courriel a été envoyé.";
$lang['send_email_unsuccessful']					= "Le était une erreur d'envoyer le message.";
$lang['database_table_column_disabled']				= "La table de consultation de base de données et / ou la colonne est désactivé.";
$lang['cart_emptied']								= "Tous les articles ont été retirés du panier d'achat.";
$lang['cart_destroyed']								= "Tous les articles panier d'achat et les paramètres ont été détruits.";

// Data Updated
$lang['session_config_data_updated']				= "Panier de configuration a été mis à jour.";
$lang['database_data_inserted']						= "Les données ont été insérées.";
$lang['database_data_updated']						= "Les données ont été mis à jour.";
$lang['database_data_deleted']						= "Les données ont été supprimées.";