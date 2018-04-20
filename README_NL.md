![CardGate](https://cdn.curopayments.net/thumb/200/logos/cardgate.png)

# CardGate module voor PrestaShop 1.6.x

## Support

Deze module is geschikt voor PrestaShop versie **1.6.x** .

## Voorbereiding

Voor het gebruik van deze module zijn CardGate gegevens nodig.  
Bezoek hiervoor [Mijn CardGate](https://my.cardgate.com/) en haal je gegevens op,  
of neem contact op met je accountmanager.  

## Installatie

1. Download en unzip de meest recente [source code](https://github.com/cardgate/prestashop16/releases/) op je bureaublad.

2. Plaats de **inhoud** van de **root** map via FTP in de **modules** map van je website.

3. In je PrestaShop **admin**, ga naar de **Modules** tab en selecteer **Geïnstalleerde Modules**.

4. Controleer het versienummer van de geïnstalleerde CardGate modules.

## Configuratie

1. Log in op het **admin** gedeelte van je PrestaShop.

2. In het linkermenu, bij **Modules**, scroll naar beneden en kies **Betaalmethodes en Gateways**.

3. Scroll naar de **CardGate Bank algemeen** module en kies **Configureer**.

4. Vul de **site ID** en de **hash key** in, deze kun je vinden bij **Sites** op [Mijn CardGate](https://my.cardgate.com/).

5. Klik nu op **Opslaan**.

6. Kies bij Modules de **CardGate betaalmethoden** die je wenst te activeren en installeer ze.

7. Ga naar [Mijn CardGate](https://my.cardgate.com/), kies **Sites** en selecteer de juiste site.

8. Vul bij **Technische Koppeling** de **Callback URL** in, bijvoorbeeld:  
   **http://mijnwebshop.com/modules/cardgate/response.php**  
  (Vervang **http://mijnwebshop.com** met de URL van je webshop.)

9. Zorg ervoor dat je na het testen bij **CardGate Bank algemeen** de **Configuratie** omschakelt van  
    **Test Mode** naar **Live mode** en sla het op (**Save**).

## Vereisten

Geen verdere vereisten.