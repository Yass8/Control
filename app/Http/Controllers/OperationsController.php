<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\Solde;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $somme = $request->somme;
        $type = $request->type;
        $description = $request->description;
        $id=1;$credit=0;$debit=0;

        $operation = new Operation();
        $operation->type = $type;
        $operation->num = $this->generateRegistrationId();
        $operation->description = $description;
        
        if ($type == "Sorti") {
            $operation->debit = $somme;
            $debit = $somme;
        } else {
            $operation->credit = $somme;
            $credit = $somme;
        }
        $operation->nv_solde = $this->newSolde($id, $credit, $debit);
        $operation->version_id = $id;
        $operation->save();
        return redirect()->route('app');
        
    }


    function generateRegistrationId() {
        $num = mt_rand(1000000000, 9999999999); // better than rand()
    
        // call the same function if the id exists already
        if ($this->registrationIdExists($num)) {
            return $this->generateRegistrationId();
        }
    
        // otherwise, it's valid and can be used
        return $num;
        
    }
    
    function registrationIdExists($n) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Operation::where('num', $n)->exists();
    }

    function newSolde($id,$credit,$debit){

        $solde = Solde::find($id);
        $ancienSolde = $solde->nv_solde;
        $newSolde = $ancienSolde + $credit - $debit;
        $solde->nv_solde = $newSolde;
        $solde->update();

        return $newSolde;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
