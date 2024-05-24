<?php
namespace App\Http\Controllers\Main\Pharmacy\Order;

use App\Http\Controllers\Controller;
use App\Models\MedecinePharmacy;
use App\Models\Pharmacy;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Pharmacy $pharmacy, Order $order)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $newStatus = $request->status;
        $oldStatus = $order->status;

        // Обновляем статус в продуктах заказа
        $products = json_decode($order->products, true);
        foreach ($products as &$product) {
            if ($product['pharmacy']['id'] == $pharmacy->id) {
                $product['status'] = $newStatus;
            }
        }

        // Если новый статус "Отменен", возвращаем товары на склад
        if ($newStatus === 'Отменен' && $oldStatus !== 'Отменен') {
            DB::transaction(function () use ($products, $pharmacy) {
                foreach ($products as $product) {
                    if ($product['pharmacy']['id'] == $pharmacy->id) {
                        $medicineId = $product['medicine']['id'];
                        $count = $product['count'];

                        $medicinePharmacy =MedecinePharmacy::where('medicine_id', $medicineId)
                            ->where('pharmacy_id', $pharmacy->id)
                            ->first();

                        if ($medicinePharmacy) {
                            $medicinePharmacy->quantity += $count;

                            // Обновляем доступность
                            if ($medicinePharmacy->quantity > 0) {
                                $medicinePharmacy->availability = 'в наличии';
                            }

                            $medicinePharmacy->save();
                        }
                    }
                }
            });
        }

        $order->products = json_encode($products);
        $order->status = $newStatus;
        $order->save();

        return redirect()->route('pharmacy.order.index', $pharmacy)->with('success', 'Статус заказа для аптеки успешно обновлен.');
    }
}
