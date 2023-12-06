<div class="modal fade" id="newShippingGroup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Shipping Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.settings.shipping.add') }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Name:</label>
                            <input type="text" name="group_name" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Locations:</label>
                            <textarea class="form-control" name="group_locations" id="" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Price:</label>
                            <input type="number" name="price" class="form-control" id="recipient-name">
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
