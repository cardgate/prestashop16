![CardGate](https://cdn.curopayments.net/thumb/200/logos/cardgate.png)

# CardGate Modul für PrestaShop 1.6.x

## Support

Dieses Modul is geeignet für PrestaShop version **1.6.x** .

## Vorbereitung

Um dieses Modul zu verwenden sind Zugangsdate zur **CardGate** notwendig.
Gehen zu My CardGate und fragen Sie Ihre **site ID** und **hash key** an, oder kontaktieren Sie Ihren Accountmanager.

## Installation

1. Downloaden Sie den aktuellsten **Source Code** auf Ihrem Desktop.

2. Entpacken Sie, und uploaden Sie den Inhalt des **root-Ordners** in den **modules-Ordner** Ihres Webshops.  

3. Gehen Sie zum Ihrem **Prestashop-Adminbereich**, klicken Sie dann auf **Modules** und wählen Sie **Installed Modules** aus.

4. Check the version of the installed CardGate modules.

## Configuration

1. Gehen Sie zum Ihrem **Prestashop-Adminbereich**.

2. Scrollen Sie links in dem Menu bei **Modules** nach unten und wählen Sie **Zahlungsmethoden und Gateways** aus.

3. Scrollen Sie nun bis zum **CardGate Bank Common** Module und klicken Sie dann auf **konfigurieren**.

4. Füllen Sie nun die **site ID** und den **hash key** ein welche Sie unter **Website** bei **My CardGate** finden können. 

5. Klicken Sie nun auf **speichern**.

6. Wählen Sie bei Modules **CardGate payment methods** aus und aktivieren Sie die Zahlungsmethoden aus, die Sie verwenden möchten.

7. Gehen Sie nun zu **My CardGate**, klicken Sie auf **Sites** und wählen Sie die gewünschte Seite aus.

8. Gehen zu **Webseiten-Einstellungen** und füllen Sie die **Callback URL**, wie zum Beispiel:
   **http://mywebshop.com/modules/cardgate/response.php**
   (Ersetzen Sie http://mywebshop.com mit der URL Ihres Webshops)

9. Wenn Sie mit dem **Testen abgeschlossen** haben schalten Sie dann von  
   dem **Test-Modus** in den **Live mode** und klicken Sie auf (**Speichern**). 

## Anforderungen

Keine weiteren Anforderungen.