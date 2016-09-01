<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdminCitiesFormRequest;

use Nht\Http\Controllers\Admin\AdminController;

use Nht\Hocs\Cities\CityRepository;

class CitiesController extends AdminController
{
    public function __construct(CityRepository $postCity){
        parent::__construct();       
        $this->postCity = $postCity;
    }

    public function getIndex(){
        $cities = $this->postCity->getAllCities();
        return view('admin/cities/index', compact('cities'));
    }

    public function getCreate(){
        $data = $this->postCity->getAll();
        return view('admin/cities/create',compact('data'));
    }

    public function postCreate(AdminCitiesFormRequest $request){
        $data = $request->except('_token');

        if( $this->postCity->create($data) ) {
            return redirect()->back()->with('success', trans('general.messages.create_success'));
        }

        return redirect()->back()->with('error', trans('general.messages.create_fail'));
    }

    public function getEdit($id){
        $data = $this->postCity->getAll();
        $city = $this->postCity->getById($id);
        return view('admin/cities/edit', compact('city','data'));
    }

    public function postEdit($id,AdminCitiesFormRequest $request){
        $city = $this->postCity->getById($id);
        $data = $request->except('_token');
        if( $this->postCity->update($data, ['cit_id' => $id]) ) {
            return redirect()->route('admin.cities.index')->with('success', trans('general.messages.update_success'));
        }

        return redirect()->route('admin.cities.index')->with('error', trans('general.messages.update_fail'));
    }

    public function getDelete($id){
        $city = $this->postCity->getById($id);
        $child = $city->getChild;
        foreach ($child as $key => $item_child) {
            $item_child->delete();
        }
        if($city->delete()) {
            return redirect()->back()->with('success', trans('general.messages.delete_success'));
        }

        return redirect()->back()->with('success', trans('general.messages.delete_fail'));
    }
}
