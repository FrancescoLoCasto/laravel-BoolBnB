<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $properties = Property::where('user_id', 'userId')->get();
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = New Property();
        $services = Service::all();
        $sponsorships = Sponsorship::all();

        return view('admin.properties.create', compact('property', 'services', 'sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $property
     * @return \Illuminate\Http\Response
     */
    public function store(Request $property)
    {
        $data = $property->all();
        $newProperty = new Property();
        $newProperty->fill($data);
        $newProperty->slug = Str::slug($newProperty->title);
        $newProperty->save();
        $newProperty->slug .= "-$newProperty->id";
        $newProperty->update();

        return redirect()->route('admin.properties.show', $newProperty->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        // ?? slider per vedere la proprietà precedente o successiva
        $nextProperty = Property::where('title', '>', $property->title)->orderBy('title')->first();
        $prevProperty = Property::where('title', '<', $property->title)->orderBy('title', 'DESC')->first();

        return view('admin.properties.show', compact('property', 'nextProperty', 'prevProperty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Property $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $services = Service::all();
        $sponsorships = Sponsorship::all();

        return view('admin.properties.edit', compact('property', 'services', 'sponsorships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $data = $request->all();

        $property->slug = Str::slug($property->title . "-$property->id");
        $property->update($data);
        return redirect()->route('admin.properties.show', $property->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Property $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index');
    }
}

