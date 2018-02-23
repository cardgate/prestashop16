![CardGate](https://cdn.curopayments.net/thumb/200/logos/cardgate.png)

# CardGate module for PrestaShop 1.6.x

[![Total Downloads](https://img.shields.io/packagist/dt/cardgate/prestashop16.svg)](https://packagist.org/packages/cardgate/prestashop16)
[![Latest Version](https://img.shields.io/packagist/v/cardgate/prestashop16.svg)](https://github.com/cardgate/prestashop16/releases)
[![Build Status](https://travis-ci.org/cardgate/prestashop16.svg?branch=master)](https://travis-ci.org/cardgate/prestashop16)

## Support

This plugin supports PrestaShop version **1.6.x**.

## Preparation

The usage of this module requires that you have obtained CardGate security credentials.
Please visit [My Cardgate](https://my.cardgate.com/) and retrieve your RESTful API username and password, or contact your accountmanager.

## Installation

1. Download the cardgate.zip file to your desktop.

2. In your PrestaShop **admin**, go to the **Modules** tab and select **Modules**.

4. Click on **Add New Module** and upload the plug-in.

## Configuration

1. Log in, to the **admin** of your PrestaShop.

2. In the left menu, at **Modules**, scroll down and select **Payment methods and Gateways.**

3. Scroll to the **CardGate Bank Common** module, and select **Configure**

4. Enter the **Site ID**, and the **Hash Key** which you can find at **Sites** on My CardGate.

6. Now click on **Save**.

7. At Modules select the **CardGate payment methods** you wish to activate and activate them.

8. Go to My CardGate, choose Sites and select the appropriate site.

9. Go to **Connection to the website** and enter the **Callback URL**, for example:
   **http://mywebshop.com/modules/cardgate/response.php**
   (Replace **http://mywebshop.com** with the URL of your webshop.)

10. When you are **finished testing** to to the **CardGate Bank Common** module and make 
   sure that you switch the **configuration** from **Test Mode** to **Live Mode** and save it (**Save**)

## Requirements

No further requirements.