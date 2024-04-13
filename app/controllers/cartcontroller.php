<?php

namespace Controllers;

use Models\Order;
use Models\Orderitem;
use Services\OrderService;


class CartController extends Controller
{

    public function payment()
    {
        $order = new Order();
        $order->userid = $_SESSION['user']->id;
        $order->status = 0;
        $order->date = date('Y-m-d H:i:s');
        $order->total = 0;

        $orderService = new OrderService();
        $orderid = $orderService->create($order);

        $cart = $_SESSION['cart'] ?? [];
        foreach ($cart as $productid => $quantity) {
            $orderitem = new Orderitem();
            $orderitem->orderid = $orderid;
            $orderitem->productid = $productid;
            $orderitem->quantity = $quantity;
            $orderitem->price = 0;

            $orderService->addOrderitem($orderitem);
        }

        unset($_SESSION['cart']);

        header('Location: /cart');

    }

    public function add()
    {
        $productid = $_POST['productid'];
        $quantity = $_POST['quantity'];

        $cart = $_SESSION['cart'] ?? [];
        $cart[$productid] = $quantity;
        $_SESSION['cart'] = $cart;

        header('Location: /cart');
    }

    public function remove()
    {
        $productid = $_POST['productid'];

        $cart = $_SESSION['cart'] ?? [];
        unset($cart[$productid]);
        $_SESSION['cart'] = $cart;

        header('Location: /cart');
    }

    public function clear()
    {
        unset($_SESSION['cart']);

        header('Location: /cart');
    }

}