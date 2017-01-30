# Entity User  
   Var/integer/auto
   + id  
   String/length=100
   + firstName  
   decimal
   + Number  

# Entity Pannier
    + id
    decimal
    + quantité
    join/Item
    + product
    Use de price prélever
    + prixTTc
    Join/User
    + user
Utilisation de l'entiter produit pour selectionner le ou les bon produit(s)


