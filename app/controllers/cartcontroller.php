<?php

namespace Controllers;

use Models\Order;
use Models\Orderitem;
use Models\OrderStatus;
use Services\OrderService;
use Services\ProductService;
use Services\UserService;


class CartController extends Controller
{

    private $productService;
    private $orderService;
    private $userService;

    function __construct()
    {
        $this->productService = new ProductService();
        $this->orderService = new OrderService();
        $this->userService = new UserService();
    }
    public function payment()
    {
        if (!$this->checkForJwt()) {
            $this->respondWithError(401, "Unauthorized");
            return;
        }

        $postedData = json_decode(file_get_contents('php://input'), true);
        $items = $postedData['products'];
        $total = (float) $postedData['total'];

        $order = new Order();
        $order->status = OrderStatus::Fulfilled->value;
        $username = $this->getUsernameFromJwt();
        $user = $this->userService->getByUsernameOrEmail($username, null);
        $order->userid = $user->id;
        $order->date = date("Y-m-d H:i:s");
        $order->total = $total;
        $order->id = $this->orderService->insert($order);

        foreach ($items as $item) {
            $product = $this->productService->getOne($item['product']['id']);
            $quantity = $item['quantity'];
            $orderitem = new Orderitem(0, $order->id, $product->id, $quantity, $product->price);
            $orderitem->id = $this->orderService->insertOrderItem($orderitem);
        }

        $this->respond($order);
    }
}