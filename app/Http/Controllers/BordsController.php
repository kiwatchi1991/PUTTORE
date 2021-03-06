<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Bord;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;


class BordsController extends Controller
{
    /**
     * トークルーム一覧表示
     */
    public function index(Request $request)
    {
        Log::debug('連絡掲示板：index');

        //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
        $id = Auth::user()->id;
        $bords = Order::where('orders.user_id', $id)
            ->orderBy('msg_updated_at', 'desc')
            ->join('products', 'orders.product_id', 'products.id')
            ->orWhere('products.user_id', $id)
            ->join('users', 'products.user_id', 'users.id')
            ->select('orders.id', 'orders.user_id', 'users.pic', 'products.id as p.id', 'products.user_id as p.user_id', 'products.name', 'msg_updated_at')
            ->get();

        $messages = Message::orderBy('id', 'desc')->get();
        $user = User::all();

        return view('bords.index', [
            'bords' => $bords,
            'id' => $id,
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    /**
     * 詳細表示
     */
    public function show(Request $request, $id)
    {
        Log::debug('連絡掲示板：show');

        //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
        $self_user_id = Auth::user()->id;
        $bord = Order::where('orders.id', $id)
            ->join('products', 'orders.product_id', 'products.id')
            ->join('users', 'products.user_id', 'users.id')
            ->select('orders.id', 'orders.user_id as o.u_id', 'users.pic', 'products.user_id as p.u_id', 'products.name')
            ->first();

        $user = User::all();

        $order = Order::find($id);
        $ordersId = $order->id;

        $messages = Message::where('messages.order_id', $id)->get();

        return view('bords.show', [
            'order' => $order,
            'ordersId' => $ordersId,
            'messages' => $messages,
            'bord' => $bord,
            'self_user_id' => $self_user_id,
            'user' => $user,

        ]);
    }
}
