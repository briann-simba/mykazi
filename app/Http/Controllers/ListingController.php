<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
//Show all listings
    public function index(){
        //dd(Listing::latest()->filter(request(["tag","search"]))->paginate(4));
        //$listings=Listing::latest()->filter(request(["tag","search"]))->paginate(4);
        
        $listings=Auth::user()->myListings()->latest()->filter(request(["tag","search"]))->paginate(4);

        return view('listings.index',["listings"=>$listings]);
    }
//Show single listing
    public function show(Listing $listing){
        return view('listings.show',["listing"=>$listing]);
    }

    //Show create listing form
        public function create(){
        return view('listings.create',[]);
    }

    public function store(Request $request){
        // dd($request->file('logo'));
      
        $formFields=$request->validate([
            "title"=>'required',
            "company"=>["required",Rule::unique("listings","company")],
            "location"=>"required",
            "email" => ["required","email"],
            "website"=>"required",
            "tags"=>"required",
            "description"=> "required"
        ]);
        if ($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id']=Auth::id();
        Listing::create($formFields);

        return redirect("/")
        ->with('message','Listing created successfully!');
    }

//show Edit Form
    public function edit(Listing $listing){
        return view ('listings.edit',["listing"=>$listing]);
    }

 //Actually Update Listing
public function update(Request $request, Listing $listing){
    $formFields=$request->validate([
        "title"=>'required',
        "company"=>["required"],
        "location"=>"required",
        "email" => ["required","email"],
        "website"=>"required",
        "tags"=>"required",
        "description"=> "required"
    ]);

    if ($request->hasFile('logo')){

        if ($listing->logo && Storage::disk('public')->exists($listing->logo)){
Storage::disk('public')->delete( $listing->logo );
        }
        $formFields['logo']=$request->file('logo')->store('logos','public');
    }

    
$listing->update($formFields);
return redirect()->route("listings.show",$listing->id)->with('message','Listing Updated Successfully!');
}
public function destroy(Listing $listing){
    if ($listing->logo && Storage::disk('public')->exists($listing->logo)){
        Storage::disk('public')->delete( $listing->logo );
                }
                $listing->delete();
                return redirect()->route('listings.index')->with('message','Listing deleted successfully!');
}
}
