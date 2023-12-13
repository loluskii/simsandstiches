<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Shipping;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function currencyIndex()
    {
        $currencies = Currency::all();
        return view('admin.settings.currency.index', compact('currencies'));
    }

    public function shippingIndex()
    {
        $shipping = Shipping::all();
        return view('admin.settings.shipping.index', compact('shipping'));
    }

    public function addCurrency(Request $request)
    {
        try {
            $currency = new Currency;
            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->exchange_rate = $request->exchange_rate;
            $currency->code = $request->code;
            $currency->icon = $request->icon;
            $currency->save();

            return back()->with('success', 'Currency Added successfully!');

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function addLocation(Request $request)
    {
        try {
            $location = new Shipping;
            $location->group_name = $request->group_name;
            $location->group_locations = $request->group_locations;
            $location->price = $request->price;
            $location->save();

            return back()->with('success', 'Location Added successfully!');

        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function editLocation(Request $request, $id)
    {
        try {
            $location = Shipping::find($id);
            $location->group_name = $request->group_name ?? $location->group_name;
            $location->group_locations = $request->group_locations;
            $location->price = $request->price ?? $location->price;
            $location->save();

            return back()->with('success', 'Location updated!');

        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function editCurrency(Request $request, $id)
    {
        try {
            $currency = Currency::find($id);
            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->exchange_rate = $request->exchange_rate;
            $currency->code = $request->code;
            $currency->icon = $request->icon;
            $currency->save();

            return back()->with('success', 'Product updated!');

        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function deleteCurrency($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return back()->with('success', 'Deleted successfully');
    }

    public function deleteLocation($id)
    {
        $location = Shipping::find($id);
        $location->delete();
        return back()->with('success', 'Deleted successfully');
    }
}
