<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class CountryController extends Controller
{
    public function welcome()
    {
        $countries = Country::all();
        return view('welcome', compact('countries'));
    }
    public function getStates()
    {
        $country_id = request('country');
        $states = State::where('country_id', $country_id)->get();

        $states = State::where('country_id', $country_id)->get();
        $options = "<option value=''>Selecciona la ciudad</option>"; // Opción por defecto
        foreach ($states as $state) {
            $options .= '<option value="' . $state->id . '">' . $state->name . '</option>'; // Concatenar opciones
        }
        return response()->json(['options' => $options]); // Devolver JSON
    }
}
