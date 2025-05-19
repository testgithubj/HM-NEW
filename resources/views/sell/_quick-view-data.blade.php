<div class="modal-header p-2">
    <h4 class="modal-title product-title">
    </h4>
    <button class="close call-when-done" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="">
        
        <!-- Product details-->
        <div class="details pvl43">
            <a href="#" class="h1 mb-2 product-title pvl44">{{ Str::limit($product->name, 26) }}</a>

            <div class="mb-3 text-dark">
                <span class="h3 font-weight-normal text-accent mr-1">
                  Strength: {{ Str::limit($product->strength, 26) }}
                </span>
            </div>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-12">
            <?php
            $cart = false;
            if (session()->has('cart')) {
                foreach (session()->get('cart') as $key => $cartItem) {
                    if (is_array($cartItem) && $cartItem['id'] == $product['id']) {
                        $cart = $cartItem;
                    }
                }
            }
            $batch = \App\Models\Batch::where('medicine_id', $product->id)->first();
            $vendors = \App\Models\Vendor::where('shop_id', Auth::user()->shop_id)->orWhere('global', 1)->get();
            ?>
            
            <form id="add-to-cart-form" class="mb-2">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-3">
            
                </div>
                <input type="hidden" name="medicine_id" value="{{ $product->id }}">
                @if(Auth::user()->shop_id != 79)
                    <div class="select-option">
                        <div class="h3 p-0"> {{trans('Batch Name')}}
                        </div>
    
                        <div class="d-flex justify-content-left flex-wrap pvl49">
                            <input class="form-control" name="batch_no" id="select" placeholder="Batch Name">
                           
                        </div>
                    </div>
                @else
                
                     <input type="hidden" name="batch_no" value="{{random_int(100000, 999999)}}">
                @endif
                   
                    @if(Auth::user()->shop_id != 79)
                    <div class="select-option">
                        <div class="h3 p-0"> {{trans('Expire Date')}}
                        </div>
    
                        <div class="d-flex justify-content-left flex-wrap pvl49">
                            <input class="form-control" name="expiry_date" id="select" placeholder="Expire Date" type="date">
                           
                        </div>
                    </div>
                    @else
                    
                    <input type="hidden" name="expiry_date" value="2030-01-01">
                    @endif
                    
                    
                    
                    <div class="select-option">
                        <div class="h3 p-0"> {{trans('MRP Per Unit')}}
                        </div>
    
                        <div class="d-flex justify-content-left flex-wrap pvl49">
                            <input class="form-control" type="number" step="0.01" name="mrp" id="select" placeholder="MRP" @if($batch != null) value="{{number_format($batch->price, 2)}}" @endif>
                           
                        </div>
                    </div>
                     <input type="hidden" name="leaf_id" value="29">
                    
                    
                    <div class="select-option">
                        <div class="h3 p-0"> {{trans('Buy Price Per Unit')}}
                        </div>
    
                        <div class="d-flex justify-content-left flex-wrap pvl49">
                            <input class="form-control" type="number" step="0.01" name="bprice" id="select" placeholder="Buy Price">
                           
                        </div>
                    </div>
                    <div class="mb-1">
                     <div class="h3 p-0">Vendor </div>
                      <select class="select2 form-select form-control" id="select2-basic" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true" name="vendor_id">
                          <option value="">Select Vendor</option>
                          @foreach($vendors as $vendor)
                              <option value="{{$vendor->id}}" @if($product->vendor_id == $vendor->id) selected @endif>{{$vendor->name}} </option>
                          @endforeach
                      </select>

                  </div>
            <!-- Quantity + Add to cart -->
                <div class="d-flex justify-content-end mt-5">
                    <div class="product-description-label mt-2 text-dark h3">{{__('Quantity')}}:</div>
                    <div class="product-quantity d-flex align-items-center">
                        <div class="input-group input-group--style-2 pr-3 pvl48">
                            <span class="input-group-btn">
                                <button class="btn btn-number text-dark pvl47" type="button"
                                        data-type="minus" data-field="quantity"
                                        disabled="disabled">
                                        <i class="tio-remove  font-weight-bold"></i>
                                </button>
                            </span>
                            <input type="text" name="quantity"
                                   class="form-control input-number text-center cart-qty-field"
                                   placeholder="1" value="1" min="1" max="999999999999999">
                            <span class="input-group-btn">
                                <button class="btn btn-number text-dark pvl46" type="button" data-type="plus"
                                        data-field="quantity">
                                        <i class="tio-add  font-weight-bold"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="row no-gutters mt-2 text-dark" id="chosen_price_div">
                    <div class="col-10">
                        <div class="product-price">
                            <strong id="chosen_price"></strong>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-2">
                    <button class="btn btn-primary pvl45"
                            onclick="addToCart()"
                            type="button">
                        <i class="tio-shopping-cart"></i>
                        {{trans('pages.add_to_cart')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    cartQuantityInitialize();
   
</script>
<script>
    $(document).on('ready', function () {
        console.log($product->id);
    });
</script>
<script>
    function color_change(val)
    {
        console.log(val.id);
        $('.color-border').removeClass("border-add");
        $('#label-'+val.id).addClass("border-add");
    }
</script>

