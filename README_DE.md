![CardGate](https://cdn.curopayments.net/thumb/200/logos/cardgate.png)

# CardGate Modul für PrestaShop 1.6.x

## Support

Dieses Modul is geeignet für PrestaShop version **1.6.x** .

## Vorbereitung

Um dieses Modul zu verwenden, sind Zugangsdaten zu **CardGate** notwendig.  
Gehen Sie zu [**Mein CardGate**](https://my.cardgate.com/) und fragen Sie Ihre **Site ID** und **Hash Key** an, oder kontaktieren Sie Ihren Accountmanager.

## Installation

1. Downloaden Sie den aktuellsten [**Source Code**](https://github.com/cardgate/prestashop16/releases/) auf Ihrem Desktop.

2. Entpacken und uploaden Sie den Inhalt des **root-Ordners** in den **modules-Ordner** Ihres Webshops.  

3. Gehen Sie zum Ihrem **Prestashop-Adminbereich**, klicken Sie dann auf **Modules** und wählen Sie **Installed Modules** aus.

4. Kontrollieren Sie die Version des installierten CardGate Modules. 

## Konfiguration 

1. Gehen Sie zum Ihrem **Prestashop-Adminbereich**.

2. Scrollen Sie links in dem Menu bei **Module** nach unten und wählen Sie **Zahlungsmethoden und Gateways** aus.

3. Scrollen Sie nun bis zum **CardGate Bank Common** Modul und klicken Sie dann auf **konfigurieren**.

4. Füllen Sie nun die **Site ID** und den **Hash Key** ein, welche Sie unter **Webseite** bei [**Mein CardGate**](https://my.cardgate.com/) finden können. 

5. Klicken Sie nun auf **speichern**.

6. Wählen Sie bei Module **CardGate payment methods** aus und aktivieren Sie die Zahlungsmethoden aus, die Sie verwenden möchten.

7. Gehen Sie nun zu [**Mein CardGate**](https://my.cardgate.com/), klicken Sie auf **Sites** und wählen Sie die gewünschte Seite aus.

8. Gehen zu **Webseiten-Einstellungen** und füllen Sie die **Callback URL** ein, wie zum Beispiel:  
   **http://mywebshop.com/modules/cardgate/response.php**  
   (Ersetzen Sie **http://mywebshop.com** mit der URL Ihres Webshops.)  

9. Wenn Sie mit dem **Testen abgeschlossen** haben, schalten Sie dann von  
   dem **Test-Modus** in den **Live-Modus** um, und klicken Sie auf **Speichern**. 

## Anforderungen

Keine weiteren Anforderungen.