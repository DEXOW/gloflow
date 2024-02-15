<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Show the application client Management Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients_manager', compact('clients'));
    }

    public function add_client(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'address' => 'required|min:8',
            'contact_number' => 'required',
        ]);

        Client::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'contact_number' => $validated['contact_number'],
        ]);

        return Redirect::back()->with('success', 'client added successfully.');
    }

    public function delete_client($id) : RedirectResponse
    {   
        Client::where('id', $id)->delete();
        
        return Redirect::back()->with('success', 'client deleted successfully.');
    }

    public function update_client(Request $request, $id) : RedirectResponse
    {

        $name = $request->input('name');
        $email = $request->input('email');
        $contact_number = $request->input('contact_number');
        $address = $request->input('address');

        $client = Client::find($id);

        if ($client->name != $name) {
            $client->name = $name;
        }
        if ($client->email != $email) {
            $client->email = $email;
        }
        if ($client->contact_number != $contact_number) {
            $client->contact_number = $contact_number;
        }
        if ($client->address != $address) {
            $client->address = $address;
        }

        $client->update();

        return Redirect::back()->with('success', 'client updated successfully.');
    }

    public function toggle_client($id) : RedirectResponse
    {
        $client = client::find($id);
        $client->status = $client->status == 'active' ? 'inactive' : 'active';
        $client->update();

        return Redirect::back()->with('success', 'client activated successfully.');
    }
}
