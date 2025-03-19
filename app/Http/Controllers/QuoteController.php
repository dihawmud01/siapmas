<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Quote::latest()->get();
        return view('admins.quotes.index', compact('quotes'));
    }

    public function createQuote()
    {
        return view('admins.quotes.create');
    }

    public function storeQuote(Request $request)
    {
        $quotes = $request->all();

        if ($request->hasFile('img')) {
            // Cek apakah file dikirim
            $extension = $request->file('img')->getClientOriginalExtension();
            $newFileName = 'quotes_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->move(public_path('/storage/images'), $newFileName);
            $quotes['img'] = 'storage/images/' . $newFileName; // Simpan path yang benar
        }

        Quote::create($quotes);
        Alert::success('Mantap Sahabat', 'Quote Berhasil Ditambahkan');

        return redirect()->route('quotes.index');
    }

    public function editQuote($id, Request $request)
    {
        $quote = Quote::find($id);
        return view('admins.quotes.edit', compact('quote'));
    }

    public function updateQuote($id, Request $request)
    {
        $quoteToUpdate = Quote::findOrFail($id);
        $quoteData = $request->all();

        if ($request->hasFile('img')) {
            // Cek apakah file dikirim
            $extension = $request->file('img')->getClientOriginalExtension();
            $newFileName = 'quotes_update_' . $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->move(public_path('/storage/images'), $newFileName);
            $quoteData['img'] = 'storage/images/' . $newFileName; // Simpan path yang benar
        }

        $quoteToUpdate->update($quoteData);
        Alert::success('Mantap Sahabat', 'Quote Berhasil Diubah');

        return redirect()->route('quotes.index');
    }

    public function destroyQuote($id)
    {
        $quotes = Quote::findOrFail($id);
        $quotes->delete();
        Alert::success('Mantap Sahabat', 'Quote Berhasil Dihapus');

        return redirect()->route('quotes.index');
    }
}
