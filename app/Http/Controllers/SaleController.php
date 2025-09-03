<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    //

    public function index()
    {
        //$sales = Sale::with('user','visit','outlet','saleitems.product')->orderBy('id', 'DESC')->get();
        //dd($sales);
        $sales = Sale::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
            'visit',
            'outlet',
            'outlet.region',        // <--- eager load region
            'outlet.territory',     // <--- eager load territory
            'team', 
            'saleitems' => function ($query) {
                $query->with(['product' => function ($query) {
                    $query->withTrashed();
                }]);
            }
        ])->get();
        return view('sale.index', ['sales' => $sales]);
    }

    public function pendingSales()
    {
        //$sales = Sale::all();
        $userId = auth()->id();
        $sales = Sale::where('user_id', $userId)
            ->where('status', 'pending')->with('user', 'visit', 'outlet',
            'outlet.region',        // <--- eager load region
            'outlet.territory',     // <--- eager load territory
            'team', 
             'saleitems.product')->orderBy('id', 'DESC')->get();
        // return "nothing";
        return response()->json(['sales' => $sales]);
    }
    public function completeSales()
    {
        //$sales = Sale::all();
        $userId = auth()->id();
        $sales = Sale::where('user_id', $userId)
            ->where('status', 'complete')
            ->with('user', 'visit', 'outlet',
            'outlet.region',        // <--- eager load region
            'outlet.territory',     // <--- eager load territory
            'team', 
             'saleitems.product')->orderBy('id', 'DESC')->get();
        // return "nothing";
        return response()->json(['sales' => $sales]);
    }
    public function filterSales(Request $request) {
        //$visits = Visit::all();
        $query = Sale::with(['user' => function ($query) {
            $query->withTrashed()->with('region','territory');
        },'outlet' => function ($query) {
            $query->withTrashed();
        }]); // Eager load relationships for efficiency

        if ($request->user) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->outlet) {
            $query->whereHas('outlet', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->outlet . '%');
            });
        }

        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
            // Retrieve the current page from the request, defaulting to 1 if not set.
        $currentPage = $request->input('page', 1);

        // Explicitly pass the current page to the paginate() method.
        $sales = $query->orderBy('id', 'DESC')->paginate(500, ['*'], 'page', $currentPage);

        // $visits = $query->orderBy('id', 'DESC')->paginate(500);
        return response()->json(['sales'=>$sales]);
    }



    public function showSalesById($id, $object)
    {
        //$sales = Sale::with('user','visit','outlet','saleitems.product')->orderBy('id', 'DESC')->get();
        //dd($sales);
        if ($object === 'clockin') {

            $sales = Sale::whereHas('visit', function ($query) use ($id) {
                $query->where('clockin_id', $id);
            })->with(['user' => function ($query) {
                $query->withTrashed();
            }, 'visit', 'outlet', 'saleitems' => function ($query) {
                $query->with(['product' => function ($query) {
                    $query->withTrashed();
                }]);
            }])->get();
        } else {

            $sales = Sale::with([
                'user' => function ($query) {
                    $query->withTrashed();
                },
                'visit',
                'outlet',
                'saleitems' => function ($query) {
                    $query->with(['product' => function ($query) {
                        $query->withTrashed();
                    }]);
                }
            ])->where($object . '_id', $id)->get();
        }

        return view('sale.index', ['sales' => $sales]);
    }


    public function addSale()
    {
        $users = User::inOrganization()->get();
        $outlets = Outlet::all();
        $products = Product::all();
        //dd($sales);
        return view('sale.create', compact('users', 'outlets', 'products'));
    }

    public function saveSale(Request $request)
    {

        /*
        $incomingFields=$request->validate([
            'userId'=>'required',
            'outletId'=>'required',
            'productId'=>'required',
            'pieces'=>'required'
        ]);

        $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        $incomingFields['outlet_id']=strip_tags($incomingFields['outletId']);
        $incomingFields['product_id']=strip_tags($incomingFields['productId']);
        $incomingFields['pieces']=strip_tags($incomingFields['pieces']);
        */

        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'outletId' => 'required',
            'productId' => 'required',
            'pieces' => 'required'
        ]);

        if ($validator->fails()) {
            //return view('view_name');
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }
        // else {
        //     return view('view_name');
        // }


        $incomingFields = [];
        $incomingFields['user_id'] = strip_tags($request['userId']);
        $incomingFields['outlet_id'] = strip_tags($request['outletId']);
        $incomingFields['product_id'] = strip_tags($request['productId']);
        $incomingFields['visit_id'] = '0';
        $incomingFields['pieces'] = strip_tags($request['pieces']);
        $incomingFields['organization_id'] = auth()->user()->organization_id;
        $incomingFields['team_id'] = auth()->user()->team_id;

        $price = Product::find($incomingFields['product_id'])['price'];
        $incomingFields['value'] = $price * $incomingFields['pieces'];

        //return $incomingFields;

        Sale::create($incomingFields);

        return redirect('/sales');
    }
    // {{ ... }}
    public function showSalesTargetsWind(Request $request)
    {
        $selectedMonth = $request->input('month', date('Y-m'));
        
        // Parse the selected month
        $selectedDate = Carbon::parse($selectedMonth);
        $startDate = $selectedDate->copy()->startOfMonth();
        $endDate = $selectedDate->copy()->endOfMonth();
        
        // Generate list of last 12 months for the dropdown
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonths($i);
            $months[$date->format('Y-m')] = $date->format('F Y');
        }

        $users = User::inOrganization()
            ->with('targetgroup')
            ->get();

        $products = Product::all();

        // Eager load sales for the selected month & year for all users
        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'complete')
            ->whereIn('user_id', $users->pluck('id'))
            ->with('saleitems')
            ->get();

        // Initialize an array to store the product totals
        $usersproducts = [];

        foreach ($users as $user) {
            $product_array = [];

            // Filter sales for the current user
            $user_sales = $sales->where('user_id', $user->id);

            // Loop over each product for the current user
            foreach ($products as $product) {
                $total = 0;

                // Loop through all the sales for this user
                foreach ($user_sales as $sale) {
                    // Loop through all sale items for the current sale
                    foreach ($sale->saleitems as $saleItem) {
                        // Check if the sale item matches the current product
                        if ($saleItem->product_id == $product->id) {
                            // Calculate total based on product target type
                            if ($product->targettype == "amount") {
                                $total += $saleItem->value;
                            } elseif ($product->targettype == "quantity") {
                                $total += $saleItem->pieces;
                            }
                        }
                    }
                }

                // Store the calculated total for the product
                $product_array[$product->id] = $total;
            }

            // Store the totals for the current user
            $usersproducts[$user->id] = $product_array;
        }

        return view('sale.targets', compact('users', 'usersproducts', 'products', 'months', 'selectedMonth'));
    }
    public function showSalesTargets()
    {
        // $lastmonth = Carbon::now()->subMonth()->month;
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonths($i);
            $months[$date->format('Y-m')] = $date->format('F Y');
        }

        $users = User::inOrganization()
            ->with('targetgroup')
            // ->withSum(['sales as total_sales_this_month' => function ($query) {
            //     $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
            //         ->whereYear('created_at', now()->year);
            // }], 'value')
            ->get();

        $products = Product::all();

        // Eager load ONLY current month & year COMPLETE sales and sale items for all users
        $sales = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'complete')
            ->whereIn('user_id', $users->pluck('id'))
            ->with('saleitems')
            ->get();

        // Initialize an array to store the product totals
        $usersproducts = [];

        foreach ($users as $user) {
            $product_array = [];

            // Filter sales for the current user
            $user_sales = $sales->where('user_id', $user->id);

            // Loop over each product for the current user
            foreach ($products as $product) {
                $total = 0;

                // Loop through all the sales for this user
                foreach ($user_sales as $sale) {
                    // Loop through all sale items for the current sale
                    foreach ($sale->saleitems as $saleItem) {
                        // Check if the sale item matches the current product
                        if ($saleItem->product_id == $product->id) {
                            // Calculate total based on product target type
                            if ($product->targettype == "amount") {
                                $total += $saleItem->value;
                            } elseif ($product->targettype == "quantity") {
                                $total += $saleItem->pieces;
                            }
                        }
                    }
                }

                // Store the calculated total for the product
                $product_array[$product->id] = $total;
            }

            // Store the totals for the current user
            $usersproducts[$user->id] = $product_array;
        }

        return view('sale.targets', compact('users','usersproducts','products','months'));
    }

    public function showSalesMap()
    {

        $sales = Sale::with(['user' => function ($query) {
            $query->withTrashed();
        }, 'outlet'])->get();

        $users = User::inOrganization()->get();
        $outlets = Outlet::all();

        //$users = User::inOrganization()->where('usertype','seller')->get();
        return view('sale.map', compact('sales', 'users', 'outlets'));
    }

    public function showSalesAnalytics()
    {

        $visits = Sale::with(['user' => function ($query) {
            $query->withTrashed();
        }, 'outlet'])->get();

        $users = User::inOrganization()->get();
        $outlets = Outlet::all();

        $salesCount = Sale::all()->count();

        $visitsPerMonth = array();
        for ($i = 0; $i <= 11; $i++) {
            $salesPerMonth[$i] = Sale::whereMonth('created_at', date('m', strtotime('-' . $i . ' month')))->count();
        }
        $salesPerMonth = array_reverse($salesPerMonth);

        $dates = [];
        $dayNames = [];
        $salesPerDay = array();
        for ($i = 0; $i <= 6; $i++) {

            $date = now()->subDays($i);
            $dateString = $date->toDateString();
            $dayName = $date->format('l'); // Get the day name (e.g., 'Monday')

            $dates[] = $dateString;
            $dayNames[] = $dayName;

            $date = now()->subDays($i)->toDateString();


            $salesPerDay[$date] = Sale::whereDate('created_at', $date)->count();
        }
        $salesPerDay = array_reverse($salesPerDay);
        $dates = array_reverse($dates);
        $dayNames = array_reverse($dayNames);


        $startOfMonth = date('Y-m-01 00:00:00'); // 1st day of the current month
        $today = date('Y-m-d 23:59:59'); // Current day
        $salesThisMonth = Sale::whereBetween('created_at', [$startOfMonth, $today])->count();

        $startOfWeek = Carbon::now()->startOfWeek(); // Start of the week (Monday)
        $today = Carbon::now()->endOfDay(); // Current day
        $salesThisWeek = Sale::whereBetween('created_at', [$startOfWeek, $today])->count();

        // Visits Today
        $startOfDay = Carbon::now()->startOfDay();
        $endOfDay = Carbon::now()->endOfDay();
        $salesToday = Sale::whereBetween('created_at', [$startOfDay, $endOfDay])->count();


        //get months Jan Feb Mar...Dec
        for ($i = 0; $i <= 11; $i++) {
            $months[] = date("M", strtotime(date('Y-m-01') . " -$i months"));
        }
        //echo "Before";
        //print_r($months);
        //echo "After";
        $months = array_reverse($months);


        $sellersByRegionCount = array();
        $sellersByRegionNames = array();
        $sellersByRegion = User::inOrganization()->with(['region' => function ($query) {
            $query->withTrashed();
        }])->select('region_id', DB::raw('COUNT(region_id) as count'))
            ->groupBy('region_id')
            ->orderBy('count', 'desc')
            ->take(5)->get();

        $unassignedCount = 0;

        //return $sellersByRegion;
        foreach ($sellersByRegion as $seller) {
            # code...
            array_push($sellersByRegionCount, $seller['count']);
            if ($seller['region'] == null) {
                array_push($sellersByRegionNames, "Unassigned");
            } else {
                array_push($sellersByRegionNames, $seller['region']['name']);
            }
        }

        $topSellerUserNames = [];
        $topSellerSalesCount = [];

        $topSellersGraph = Sale::with(['user' => function ($query) {
            $query->withTrashed();
        }])->select('user_id', DB::raw('COUNT(user_id) as count'))
            ->groupBy('user_id')
            ->orderBy('count', 'desc')
            ->take(10)->get();

        foreach ($topSellersGraph as $topSeller) {


            // $sellerName=$topSeller['user']['name'];
            $sellerName = $topSeller['user'] ? $topSeller['user']['name']  . ($topSeller['user']->trashed() ? ' (Deleted User)' : '') : 'Deleted User';
            $sellerNames = explode(' ', $sellerName);
            if (count($sellerNames) == 1) {
                array_push($topSellerUserNames, $sellerNames[0]);
            } else {
                array_push($topSellerUserNames, $sellerNames[0] . "\n" . $sellerNames[1]);
            }

            $sellerSalesCount = $topSeller['count'];
            array_push($topSellerSalesCount, $sellerSalesCount);
        }



        //$users = User::inOrganization()->where('usertype','seller')->get();
        return view('sale.analytics', compact(
            'salesPerMonth',
            'months',
            'salesCount',
            'salesThisMonth',
            'salesThisWeek',
            'salesToday',
            'dates',
            'salesPerDay',
            'sellersByRegionCount',
            'sellersByRegionNames',
            'topSellerSalesCount',
            'topSellerUserNames'
        ));
    }


    public function deleteSale($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect('/sales');
    }

    public function showEditSale($id)
    {
        $sale = Sale::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
            'saleitems' => function ($query) {
                $query->with(['product' => function ($query) {
                    $query->withTrashed();
                }]);
            }
        ])->get()->find($id);
        //$sale = Sale::find($id);
        return view('sale.edit', ['sale' => $sale]);
    }

    // public function showEditSale(Request $request){
    //     $incomingFields=$request->validate([
    //         'id'=>'required|numeric|digits_between:1,11'
    //     ]);
    //     $sale = Sale::find($incomingFields['id']);
    //     return view('edit-sale',['sale'=>$sale]);
    // }


    public function saveEditSale($id, Request $request)
    {
        // $organization_id=auth()->user()->organization_id;

        $request->validate([
            'productPiecesTotal' => 'required|numeric|digits_between:1,20',
            'productValueTotalNumber' => 'required|numeric|digits_between:1,20',
            'status' => 'required|string|max:255'
        ]);

        // $incomingFields['organization_id']=$organization_id;

        $incomingFields["pieces"] = $request->input('productPiecesTotal');
        $incomingFields["value"] = $request->input('productValueTotalNumber');
        $incomingFields["status"] = $request->input('status');

        $sale = Sale::find($id);

        $sale->update($incomingFields);

        // $incomingFields['user_id']=strip_tags($incomingFields['userId']);
        // $incomingFields['outlet_id']=strip_tags($incomingFields['outletId']);
        // $incomingFields['product_id']=strip_tags($incomingFields['productId']);
        // $incomingFields['pieces']=strip_tags($incomingFields['pieces']);

        $productPieces = $request->input('productPieces'); // This will be an associative array with posaudititem IDs as keys
        // $salepieces = 0;

        foreach ($productPieces as $id => $pieces) {
            // Update the posaudititem with the given ID
            $validator = Validator::make(
                ['pieces' => $pieces],
                ['pieces' => 'required|numeric|digits_between:1,20']
            );

            if ($validator->fails()) {
                // Handle the validation error
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $saleitem = SaleItem::find($id);
            if ($saleitem) {
                $saleitem->pieces = $pieces;
                // $salepieces = $salepieces + $pieces;
                $saleitem->save();
            }
        }


        $productValue = $request->input('productValue'); // This will be an associative array with posaudititem IDs as keys
        // $salepieces = 0;

        foreach ($productValue as $id => $value) {
            // Update the posaudititem with the given ID
            $validator = Validator::make(
                ['value' => $value],
                ['value' => 'required|string|max:255']
            );

            if ($validator->fails()) {
                // Handle the validation error
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $saleitem = SaleItem::find($id);
            if ($saleitem) {
                $saleitem->value = str_replace("KSh. ", "", str_replace(",", "", $value));
                // $salepieces = $salepieces + $pieces;
                $saleitem->save();
            }
        }

        // $incomingFields['pieces']=$salepieces;



        return redirect('/sales');
    }
}
