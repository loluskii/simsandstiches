<div class="modal fade" id="createProduct" tabindex="-1" style="display: none" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="" class="form-label">Attributes</label>
                            <button id='add_attributes' type="button" class="btn btn-secondary btn-sm">Add Attributes</button>
                        </div>
                        <div id="dynamic_field_attributes"></div>
                    </div>

                    <div class="image_urls mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="" class="form-label">Image URLs</label>
                            <button id='add_image_urls' type="button" class="btn btn-secondary btn-sm">Add URL</button>
                        </div>
                        <div id="dynamic_field_image_urls">
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
</div>
