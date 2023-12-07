@extends('admin.layout.app')

@section('styles')
<style>
    li.nav-item>button.nav-link.active {
        font-weight: bold;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid #3b7ddd
    }

    button.nav-link:not(.active) {
        color: #333
    }

    .nav-tabs .nav-link:focus,
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        isolation: isolate;
    }
</style>
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Products</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $products->count() }}</h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Categories</h5>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ $category->count() }}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs border-0" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
            role="tab" aria-controls="home" aria-selected="true">Products</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
            role="tab" aria-controls="profile" aria-selected="false">Categories</button>
    </li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active mt-3" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between header mb-3">
                    <h2></h2>
                    <button data-bs-toggle="modal" data-bs-target="#createProduct" class="btn btn-secondary btn-sm">New
                        Product</button>
                    @include('admin.products.create-product')
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Image Count</th>
                                <th>Category</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)
                            @foreach ($products as $key => $product)
                            <tr>
                                <td class="text-uppercase">{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->images()->count() }}</td>
                                <td>{{ $product->category->name ?? 'No Category' }}</td>
                                <td>0</td>
                                <td><span class="badge bg-{{ $product->status ? 'success':'danger' }}">{{
                                        $product->status ? 'Active':'Disabled' }}</span></td>
                                <td>
                                    @include('admin.products.product-action')
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="text-center">
                                <td colspan="7">No Products</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane mt-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between header mb-3">
                    <h2></h2>
                    <button data-bs-toggle="modal" data-bs-target="#newCategory" class="btn btn-secondary btn-sm">New
                        Category</button>
                    @include('admin.products.create-category')
                </div>
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>No. of Products</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $category)

                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products()->count() }}</td>
                                <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#edit-{{ $category->id }}"
                                        class="btn btn-sm btn-primary"> <i data-feather="edit"></i>
                                    </a>
                                    <a href="{{ route('admin.category.delete', $category->id) }}"
                                        onclick="return confirm('Are you sure you want to delete this record?')"
                                        class="btn btn-sm btn-danger"> <i data-feather="trash-2"></i> </a>
                                    @include('admin.products.category-action')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var i=0;
    var j=0;

    $('#add_attributes').click(function(){
		i++;
		$('#dynamic_field_attributes').append(`
            <div class="attribute_row_${i}">
                <div class="input-group" id="attribute_input_group_${i}">
                    <button type="button" name="add" id="${i}" class="btn btn-danger attribute_btn_remove btn-sm">-</button>
                    <input type="text" name="attributes[${i}][attribute_name]" class="form-control" placeholder="Name">
                    <input type="text" name="attributes[${i}][value]" class="form-control" placeholder="Value">
                </div>
                <label class="form-check has_extra_cost_${i} d-flex align-items-center justify-content-end mb-2">
                    <input class="form-check-input me-1" name="attributes[${i}][has_extra_cost]" type="checkbox" id="has_extra_cost_${i}">
                    <span class="form-check-label small">
                        Has Extra Cost
                    </span>
                </label>
            </div>
            `)
	});
    $('#add_image_urls').click(function(){
		j++;
		$('#dynamic_field_image_urls').append(`
        <div class="input-group mb-2" id="image_urls_row">
            <button type="button" name="add" id="${i}" class="btn btn-danger image_urls_btn_remove btn-sm">-</button>
            <input type="text" name="image_urls[${i}]" class="form-control" placeholder="Image URL">
        </div>`)
	});

    let count_attributes = $('input[name=no_of_attributes]').val();
    $('.product_action_add_attributes').click(function(){
        count_attributes++;
        $('.product_action_dynamic_field_attributes').append(`
            <div class="attribute_row">
                <div class="input-group mb-2" id="attribute_row_${count_attributes}">
                    <button type="button" name="add" id="${count_attributes}" class="btn btn-danger attribute_btn_remove btn-sm">-</button>
                    <input type="text" name="attributes[${count_attributes}][attribute_name]" class="form-control" placeholder="Name">
                    <input type="text" name="attributes[${count_attributes}][value]" class="form-control" placeholder="Value">
                </div>
                <label class="form-check product_action_has_extra_cost_${count_attributes} d-flex align-items-center justify-content-end mb-2">
                    <input class="form-check-input me-1" name="attributes[${count_attributes}][has_extra_cost]" type="checkbox" id="has_extra_cost_${i}">
                    <span class="form-check-label small">
                        Has Extra Cost
                    </span>
                </label>
            </div>
        `)
    });

    let count = $('input[name=no_of_images]').val();
    $('.product_action_add_image_urls').click(function(){
        count++;
        $('.product_action_dynamic_field_image_urls').append(`
        <div class="input-group mb-2" id="image_urls_row">
            <button type="button" name="add" id="${count}" class="btn btn-danger image_urls_btn_remove btn-sm">-</button>
            <input type="text" name="image_urls[${count}]" class="form-control" placeholder="Image URL">
        </div>`)
    });


    $(document).on('change', 'input[name^="attributes["][name$="[has_extra_cost]"]', function () {
        let index = $(this).attr('name').match(/\[(\d+)\]\[has_extra_cost\]/)[1];
        console.log(index)
        let extraCostInput = '<input type="number" name="attributes[' + index + '][extra_cost]" class="form-control" placeholder="Extra Cost">';

        // Remove existing extra cost input in the same row
        $(`#attribute_input_group_${index} input[name*='extra_cost']`).remove();

        // Append or remove the extra cost input based on the checkbox state
        if ($(this).is(':checked')) {
            $(`#attribute_input_group_${index}`).append(extraCostInput);
        }
    });

    $(document).on('click', '.attribute_btn_remove', function(){
        $(this).parents('div.attribute_row').remove();
    });
    $(document).on('click', '.image_urls_btn_remove', function(){
        $(this).parents('div#image_urls_row').remove();
    });

</script>
@endsection
