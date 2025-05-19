@forelse($search_products as $product)
    <a href="javascript:" onclick="addToPurchaseCart('{{ $product->id }}')" class="single-sch-item-area nav-link">
        <div class="search-content">
            <span class="schItem schresultItemImage">
                @if (isset($product->image))
                    <img class="img-fluid" src="{{ asset('storage/images/medicine/' . $product->image) }}" alt="">
                @else
                    <img class="img-fluid" src="{{ asset('images\employee\pngtree-medical-drug-cartoon-illustration-png-image_4544247.jpg') }}" alt="">
                @endif
            </span>
            <span class="schItem schresultItemDescription" title="{{ $product->name }}">
            {{ translate('common.name') }}:{{ $product->name }}
                <!-- <span class="sku" title="Tablet">{{ $product->strength }}</span>
                <span class="gener-name text-muted">{{ translate('common.Generic name') }}:{{ $product->generic_name }}</span> -->
                <br>
                <span class="schItem schresultItemDescription">{{ translate('common.supplier') }}: {{ $product->supplier ? $product->supplier->name : '' }}</span>
                <br>
                <span class="schItem schresultItemDescription">{{ translate('common.product type') }}: {{ $product->product_type }}</span>
                <br>
                <span class="schItem schresultItemDescription">{{ translate('common.type') }}:
                    {{ $product->type->name }}</span>
                <br>
                <span class="schItem schresultItemDescription">{{ translate('common.strength') }}:
                    {{ $product->strength }}</span>
            </span>
        </div>
        <span class="search-price">
            {{ priceFormat($product->price) }}
        </span>
    </a>
@empty
    <div class="text-center p-5 ">
        <h6 class="text-muted">{{ translate('common.Sorry! We couldn\'t find your Medicine') }}.</h6>
    </div>
@endforelse

