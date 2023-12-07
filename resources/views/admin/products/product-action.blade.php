<a data-bs-toggle="modal" data-bs-target="#editProduct-{{ $product->id }}" class="btn btn-sm btn-primary"> <i
        data-feather="edit"></i> </a>


<a href="{{ route('admin.products.delete', $product->id) }}"
    onclick="return confirm('Are you sure you want to update this product?')"
    class="btn btn-sm btn-{{ $product->status == 0 ? 'success':'danger' }}"> <i
        data-feather="{{ $product->status ? 'toggle-right':'toggle-left' }}"></i> </a>


<div class="modal fade" id="editProduct-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{ $product->name }}</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-fa-times"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                    value="{{ $product->name }}" required aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control" value="{{ $product->price }}"
                                    required aria-describedby="helpId">
                            </div>
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select class="form-control" name="category_id">
                            <option value=""></option>
                            @foreach ($category as $item)
                            <option value="">Select...</option>
                            <option {{$product->category_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{
                                $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="description" name="description" id=""
                            rows="4">{{ $product->description }}</textarea>
                    </div>

                    <div class="attributes mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="" class="form-label">Attributes</label>
                            <button id='' type="button" class="product_action_add_attributes btn btn-info btn-sm">Add
                                Attributes</button>
                        </div>
                        <div class="product_action_dynamic_field_attributes">
			    <input type="hidden" name="no_of_attributes" value="{{ count($product->attributes) }}" />
                            @foreach ($product->attributes as $key => $value)
                            <div class="attribute_row_{{ $key }}">
                                <div class="input-group mb-2" id="attribute_input_group_{{ $key }}">
                                    <button type="button" class="btn btn-danger btn-sm attribute_btn_remove">-</button>

                                    <input type="text" name="attributes[{{ $key }}][attribute_name]"
                                        class="form-control" placeholder="Name" value="{{ $value->attribute_name }}">
                                    <input type="text" name="attributes[{{ $key }}][value]" value="{{ $value->value }}"
                                        class="form-control" placeholder="Value">
                                    <input type="text" name="attributes[{{ $key }}][extra_cost]"
                                        class="form-control extra-cost-input" placeholder="Extra Cost"
                                        value="{{ $value->cost }}" style="{{ $value->cost > 0 ? '' : 'display:none' }}">

                                </div>
                                <label
                                    class="form-check has_extra_cost_{{ $key }} d-flex align-items-center justify-content-end mb-2">
                                    <input class="form-check-input me-1" name="attributes[{{ $key }}][has_extra_cost]"
                                        type="checkbox" id="has_extra_cost_${i}" {{ $value->cost > 0 ? 'checked' : ''
                                    }}>
                                    <span class="form-check-label small">
                                        Has Extra Cost
                                    </span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="product_action_image_urls mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="" class="form-label">Image URLs</label>
                            <button id='' type="button" class="btn product_action_add_image_urls btn-info btn-sm">Add
                                URL</button>
                        </div>
                        <div class="product_action_dynamic_field_image_urls">
			    <input type="hidden" name="no_of_images" value="{{ count($product->images) }}" />
                            @foreach ($product->images as $key => $value)
                            <div class="input-group mb-2" id="image_urls_row">
                                <button type="button" class="btn btn-danger btn-sm image_urls_btn_remove">-</button>
                                <input type="text" name="image_urls[{{ $key }}]" class="form-control" placeholder="Name"
                                    value="{{ $value->url }}">
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
