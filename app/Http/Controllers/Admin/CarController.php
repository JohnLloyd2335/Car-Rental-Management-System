<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Car\StoreCarRequest;
use App\Http\Requests\Admin\Car\UpdateCarRequest;
use App\Models\Accessory;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarAccessory;
use App\Models\Category;
use App\Models\Rental;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::pluck("name", "id")->toArray();
        $brands = Brand::pluck("name", "id")->toArray();


        return view("admin.car.index", compact('categories', 'brands'));
    }

    public function show(Car $car)
    {
        $car->load(['category', 'brand', 'car_accessories', 'rentals']);
        $car_images = json_decode($car->images);
        $car_rental_count = $car->rentals->whereIn('status', ['Active', 'Completed'])->count();

        //To be added review count and car average rating
        $review_count = Review::whereHas('rental', function ($query) use ($car) {
            $query->where('status', 'Completed')->where('car_id', $car->id);
        })->count();

        $comment_count = Review::whereNotNull('comment')->whereHas('rental', function ($query) use ($car) {
            $query->where('status', 'Completed')->where('car_id', $car->id);
        })->count();

        $car_avg_rating = Review::whereHas('rental', function ($query) use ($car) {
            $query->where('car_id', $car->id);
        })->avg('stars');

        return view("admin.car.show", compact("car", "car_images", "car_rental_count", "review_count", "comment_count", "car_avg_rating"));
    }

    public function create()
    {

        $categories = Category::pluck("name", "id")->toArray();
        $brands = Brand::pluck("name", "id")->toArray();
        $accessories = Accessory::pluck("name", "id")->toArray();

        return view("admin.car.create", compact("categories", "brands", 'accessories'));
    }

    public function store(StoreCarRequest $request)
    {
        DB::beginTransaction();

        try {
            $car = Car::create([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'model' => $request->model,
                'year' => $request->year,
                'price_per_day' => floatval($request->price_per_day),
                'plate_number' => $request->plate_number,
                'description' => $request->description
            ]);

            if ($car) {
                foreach ($request->accessories as $key => $value) {

                    CarAccessory::create([
                        'car_id' => $car->id,
                        'accessory_id' => $value,
                    ]);
                }
                $fileNames = [];
                for ($i = 0; $i <= 5; $i++) {
                    if ($request->hasFile('image_' . $i)) {
                        $fileExt = $request->file('image_' . $i)->getClientOriginalExtension();
                        $fileName = time() . '_car_' . $i . '.' . $fileExt;

                        $saveImage = $request->file('image_' . $i)->storeAs('public/car_images/' . $car->id, $fileName);
                        if ($saveImage) {
                            array_push($fileNames, $fileName);
                        }
                    }
                }
                $fileNames = json_encode($fileNames);
                $car->update([
                    'images' => $fileNames
                ]);

                DB::commit();

                return redirect()->route('car.index')->with('success', 'Car Added Successfully');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('car.create')->with('error', 'There was an Error');
        }
    }

    public function edit(Car $car)
    {

        $categories = Category::pluck("name", "id")->toArray();
        $brands = Brand::pluck("name", "id")->toArray();
        return view('admin.car.edit', compact('car', 'categories', 'brands'));
    }

    public function update(Car $car, UpdateCarRequest $request)
    {
        DB::beginTransaction();

        try {
            $car->update([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'model' => $request->model,
                'year' => $request->year,
                'price_per_day' => $request->price_per_day,
                'plate_number' => $request->plate_number,
                'description' => $request->description
            ]);

            DB::commit();
            return redirect()->route('car.index')->with('success', 'Car Details Successfully Updated');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('car.edit', $car)->with('error', $th->getMessage());
        }
    }

    public function filterCarDataTable(Request $request)
    {

        $cars = Car::query();

        if (isset($request->id)) {
            $cars = $cars->where('category_id', $request->id);
        }

        $cars = $cars->with(['category', 'brand'])->get();

        return response()->json(['data' => $cars]);
    }

    public function toggleCarAvailability($id)
    {
        $car = Car::findOrFail($id);

        $car->update([
            'is_available' => !$car->is_available
        ]);

        return response()->json(status: 200);

    }
}
