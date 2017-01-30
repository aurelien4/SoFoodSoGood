# scénario ux


        Accueil->
            ->bouton resto(/restaurant)
            ->bouton bar(/bar)
            ->bouton OU?(/where)
            ->bouton concept(/concept)
        
        resto/bar
            ->Chargement des données Resto.
                ->bouton Resto (Route, "/restaurant") 
            ->Au click sur le boutond bar, chargement des data bar(Route "/Bar").
            ->bouton routes vers géolocalisation (OU?)Route("/geolocalisation")
                ->api google chargement
            ->bouton panier, chargement des donnée du pannier.
                ->Route("/Panier")
        ->Panier
            ->Delete de product dans la session.
            ->Bouton vers paiement(Route /paiement)
        ->paiement
            ->Data recu,
                -> id_cmd,quantité,id_product,prix, user(nom,prénm,tel) 
            ->Data panier à stocker 
            
        ->Géolocalisation
            ->chargement api google
            
            Resto!:
                7 burger.
            Menu:
               peut être?!
            
            bar:
                7bierre
                4soft.
                
             