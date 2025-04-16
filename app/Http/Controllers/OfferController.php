<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offerAddEdit($offer_id = "") 
    {
        return view('host.offer.add-edit');
    }
}
