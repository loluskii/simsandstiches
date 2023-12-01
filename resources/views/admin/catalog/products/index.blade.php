@extends('admin.layout.app')

@section('title')
Products List
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $products->count() }} <i class=" icon-briefcase float-right"></i></h3>
                <span>Total Products</span>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between header">
                <h2>All Products</h2>
                <button data-toggle="modal" data-target="#createProduct" class="btn btn-secondary btn-sm">New
                    Product</button>
                @include('admin.catalog.products.create')
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)
                            @foreach ($products as $key => $product)

                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-uppercase">{{ $product->name }}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->category->name ?? 'No Category' }}</td>
                                <td>
                                    @include('admin.catalog.products.product-action')
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="text-center">
                                <td colspan="5">No Products</td>
                            </tr>
                            @endif
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
    var i=1;
    var j=1;
    $('#add_attributes').click(function(){
		i++;
		// $('#dynamic_field').append('<tr><td class="pl-0"><input type="text" name="attributes['+i+'][attribute_name]" placeholder="Enter attribute name" class="form-control name_list" /></td> <td><input type="text" name="attributes['+i+'][value]" placeholder="Enter value" class="form-control name_list" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm"><i class="fa fa-minus"></i></button></td> </tr>');
		$('#dynamic_field_attributes').append(`
			<div class="input-group mb-2" id="attribute_row">
				<input type="text" name="attributes[${i}][attribute_name]" class="form-control" placeholder="Name">
				<input type="text" name="attributes[${i}][value]" class="form-control" placeholder="Value">
				<div class="input-group-prepend">
						<button type="button" name="add" id="${i}" class="btn btn-danger attribute_btn_remove btn-sm"><i class="fa fa-minus text-white"></i></button>
				</div>
			</div>`)
	});

    $('#add_image_urls').click(function(){
		j++;
		$('#dynamic_field_image_urls').append(`
        <div class="input-group mb-2" id="image_urls_row">
            <input type="text" name="image_urls[${i}]" class="form-control" placeholder="Image URL">
            <div class="input-group-prepend">
                <button type="button" name="add" id="${i}" class="btn btn-danger image_urls_btn_remove btn-sm"><i class="fa fa-minus text-white"></i></button>
            </div>
        </div>`)
	});

    $(document).on('click', '.attribute_btn_remove', function(){
        $(this).parents('div#attribute_row').remove();
    });
    $(document).on('click', '.image_urls_btn_remove', function(){
        $(this).parents('div#image_urls_row').remove();
    });

</script>
@endsection
