<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de commande - MAJAA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300..700&display=swap');
    </style>
</head>
<body style="background: #ffffff; margin: 0; padding: 40px 0; font-family: 'Inter', sans-serif;">
    <!-- Container principal -->
    <div style="max-width: 640px; margin: 0 auto; 
                background: #ffffff;
                border-radius: 24px;
                padding: 40px;
                box-shadow: 0 12px 48px rgba(201,177,148,0.1);">
        
        <!-- En-tête -->
        <header style="text-align: center; margin-bottom: 40px; position: relative;">
            <div style="background: linear-gradient(45deg, #C9B194 0%, #B89E7D 100%); 
                     color: white; 
                     padding: 12px 32px;
                     border-radius: 16px;
                     display: inline-block;
                     font-weight: 700;
                     font-size: 1em;
                     letter-spacing: 0.5px;
                     box-shadow: 0 6px 20px rgba(201,177,148,0.2);
                     position: relative;
                     z-index: 1;">
                Commande #{{ $order->id }}
                <div style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); 
                         width: 60%; height: 4px; background: rgba(201,177,148,0.3); border-radius: 2px;">
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <section style="margin-bottom: 32px;">
            <h1 style="color: #2A2A2A; font-weight: 700; font-size: 2.2em; margin: 0 0 28px 0; text-align: center; 
                     position: relative;
                     padding-bottom: 16px;">
                Nouveau Commande Reçue ✨
                <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); 
                         width: 80px; height: 3px; background: #C9B194; border-radius: 2px;">
                </div>
            </h1>
            
            <!-- Carte de résumé -->
            <div style="background: #FBF9F7;
                    border-radius: 20px;
                    padding: 32px;
                    border: 2px solid rgba(201,177,148,0.15);
                    position: relative;
                    margin-bottom: 20px;">
            <h3 style="color: #2A2A2A; font-weight: 700; margin: 0 0 20px 0; 
                    display: flex; align-items: center; gap: 12px; font-size: 1.1em;">
                <svg style="width: 24px; height: 24px; fill: #C9B194;" viewBox="0 0 24 24">
                    <path d="M12 11.5A2.5 2.5 0 1 0 12 6.5 2.5 2.5 0 0 0 12 11.5zM12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7z"/>
                </svg>
                Détails de la commande
            </h3>
            <address style="color: #666; font-style: normal; line-height: 1.6; margin: 0; padding-left: 36px;">
                <div style="margin-bottom: 12px;">
                    <span style="display: inline-block; width: 80px; color: #C9B194;">Produit :</span>
                    {{ $order->product->name }}
                </div>
                <div style="margin-bottom: 12px;">
                    <span style="display: inline-block; width: 80px; color: #C9B194;">Taille :</span>
                    {{ $order->size }}
                </div>
                <div>
                    <span style="display: inline-block; width: 80px; color: #C9B194;margin-bottom: 12px;">Quantité :</span>
                    {{ $order->quantity }}
                </div>
                <div>
                    <span style="display: inline-block; width: 80px; color: #C9B194;margin-bottom: 12px;">Text Personalisé :</span>
                    {{ $order->text }}
                </div>
                <div>
                    <span style="display: inline-block; width: 80px; color: #C9B194;margin-bottom: 12px;">Méthode de paiement :</span>
                    {{ $order->payment_method }}
                </div>
                <div>
                    <span style="display: inline-block; width: 80px; color: #C9B194;margin-bottom: 12px;">Méthode de livraison :</span>
                    {{ $order->shiping_method }}
                </div>
                <div>
                    <span style="display: inline-block; width: 80px; color: #C9B194;">Total :</span>
                    {{ $order->total_amount }}€
                </div>
                <div>
                    <span style="display: inline-block; width: 80px; color: #C9B194;">La date :</span>
                    {{ $order->created_at->format('d/m/Y H:i') }}
                </div>
                
            </address>
        </div>

            <!-- Section adresse -->
            <div style="background: #FBF9F7;
                     border-radius: 20px;
                     padding: 32px;
                     border: 2px solid rgba(201,177,148,0.15);
                     position: relative;">
                <h3 style="color: #2A2A2A; font-weight: 700; margin: 0 0 20px 0; 
                        display: flex; align-items: center; gap: 12px; font-size: 1.1em;">
                    <svg style="width: 24px; height: 24px; fill: #C9B194;" viewBox="0 0 24 24">
                        <path d="M12 11.5A2.5 2.5 0 1 0 12 6.5 2.5 2.5 0 0 0 12 11.5zM12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7z"/>
                    </svg>
                    Adresse de livraison
                </h3>
                <address style="color: #666; font-style: normal; line-height: 1.6; margin: 0; padding-left: 36px;">
                    <div style="margin-bottom: 12px;">
                        <span style="display: inline-block; width: 80px; color: #C9B194;">Nom :</span>
                        {{ $order->first_name }} {{ $order->last_name }}
                    </div>
                    <div style="margin-bottom: 12px;">
                        <span style="display: inline-block; width: 80px; color: #C9B194;">Adresse :</span>
                        {{ $order->address }}, {{ $order->city }}
                    </div>
                    <div>
                        <span style="display: inline-block; width: 80px; color: #C9B194;">Code postal :</span>
                        {{ $order->postal_code }}
                    </div>
                    <div>
                        <span style="display: inline-block; width: 80px; color: #C9B194;">Téléphone :</span>
                        {{ $order->phone }}
                    </div>
                </address>
            </div>
        </section>

        <!-- Footer -->
        <footer style="border-top: 2px solid rgba(201,177,148,0.1); padding-top: 32px; text-align: center;">
            {{-- <a href="https://majaacouture.com" style="display: inline-block; 
                    background: linear-gradient(45deg, #C9B194 0%, #B89E7D 100%);
                    color: white!important;
                    padding: 16px 40px;
                    border-radius: 50px;
                    text-decoration: none;
                    font-weight: 700;
                    margin-bottom: 24px;
                    transition: transform 0.2s;
                    box-shadow: 0 6px 24px rgba(201,177,148,0.25);">
                Visiter notre boutique
            </a> --}}
            <p style="color: #999; font-size: 0.85em; margin: 16px 0 0 0; line-height: 1.6;">
                © 2025 MAJAA Couture • Tous droits réservés<br>
                <span style="color: #C9B194; font-weight: 500;">Création sur-mesure </span>
            </p>
        </footer>
    </div>
</body>
</html>