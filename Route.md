@Route et json site web
#Accueil
("/bar")
("/resto")
("/where")


#navBar (resto,bar,panier$)
("/cart")
("/bar")
("/resto")
("/where")

#bar
  
    json
        alcool
            ->id
            ->name
            ->liter
            ->degree
            ->price
        soft
            ->id
            ->name
            ->liter
            ->price
#Resto
  
    json
        burgers
            ->id
            ->name
            ->array ingredients
            ->price
        salades
            ->id
            ->name
            ->array ingredients
            -price
        dessert
            ->id
            ->name
            ->array ingredients
            -price
#panier(commande)
    
            form
               json
                ->telNumber
                ->LastName
                ->tableau product
                    ->id
                    ->name
                    ->amount
                    ->price
                ->dateCmd
#Admin
("/admin")
    
                ->idCmd
                ->telNumber
                ->LastName
                ->array product
                    ->id
                    ->name
                    ->amount
                    ->price
                ->dateCmd
    Validation:
    $_POST -> true