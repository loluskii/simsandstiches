


<div class="modal fade" id="edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.category.edit', $category->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Name:</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control"
                                id="recipient-name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" c lass="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
