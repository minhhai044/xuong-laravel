<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoteCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Customer::latest('id')->paginate();
        return view('customers.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoteCustomerRequest $stoteCustomerRequest)

    {
        // dd($stoteCustomerRequest->all());
        try {
            DB::transaction(function () use ($stoteCustomerRequest) {
                $customers = $stoteCustomerRequest->all();
                if ($stoteCustomerRequest->hasFile('avatar')) {
                    $customers['avatar'] = Storage::put('customers', $stoteCustomerRequest->file('avatar'));
                }
                Customer::query()->create($customers);
            });
            return redirect()->route('customers.index')->with('success', 'Thao tác thành công !!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $updateCustomerRequest, Customer $customer)
    {
        try {
            DB::transaction(function () use ($customer, $updateCustomerRequest) {
                $data = [
                    'name' => $updateCustomerRequest->name,
                    'address' => $updateCustomerRequest->address,
                    'phone' => $updateCustomerRequest->phone,
                    'email' => $updateCustomerRequest->email,
                    'is_active' => $updateCustomerRequest->is_active

                ];
                $data['is_active'] ?? $data['is_active'] = 0;

                if ($updateCustomerRequest->hasFile('avatar')) {
                    $data['avatar'] = Storage::put('customers', $updateCustomerRequest->file('avatar'));
                }

                Customer::query()->where('id', $customer->id)->update($data);
                if ($updateCustomerRequest->hasFile('avatar') && Storage::exists($customer->avatar)) {
                    Storage::delete($customer->avatar);
                }
            });
            return back()->with('success', 'Thao tác thành công !!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Xóa thành công!!');
    }

    public function forceDestroy(Customer $customer)
    {
        try {
            DB::transaction(function () use ($customer) {
                $customer->forceDelete();
                if ($customer->avatar && Storage::exists($customer->avatar)) {
                    Storage::delete($customer->avatar);
                }
            });
            return redirect()->route('customers.index')->with('success', 'Xóa thành công!!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
