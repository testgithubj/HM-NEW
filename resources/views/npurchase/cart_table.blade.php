
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/purchase.css') }}">
<style>
    .custom-toasts {
        background-color: rgb(185, 40, 40) !important; /* Solid background color */
        color: black !important; /* Black text for visibility */
        box-shadow: none !important; /* Remove box shadow */
        opacity: 1 !important; /* Full opacity */
    }

    .custom-toast .toast-title,
    .custom-toast .toast-message {
        color: #000 !important; /* Black text for title and message */
        opacity: 1 !important; /* Ensuring text opacity is also solid */
    }

    .custom-toast .toast-close-button {
        color: #000 !important; /* Black close button */
        opacity: 1 !important; /* Close button with full opacity */
    }
</style>

@php
    $subtotal = 0;
    $total_discount = 0;
    $total_quantity = 0;
@endphp

<div class="table-responsive">
    <table class="table purchase-product-table table-striped mb-2">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ translate('common.medicine') }}</th>
                <th>{{ translate('common.Expire Date') }}</th>
                <th>{{ translate('common.MRP Per Unit') }}</th>
                <th>{{ translate('common.Buy Price Per Unit') }}</th>
                <th>{{ translate('common.Quantity') }}</th>
                <th>{{ translate('common.Subtotal') }}</th>
                <th>{{ translate('common.Discount') }}</th>
                <th>{{ translate('common.Total') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchase_cart as $key => $cart)
                <tr>
              

                    <td>{{ $loop->iteration }}</td>
                    <td class="d-flex gap-1 align-items-center">
                        @if (!empty($cart['image']))
                            <img src="{{ asset('storage/images/medicine/' . $cart['image']) }}" height="35" width="35"
                                alt="">
                        @else
                            <img src="{{ asset('images\employee\pngtree-medical-drug-cartoon-illustration-png-image_4544247.jpg') }}" height="35" width="35"
                                alt="">
                        @endif
                        <strong>{{ $cart['name'] }}</strong>
                    </td>
                  
    <input type="hidden"  class="text-uppercase" type="text"
        onchange="changeHandler(this.value,'{{ $key }}','batch_name')"
        value="1">

                    <td>
                        <input required onchange="changeHandler(this.value,'{{ $key }}','expire_date')"
                            style="width: 135px;" type="date" value="{{ $cart['expire_date'] }}">
                    </td>
                    <td>
                        <input required step="any"
                            onchange="changeHandler(this.value,'{{ $key }}','price')" type="number"
                            value="{{ $cart['price'] }}">
                    </td>
                    <td>
                        <input required step="any"
                            onchange="changeHandler(this.value,'{{ $key }}','buy_price')" type="number"
                            value="{{ $cart['buy_price'] }}">
                    </td>
                    <td>
                        <input required onchange="changeHandler(this.value,'{{ $key }}','quantity')"
                            type="number" value="{{ $cart['quantity'] }}">
                    </td>
                    <td>
                        {{ number_format($cart['buy_price'] * $cart['quantity'], 2) }}
                    </td>
                    <td>
                        <input onchange="changeHandler(this.value,'{{ $key }}','discount')" type="number"
                            value="{{ $cart['discount'] }}">
                        <select onchange="changeHandler(this.value,'{{ $key }}','discount_value_type')">
                            <option value="percent" @if ($cart['discount_value_type'] == 'percent') selected @endif>%
                            </option>
                            <option value="fixed" @if ($cart['discount_value_type'] == 'fixed') selected @endif>Fixed
                            </option>
                        </select>
                    </td>
                    <td>
    @php
        // Initialize the NPurchaseController to access the calculateCharge method
        $calculation = new \App\Http\Controllers\NPurchaseController();

        // Calculate the discount amount based on the cart's discount details
        $discount_amount = $calculation->calculateCharge(
            $cart['discount'], // Discount value
            $cart['buy_price'] * $cart['quantity'], // Total amount (price x quantity)
            $cart['discount_value_type'] // Discount type ('percent' or 'fixed')
        );

        // Calculate the final total after applying the discount
        $final_total = ($cart['buy_price'] * $cart['quantity']) - $discount_amount;
    @endphp

    <!-- Display the final total, formatted to 2 decimal places -->
    {{ number_format($final_total, 2) }}
</td>

                    <td>
                        <a href="javascript:" onclick="removePurchaseItem('{{ $key }}')"
                            class="text-danger"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @php
                    $total_discount += $discount_amount;
                    $subtotal += $cart['buy_price'] * $cart['quantity'];
                    $total_quantity += $cart['quantity'];
                @endphp
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <h5 class="font-weight-bold py-2">{{ translate('common.Purchase cart empty') }}</h5>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="row justify-content-end">
    <div class="col-lg-4">
        <div class="float-end">
            <table class="table estimate-acount-table text-right">
                <tr>
                    <th>{{ translate('common.Subtotal') }}</th>
                    <td>:</td>
                    <td>{{ number_format($subtotal, 2) }}</td>
                    <input type="hidden" id="subTotal" name="sub_total" value="{{ $subtotal }}">
                </tr>
                <tr>
    <th>Medicines Discount</th>
    <td>:</td>
    <td>
        {{ number_format($total_discount, 2) }}
    </td>
    <input type="hidden" id="medicinediscount" name="medicine_discount" value="{{ $total_discount }}">
</tr>
<tr>
    <th>Invoice Discount</th>
    <td>:</td>
    <td>
        <input 
            onchange="calculateDueAmount()" 
            id="invoiceDiscountAmount" 
            type="number" 
            value="0"
        >
        <select 
            onchange="calculateDueAmount()" 
            id="invoiceDiscountType"
        >
            <option value="percent">%</option>
            <option value="fixed">Fixed</option>
        </select>
        <input 
            type="hidden" 
            id="invoiceDiscountAmountInput" 
            name="invoice_discount_amount" 
            value="0"
        >
    </td>
</tr>
                <tr>
                    <th>{{ translate('common.Total') }}</th>
                    <td>:</td>
                    <td><span id="totalAmountText">{{ number_format($subtotal - $total_discount, 2) }}</span></td>
                    <input type="hidden" id="totalAmount" name="total" value="{{ $subtotal - $total_discount }}">
                </tr>
                <tr>
                
    <th>
    <font color="red">*</font>{{ translate('common.Paid Amount') }}</th>
    <td>:</td>
    <td>
    
        <input onchange="calculateDueAmount()" id="paidAmount" type="number" name="paid" required>
    </td>
</tr>
<input type="hidden" id="paidAmountInput" name="paidAmount">

                <tr>
                    <th>{{ translate('common.Due Amount') }}</th>
                    <td>:</td>
                    <td>
                        <input id="dueAmount" type="number" name="due_amount" value="0">
                    </td>
                </tr>
                <tr>
                    <th> 
                    <font color="red">*</font>
                        {{ translate('common.Payment Method') }}</th>
                    <td>:</td>
                    <td>
                        @php
                            $payment_methods = \App\Models\Method::select('id', 'name')->get();
                        @endphp
                        <select style="width: 100%;" name="payment_method_id" required>
                            <option value="">{{ translate('common.Select One') }}</option>
                            @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}"
                                    {{ old('payment_method_id') == $payment_method->id ? 'selected' : '' }}>
                                    {{ $payment_method->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('payment_method_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </td>
                    <input type="hidden" name="total_quantity" value="{{ $total_quantity }}">
                </tr>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.css">
<script>
    @if(Session::has('toast_message'))
        toastr.options = {
            progressBar: true,
            positionClass: 'toast-top-right',
            closeButton: true,
            extendedTimeOut: 1000,
            timeOut: 1000,
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
            toastClass: 'custom-toasts' // Add the custom class
        };
        toastr.error('{{ Session::get('toast_message') }}');
    @endif
</script>



