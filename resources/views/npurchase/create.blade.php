@extends('layouts.app')
@section('title', 'Ecommerce Order')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/purchase.css') }}">
<style>
.custom-toast {
    background-color:rgb(64, 155, 113) !important; /* Solid background color (no transparency) */
    color: black !important; /* Black text for visibility */
    box-shadow: none !important; /* Remove any box shadow */
    opacity: 1 !important; /* Full opacity */
}

.custom-toast .toast-title,
.custom-toast .toast-message {
    color: #000 !important; /* Ensure black text for title and message */
    opacity: 1 !important; /* Ensuring text opacity is also solid */
}

.custom-toast .toast-close-button {
    color: #000 !important; /* Black close button */
    opacity: 1 !important; /* Close button should also have full opacity */
}
</style>



@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('common.New Purchase') }}</h4>
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary">{{ translate('common.Back') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="post">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="">{{ translate('common.time') }}</label>
                                <span style="color:rgb(118, 118, 120);">
                                {{ now()->setTimezone('Asia/Dhaka')->format('h:i:s A') }}
                                </span>
                                <br>
                                <input type="date" 
                                       name="purchase_date" 
                                       value="{{ now()->format('Y-m-d') }}" 
                                       class="form-control" 
                                       oninput="validateYear(this)" readonly>
                                <span class="text-danger">
                                    @error('purchase_date')
                                        {{ $message }}
                                    @enderror
                                </span>
                             
                            </div>
                            
                            <div class="col-lg-4">
    <label for="">{{ translate('common.invoice_id') }}</label>
    <input type="text" name="invoice_id" value="{{ old('invoice_id', $newInvoiceNumber) }}"
           class="form-control" readonly>
    <span class="text-danger">
        @error('invoice_id')
            {{ $message }}
        @enderror
    </span>
</div>

                            
                            <div class="col-lg-4">
                                <label for="supplier">{{ translate('common.supplier') }}</label>
                                <font color="red">*</font>
                                <select name="supplier_id" id="supplier" class="form-select" onchange="search()">
                                    <option value="">{{ translate('common.Select One') }}</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('supplier_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            
                            <div class="col-lg-12 my-1">
    <div class="searchfield position-relative">
        <div class="md-form form-sm form-2 pl-0">
            <input onfocus="searchProduct()" onkeyup="search()" class="form-control"
                   id="searchInputField" type="text" value=""
                   placeholder="{{ translate('common.Search by name or generic') }}"
                   aria-label="Search" autocomplete="off">
        </div>
        <div class="search-suggestion-box d-none" id="scrollableDiv">
            <div class="infinite-scroll-component__outerdiv">
                <div class="infinite-scroll-component" id="searchResult">
                    <p class="text-muted text-center">Please select a supplier to view products.</p>
                </div>
            </div>
        </div>
    </div>
</div>
                            
                            <div class="row" id="purchaseTable">
                                @include('npurchase.cart_table')
                            </div>

                            <div class="row justify-content-end mt-3">
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary px-5 d-block w-100">
                                        {{ translate('common.submit') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

<script>
    $(document).ready(function() {
        @if($total_cash_in_hand == 0)
            $('#stockmodal').modal('show');
        @endif
    });
</script>
    <!-- Modal for total_cash_in_hand == 0 -->
    @if($total_cash_in_hand == 0)
        <div id="stockmodal" class="modal fade" role="dialog" aria-modal="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                     <div class="modal-header">
            <h4 class="modal-title w-100 text-center position-relative">
             {{ translate('common.action required') }}
            </h4>
            <button type="button" class="close btn btn-sm btn-light position-absolute" style="top: 10px; right: 10px;" data-bs-dismiss="modal">×</button>
            </div>
                    <div class="modal-body d-flex justify-content-center align-items-center" style="height: 100px;">
                        <p class="text-center">Please fill up the payment method</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                    <input type="hidden" name="is_modal_shown" id="is_modal_shown">
                    <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        $(document).ready(function() {
            $('body').removeClass('menu-expanded');
            $('body').addClass('menu-collapsed')
        });

        function search() {
    var keywords = $('#searchInputField').val();
    var supplier_id = $('#supplier').val(); // Get selected supplier ID

    // Check if supplier is selected
    if (!supplier_id) {
        alert("Please select a supplier first.");
        return; // Stop the function if no supplier is selected
    }

    // Proceed with the AJAX call if a supplier is selected
    $.get({
        url: '{{ route('purchase.get_medicines') }}',
        data: {
            keywords: keywords,
            supplier_id: supplier_id, // Pass supplier ID
        },
        success: function(data) {
            $('#searchResult').empty().html(data.results);
        },
    });
}


        function searchProduct() {
            $('#scrollableDiv').removeClass('d-none');
            $('#scrollableDiv').fadeIn();
        }

        $(document).ready(function() {
            $(document).mouseup(function(e) {
                var container = $(".searchfield");
                var box = $("#scrollableDiv");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    box.fadeOut();
                }
            });
        });


        //  Add to cart
        function addToPurchaseCart(item_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.post({
        url: '{{ route('purchase.add_to_cart') }}',
        data: {
            product_id: item_id
        },
        beforeSend: function() {
            // $('#loading').show();
        },
        success: function(data) {
            toastr.success('Product has been added!', '', {
                closeButton: true,
                progressBar: true,
                timeOut: 500,
                extendedTimeOut: 500,
                toastClass: 'custom-toast' // Apply the custom class
            });
            $('#purchaseTable').empty().html(data.view);
            $('#scrollableDiv').fadeOut();
        },
        complete: function() {
            $('#loading').hide();
        }
    });
}



        function removePurchaseItem(productId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // Get product by id
            $.post({
                url: '{{ route('purchase.remove_from_cart') }}',
                data: {
                    product_id: productId
                },
                success: function(data) {
                    toastr.success('Item has been removed!', '', {
                        CloseButton: true,
                        ProgressBar: true,
                        timeOut: 500,
                        extendedTimeOut: 500,
                        toastClass: 'custom-toast'
                    });
                    $('#purchaseTable').empty().html(data.view);
                    $('#scrollableDiv').fadeOut();
                },
                complete: function() {
                    $('#loading').hide();
                }

            });
        }

        function changeHandler(value, cartId, item) {
            let data = {
                'cart_id': cartId,
                'field': item,
                'value': value,
            }
            updateCartItem(data);
        }

        // Update cart item when change anything in cart
        function updateCartItem(changedData) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // Get product by id
            $.post({
                url: '{{ route('purchase.update_cart') }}',
                data: changedData,
                success: function(data) {
                    toastr.success('Item has been updated!', '', {
                        CloseButton: true,
                        ProgressBar: true,
                        timeOut: 500,
                        extendedTimeOut: 500,
                        toastClass: 'custom-toast'
                    });
                    $('#purchaseTable').empty().html(data.view);
                    $('#scrollableDiv').fadeOut();
                },
                complete: function() {
                    $('#loading').hide();
                }

            });
        }
        function calculateDueAmount() {
    // Get input values
    let inv_discount_amount = $('#invoiceDiscountAmount').val() || 0;
    let inv_discount_type = $('#invoiceDiscountType').val();
    let subTotal = $('#subTotal').val() || 0;
    let medicinediscount = $('#medicinediscount').val() || 0;

    // Calculate the actual amount after medicine discount
    let actual_amount = parseFloat(subTotal) - parseFloat(medicinediscount);

    // Calculate the invoice discount
    let discount_amount = 0;
    if (inv_discount_type === 'percent') {
        discount_amount = (parseFloat(inv_discount_amount) / 100) * actual_amount;
    } else if (inv_discount_type === 'fixed') {
        discount_amount = parseFloat(inv_discount_amount);
    }

    // Ensure discount does not exceed actual amount
    if (discount_amount > actual_amount) {
        discount_amount = actual_amount;
    }

    // Calculate total amount after discounts
    let total_amount = actual_amount - discount_amount;

    // Update total amount in the form
    $('#totalAmountText').text(total_amount.toFixed(2));
    $('#totalAmount').val(total_amount.toFixed(2));

    // Update hidden invoice discount input
    $('#invoiceDiscountAmountInput').val(discount_amount.toFixed(2));

    // Calculate due amount after paid amount
    let paid_amount = $('#paidAmount').val() || 0;
    let due_amount = Math.max(total_amount - parseFloat(paid_amount), 0);

    // Update due amount in the form
    $('#dueAmount').val(Math.ceil(due_amount));
    $('#paidAmountInput').val(parseFloat(paid_amount).toFixed(2));
}





        function validateYear(input) {
    const value = input.value; // Get the input value
    const yearPart = value.split('-')[0]; // Extract the year part

    if (yearPart.length > 4 || isNaN(yearPart)) {
        input.value = ''; // Clear the input if invalid
        alert('Please enter a valid  year.');
    }
}

    </script>
@endsection
