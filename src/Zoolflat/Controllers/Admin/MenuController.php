<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 6/5/18
 * Time: 2:37 AM
 */

namespace Zoolflat\Zoolflat\Zoolflat\Controllers\Admin;


use Zoolflat\Zoolflat\Zoolflat\Models\Menu;
use Zoolflat\Zoolflat\Zoolflat\Models\MenuItem;
use Zoolflat\Zoolflat\Zoolflat\Models\Module;
use Zoolflat\Zoolflat\Zoolflat\Requests\MenuRequest;

class MenuController
{
    public function index(){

        $menus = Menu::get();

        return view('Zoolflat::admin.menu.index' , compact('menus'));
    }

    public function store(MenuRequest $request , Menu $menu){

        $menu->create($request->all());

        return redirect()->back();
    }

    public function delete($id , Menu $menu){

        if($id == 1){
            return redirect()->back();
        }
        $menu->findOrFail($id)->delete();

        return redirect()->back();
    }

    public function build($id  , Menu $menu){

        $menu = $menu->findOrFail($id);

        $parents = MenuItem::where('parent_id' , 0)->where('menu_id' , $menu->id)->pluck('name_'.l() , 'id')->toArray();

        $items = MenuItem::where('menu_id' , $id)
            ->orderBy('order')
            ->where('parent_id' ,0)
            ->with('parent')
            ->get();

        return view('Zoolflat::admin.menu.build' , compact('menu' , 'parents' , 'items'));
    }
}