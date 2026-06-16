<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return response()->json($currencies, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $currency = Currency::create($request->all());

        return response()->json($currency, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            return response()->json(['message' => 'Валюту не знайдено'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($currency, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            return response()->json(['message' => 'Валюту не знайдено'], Response::HTTP_NOT_FOUND);
        }

        $currency->update($request->all());

        return response()->json($currency, Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            return response()->json(['message' => 'Валюту не знайдено'], Response::HTTP_NOT_FOUND);
        }

        $currency->delete();

        return response()->json(['message' => 'Валюту успішно видалено'], Response::HTTP_NO_CONTENT);
    }
}
