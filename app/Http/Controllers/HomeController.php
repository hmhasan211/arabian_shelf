<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Volume;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentDate =  date('Y-m-d');
        $product= Product::where('active', '=', 'yes')->orderBy('id','desc')->limit(15)->get();
        $brands = Brand::where('active', '=', 'yes')->orderby('name')->get();
        $trendingproducts=Product::where('exclusive','=','yes')->where('active', '=', 'yes')->orderBy('id','desc')->limit(25)->get();
        $onsells= Product::where('active', '=', 'yes')->where('main_price' ,'!=', 'old_price')->where('from','<=', $currentDate, '&&', 'till','>=', $currentDate )->orderBy('id','desc')->limit(15)->get();
        // dd($onsells);
        return view('index',compact('currentDate','product','brands','trendingproducts','onsells'));
    }
    public function allCategories()
    {
        $currentDate =  date('Y-m-d');
        $products= Product::where('active', '=', 'yes')->orderBy('id','desc')->get();
    //    dd($product);
        return view('all_categories',compact('currentDate','products'));
    }

    public function atr()
    {
        $product=Product::find(3);

        // dd($product);
        $product->volumes()->attach([1=>['qty' => 6,'price'=>150],2=>['qty' => 7,'price'=>200]]);
        // $product->volumes()->sync([1=>['qty' => 6,'price'=>150]]);
        // $product->volumes()->detach();
        // dd($product);

    }
    //about us show
    public function aboutUs()
    {
        return view('aboutus');

    }
     //trems and condition  show
     public function tremsCondition()
     {
         return view('trems_condition');

     }

       //search product
    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('products')
                ->orWhere('name', 'LIKE', '%'.$query.'%')
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative ; padding:10px; overflow: scroll; overflow-x: hidden; height: 20em;">';
            foreach($data as $row) {
                $output .= '<li><a  href="#">'.$row->name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    //search _result
    public function searchProduct(Request $request){
        $search = $request->search;
        // $currentDate =  date('Y-m-d');
        $searchProducts = Product::orWhere('name','like','%'.$search.'%')
            // ->orWhere('short_description','like','%'.$search.'%')
            // ->orWhere('description','like','%'.$search.'%')
            ->get();
        return view('searchProduct',compact('search','searchProducts'));
    }
}
