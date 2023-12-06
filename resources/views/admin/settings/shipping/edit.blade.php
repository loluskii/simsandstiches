<a data-toggle="modal" data-target="#edit-{{ $value->id }}" class="btn btn-sm btn-primary"> <i
        data-feather="edit"></i> </a>


<a href="{{ route('admin.settings.shipping.delete', $value->id) }}"
    onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger"> <i
        data-feather="trash-2"></i> </a>


<div class="modal fade" id="edit-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.settings.shipping.edit', $value->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Name:</label>
                            <input type="text" name="name" value="{{ $value->name }}" class="form-control"
                                id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Locations:</label>
                            <textarea class="form-control" name="group_locations" id=""
                                rows="3">{{ $value->group_locations }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Price:</label>
                            <input type="number" name="price" value="{{ $value->price }}" class="form-control"
                                id="recipient-name">
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
