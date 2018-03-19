<?php

class CardgatePayment extends PaymentModule {

    var $version = '1.6.23';
    var $tab = 'payments_gateways';
    var $author = 'CardGate';
    var $shop_version = _PS_VERSION_;
    var $currencies = true;
    var $currencies_mode = 'radio';
    var $_html = '';
    var $extra_cost = '';
    protected $_paymentHookTpl = '';

    public function install() {

        $payment = strtoupper( $this->paymentcode );

        if ( !parent::install() OR ! $this->registerHook( 'payment' ) )
            return false;
        return true;
    }

    public function uninstall() {

        $paymentcode = $this->paymentcode;

        if ( $paymentcode == '' )
            return false;

        $paymentcode = strtoupper( $paymentcode );

        if ( !parent::uninstall() )
            return false;
        return true;
    }

    public function hookPayment( $params ) {
        $this->smarty->assign( 'paymentcode', $this->paymentcode );
        $this->smarty->assign( 'paymentname', $this->name );
        $this->smarty->assign( 'logoname', $this->logoname );

        $this->smarty->assign( 'extracosts', $this->extraCosts( $this->extra_cost ) );
        $this->smarty->assign( 'paymenttext', $this->l( 'Pay with' ) . ' ' . $this->paymentname );

        $this->smarty->assign( '_url', $this->_url );
        $this->smarty->assign( 'imageurl', $this->imageurl );
        $this->smarty->assign( 'fields', $this->paymentData() );

        $this->smarty->assign( array(
            'this_path' => $this->_path,
            'this_path_bw' => $this->_path,
            'this_path_ssl' => Tools::getShopDomainSsl( true, true ) . __PS_BASE_URI__ . 'modules/' . $this->name . '/'
        ) );
        if ( $this->_paymentHookTpl ) {
            return $this->display( $this->_childClassFile, $this->_paymentHookTpl );
        } else {
            return $this->display( $this->_childClassFile, '../cardgate/views/hook/payment.tpl' );
        }
    }

    public function displayConf() {

        $this->_html = $this->displayConfirmation( $this->l( 'Settings updated' ) );
    }

    function get_url() {
        if ( Configuration::get( 'CARDGATE_MODE' ) == 1 ) {
            return "https://secure-staging.curopayments.net/gateway/cardgate/";
        } else {
            return "https://secure.curopayments.net/gateway/cardgate/";
        }
    }

    public function extraCosts( $extra_cost ) {
        $cart = $this->context->cart;
        $total = number_format( ($cart->getOrderTotal( true, Cart::BOTH ) ), 2, '.', '' );
        if ( $extra_cost == 0 || $extra_cost == '' ) {
            return 0;
        }
        if ( strstr( $extra_cost, '%' ) ) {
            $percentage = str_replace( '%', '', $extra_cost );
            return round( ($total * $percentage / 100 ), 2 );
        }
        if ( is_numeric( $extra_cost ) ) {
            return round( $extra_cost, 2 );
        }
    }

    public function paymentData() {

        if ( Configuration::get( 'CARDGATE_MODE' ) == 1 ) {
            $sPrefix = 'TEST';
        } else {
            $sPrefix = '';
        }
        $extrafee = $this->extraCosts( $this->extra_cost );
        $extrafee = (is_numeric($extrafee) ? $extrafee : 0);
        
        $cart = $this->context->cart;

        $cg_total = number_format( (($cart->getOrderTotal( true, Cart::BOTH ) + $extrafee) * 100 ), 0, '.', '' );
        $site_id = Configuration::get( 'CARDGATE_SITEID' );
        $ref = date( "YmdHis" ) . $cart->id;
        $extra = $cart->id . '|' . $extrafee;
        $hash = md5( $sPrefix . $site_id . $cg_total . $ref . Configuration::get( 'CARDGATE_HASH_KEY' ) );
        $address = new Address( $cart->id_address_invoice );
        $countryObj = new Country( $address->id_country );
        $customer = $this->context->customer;
        $currency = new Currency( ( int ) $cart->id_currency );

        $cartitems = array();
        $products = $cart->getproducts( true );

        foreach ( $products as $product ) {
        	$vat_amount = $product ['price_wt'] - $product ['price'];
        	$vat = round ( $vat_amount / $product ['price'] * 100, 2 );
        	$item = array ();
        	$item ['quantity'] = $product ['cart_quantity'];
        	$item ['sku'] = $product ['id_product'];
        	$item ['name'] = $product ['name'];
        	$item ['price'] = round ( $product ['price'] * 100, 0 );
        	$item ['vat'] = $vat;
        	$item ['vat_amount'] = round ( $vat_amount * 100, 0 );
        	$item ['vat_inc'] = 0;
        	$item ['type'] = 1;
        	$cartitems [] = $item;
        	$iCartItemTotal += round ( $item ['price'] * $item ['quantity'] );
        	$iCartItemTaxTotal += round ( $item ['vat_amount'] * $item ['quantity'] );
        }

        $shippingcost = 0;
        $iShippingTotal = 0;
        $iShippingTaxTotal = 0;
        
        $free_shipping = false;
        foreach ( $this->context->cart->getCartRules () as $rule ) {
        	if ($rule ['free_shipping']) {
        		$free_shipping = true;
        		break;
        	}
        }
        
        if ($free_shipping === false) {
        	
        	$shipping_cost_with_tax = $this->context->cart->getOrderTotal ( true, Cart::ONLY_SHIPPING );
        	$shipping_cost_without_tax = $this->context->cart->getOrderTotal ( false, Cart::ONLY_SHIPPING );
        	
        	if ($shipping_cost_without_tax > 0) {
        		$carrier = new Carrier ( $this->context->cart->id_carrier );
        		
        		$carrieraddress = new Address ( $this->context->cart->id_address_delivery );
        		if (! Configuration::get ( 'PS_ATCP_SHIPWRAP' )) {
        			$carriertaxrate = round ( ($shipping_cost_with_tax / $shipping_cost_without_tax) - 1, 2 ) * 100;
        		} else {
        			$carriertaxrate = $carrier->getTaxesRate ( $carrieraddress );
        		}
        		
        		if (($shipping_cost_with_tax != $shipping_cost_without_tax) && $carriertaxrate == 0) {
        			// Prestashop error due to EU module?
        			$carriertaxrate = round ( ($shipping_cost_with_tax / $shipping_cost_without_tax) - 1, 2 ) * 100;
        		}
        		
        		// $shippingReference = $this->module->shippingreferences[$language->iso_code];
        		$item = array ();
        		$item ['quantity'] = 1;
        		$item ['sku'] = 'SHIPPING_' . $carrier->id_reference;
        		$item ['name'] = $carrier->name;
        		$item ['price'] = round ( $shipping_cost_without_tax * 100, 0 );
        		$item ['vat'] = $carriertaxrate;
        		$item ['vat_amount'] = round ( ($shipping_cost_with_tax - $shipping_cost_without_tax) * 100, 0 );
        		$item ['vat_inc'] = 0;
        		$item ['type'] = 2;
        		$cartitems [] = $item;
        		
        		$iShippingTotal += round ( $item ['price'] * $item ['quantity'], 0 );
        		$iShippingTaxTotal += round ( $item ['vat_amount'] * $item ['quantity'], 0 );
        	}
        }

        if ($extrafee > 0) {
        	$item = array ();
        	$item ['quantity'] = 1;
        	$item ['sku'] = 'TRANSACTIONFEE';
        	$item ['name'] = 'Transactie kosten';
        	$item ['price'] = round ( $extrafee , 0 );
        	$item ['vat'] = 0;
        	$item ['vat_amount'] = 0;
        	$item ['vat_inc'] = 1;
        	$item ['type'] = 3;
        	$cartitems [] = $item;
        }
        
        $iProductCorrection = round($cart->getOrderTotal ( false, Cart::BOTH )*100,0) - $iCartItemTotal - $iShippingTotal;
        
        if ($iProductCorrection != 0) {
        	$item = array ();
        	$item ['quantity'] = 1;
        	$item ['sku'] = 'PRODUCTCORRECTION';
        	$item ['name'] = 'product_corection';
        	$item ['price'] = $iProductCorrection;
        	$item ['vat'] = 0;
        	$item ['vat_amount'] = 0;
        	$item ['vat_inc'] = 1;
        	$item ['type'] = 6;
        	$cartitems [] = $item;
        }
        $iTaxCorrection = $cg_total - $iCartItemTotal - $iShippingTotal- $iProductCorrection - $iCartItemTaxTotal - $iShippingTaxTotal - $extrafee;
        if ($iTaxCorrection != 0) {
        	$item = array ();
        	$item ['quantity'] = 1;
        	$item ['sku'] = 'VATCORRECTION';
        	$item ['name'] = 'vat_corection';
        	$item ['price'] = $iTaxCorrection;
        	$item ['vat'] = 0;
        	$item ['vat_amount'] = 0;
        	$item ['vat_inc'] = 1;
        	$item ['type'] = 7;
        	$cartitems [] = $item;
        }

        $data = array();
        $data['option'] = $this->paymentcode;
        $data['siteid'] = $site_id;
        $data['test'] = Configuration::get( 'CARDGATE_MODE' );
        $data['language'] = $this->context->language->iso_code;
        $data['hash'] = $hash;
        $data['return_url'] = Tools::getHttpHost( true, true ) . __PS_BASE_URI__ . 'index.php?controller=order-confirmation&id_cart=' . ( int ) $cart->id . '&key=' . $customer->secure_key . '&id_module=' . $this->id;
        $data['return_url_failed'] = Tools::getHttpHost( true, true ) . __PS_BASE_URI__ . 'index.php?controller=order&step=3';
        $data['amount'] = $cg_total;
        $data['currency'] = $currency->iso_code;
        $data['description'] = 'Payment of the account #' . $ref;
        $data['ref'] = $ref;
        $data['extra'] = $extra;
        $data['first_name'] = $address->firstname;
        $data['last_name'] = $address->lastname;
        $data['address'] = $address->address1 . ' ' . $address->address2;
        $data['postal_code'] = $address->postcode;
        $data['city'] = $address->city;
        $data['country'] = $countryObj->iso_code;
        $data['email'] = $customer->email;
        $data['phone_number'] = !empty( $address->phone_mobile ) ? $address->phone_mobile : $address->phone;
        $data['plugin_name'] = $this->name;
        $data['plugin_version'] = $this->version;
        $data['shop_name'] = 'PrestaShop';
        $data['shop_version'] = $this->shop_version;

        if ( count( $cartitems ) > 0 ) {
            $data['cartitems'] = json_encode( $cartitems, JSON_HEX_APOS | JSON_HEX_QUOT );
        }

        return $data;
    }

}
