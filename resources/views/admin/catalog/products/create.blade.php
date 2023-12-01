<div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new product</h5>
                <a type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
            </div>
            <form method="POST" action="{{ route('admin.products.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" required aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" required
                                    aria-describedby="helpId">
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select class="form-control" name="category_id">
                            <option value="">Select...</option>
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="description" name="description" id=""
                            rows="3"></textarea>
                    </div>

                    <div class="attributes mb-3">
                        <label for="" class="form-label">Attributes</label>
                        <div id="dynamic_field_attributes">
                            <div class="input-group mb-2" id="attribute_row">
                                <input type="text" name="attributes[0][attribute_name]" class="form-control"
                                    placeholder="Name">
                                <input type="text" name="attributes[0][value]" class="form-control" placeholder="Value">
                                <div class="input-group-prepend">
                                    <button type="button" name="add" id="add_attributes" class="btn btn-success btn-sm"><i
                                            class="fa fa-plus-square text-white"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="image_urls mb-3">
                        <label for="" class="form-label">Image URLs</label>
                        <div id="dynamic_field_image_urls">
                            <div class="input-group mb-2" id="image_urls_row">
                                <input type="text" name="image_urls[0]" class="form-control" placeholder="Image URL">
                                <div class="input-group-prepend">
                                    <button type="button" name="add" id="add_image_urls" class="btn btn-success btn-sm"><i
                                            class="fa fa-plus-square text-white"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
