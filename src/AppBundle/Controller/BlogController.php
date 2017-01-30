<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16/01/2017
 * Time: 10:54
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Cart;
use AppBundle\Entity\Category;
use AppBundle\Entity\Drink;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->redirect("/resto");
    }
    /**
     * @Route("/bar", name="bar")
     * @Method({"GET"})
     */
    public function barAction()
    {
        $em = $this->getDoctrine();
        $drinks = $em->getRepository("AppBundle:Drink")->findAllByJoinedIdBar(2);
        if($drinks == null){
            throw new NotFoundHttpException("404 not Found");
        }
        $alcools= [];
        $soft = [];
        foreach ($drinks as $key => $value){
            if($value["liter"] == null){
                unset($value["liter"]);
                array_push($alcools, $value);
            }else{
                unset($value["degree"]);
                array_push($soft, $value);
            }
        }
        $drinks = [
                "alcools"=>$alcools,
                "soft"=>$soft
        ];

        return new JsonResponse($drinks);
    }

    /**
     * @Route("/resto", name="restaurant")
     * @Method({"GET"})
     */
    public function restoAction(){
        $em = $this->getDoctrine();
        $items = $em->getRepository("AppBundle:Item")->findAllByIdJoinedCategoryAndType(1);
        if($items == null){
            throw new NotFoundHttpException("404 not Found");
        }

        $category = [];
        $burgers = [];
        foreach ($items as $key => $value){
            if($value["category"] == "burgers"){
                array_push($category, $value["category"]);
                unset($value["category"]);
                array_push($burgers, $value);
            }
        }
        $items = [
            "restaurant" =>[
                $category[0] => $burgers
            ]
        ];
        return new JsonResponse($items);
    }

    /**
     * @Route("/where", name="where")
     */
    public function whereAction(){
        #To:Do bin tout ce les datas de la géolocalisation.
    }

    /**
     * @Route("/purchase", name="cart")
     */
    public function puchaseAction($id_cmd=null, $amount=null, $id_item=null, $price=null, $id_user=null, $lastName_user=null, $number_user=null){
        # id_cmd , quantité , id_product, prix, id_user, prénom_user, tel_user
        //on select tout les produit compris dans la commande.
        $newPurchase = new Cart();
        $em = $this->getDoctrine()->getManager();
        $id_item = 5;
        if(!is_array($id_item)){
            $product = $this->getDoctrine()->getRepository("AppBundle:Item")->find($id_item);
            $newPurchase->addItem($product);
        }else{
            foreach ($id_item as $key => $value){
                $products = $this->getDoctrine()->getRepository("AppBundle:Item")->find($value);
                $newPurchase->addItem($products);
            }
        }
        $user = new User();
        $user->setfirstName("Jen miche miche");
        $user->setPhoneNumber(0605762563);
        $em->persist($user);
        $newPurchase->setAmount(10);
        $newPurchase->setpriceWt(150);
        $newPurchase->setUser($user);
        $newPurchase->setEndPurchase(false);
        $em->persist($newPurchase);
        $em->flush();
        return new Response("Ok".$newPurchase->getId());
    }

    /**
     * @Route("/returnPurchase/{id}", name="return")
     * @Method({"GET"})
     */
    public function returnPurchaseAction($id){
        $em = $this->getDoctrine();
        $purchase = $em->getRepository("AppBundle:Cart")->findByIdsJoinedUser($id);
        if($purchase == null){
            throw new NotFoundHttpException("404 Not Found");

        }
        $purchase = $purchase[0];
        $item = [$purchase["id"],
            $purchase["itemName"],
            $purchase["itemPrice"]
        ];

        $purchaseArray = [
                "purchase"=>$purchase[0]
        ];
        $purchaseArray["purchase"] += [
                "item"=>$item
            ];

        return new JsonResponse($purchaseArray);

    }
    /**
     * @Route("deletePurchase/{id}", name="delete")
     * @Method({"GET"})
     */
    public function deletePurchaseAction($id){
        #To:DO Possibilité de suprimer
        $em = $this->getDoctrine();
        $deletePurchase = $em->getRepository("AppBundle:Cart")->find($id);
        $em->getManager()->remove($deletePurchase);
        $em->getManager()->flush();
        return new Response(dump($deletePurchase));
    }

    /**
     * @Route("/adminPage", name="adminPage")
     */
    public function adminPageAction(){
        $em= $this->getDoctrine();
        $purchases = $em->getRepository("AppBundle:Cart")->findAllJoinedByUser();
        $purchasesListe = ["Purchases" => []];
        foreach ($purchases as $key => $value){
                array_push($purchasesListe["Purchases"], $value);
        }
        return new JsonResponse($purchasesListe);
    }
    /**
     * @Route("/endPurchase/{id}", name="Admin/purchase")
     * @Method({"GET"})
     */
    public function EndPurchaseAction($id){
        #fonction qui permet au vendeur de valider une commande
        $em = $this->getDoctrine();
        $purchase = $em->getRepository("AppBundle:Cart")->find($id);
        if($purchase == null){
            throw new NotFoundHttpException("Commande non existante");
        }
        $purchase->setEndPurchase(true);
        $em->getManager()->flush();
        return new Response("Validation de fin de commande.");
    }

    /**
     * @return JsonResponse
     * @Route("/dailyPurchase", name="dailyPurchase")
     */
    public function dailyPurchaseAction(){
        #L'admin peux visualiser toute les commandes validées
        $em = $this->getDoctrine();
        $purchase = $em->getRepository("AppBundle:Cart")->findAllJoinedByUserValid();
        if($purchase == null ){
            throw new NotFoundHttpException("Aucune commande valider");
        }
        $purChaseValidDatList = ["validPurchase" => []];
        foreach ($purchase as $key => $value){
            array_push($purChaseValidDatList["validPurchase"], $value);
        }
        return new JsonResponse($purChaseValidDatList);
    }
}