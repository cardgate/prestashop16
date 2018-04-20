![CardGate](https://cdn.curopayments.net/thumb/200/logos/cardgate.png)

# CardGate module for PrestaShop 1.6.x

## Support

This plugin supports PrestaShop version **1.6.x** .

## Preparation

The usage of this module requires that you have obtained CardGate security credentials.  
Please visit [My CardGate](https://my.cardgate.com/) and retrieve your credentials, or contact your accountmanager.

## Installation

1. Download and unzip the most recent [source code](https://github.com/cardgate/prestashop16/releases) file on your desktop.

2. Unzip the file, and, using FTP, upload the **contents** of the **root** folder to the **modules** folder of your website.

3. In your PrestaShop **admin**, go to the **Modules** tab and select **Installed Modules**.

4. Check the version of the installed CardGate modules.

## Configuration

1. Log in, to the **admin** of your PrestaShop.

2. In the left menu, at **Modules**, scroll down and select **Payment methods and Gateways**.

3. Scroll to the **CardGate Bank Common** module, and select **Configure**.

4. Enter the **site ID**, and the **hash key** which you can find at **Sites** on [My CardGate](https://my.cardgate.com/).

5. Now click on **Save**.

6. At Modules select the **CardGate payment methods** you wish to activate and activate them.

7. Go to [My CardGate](https://my.cardgate.com/), choose Sites and select the appropriate site.

8. Go to **Connection to the website** and enter the **Callback URL**, for example:  
   **http://mywebshop.com/modules/cardgate/response.php**  
   (Replace **http://mywebshop.com** with the URL of your webshop.)  

9. When you are **finished testing** the **CardGate Bank Common** module, make sure that  
   you switch the **configuration** from **Test Mode** to **Live Mode** and save it (**Save**).

## Requirements

No further requirements.