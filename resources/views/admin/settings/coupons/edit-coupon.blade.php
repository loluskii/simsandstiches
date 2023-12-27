<div class="modal fade" id="editCoupon{{ $coupon->id }}" tabindex="-1" data-bs-backdrop="static" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.settings.coupon.edit', $coupon->id ) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Code</label>
                        <input type="text" class="form-control" value="{{ $coupon->name }}" name="code" id=""
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Type</label>
                        <select class="form-select form-select" name="type" id="">
                            <option>Select one</option>
                            <option {{ $coupon->type == 'percent' ? 'selected' :'' }} value="percent">Percent</option>
                            <option {{ $coupon->type == 'fixed' ? 'selected' :'' }} value="fixed">Fixed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Value</label>
                        <input type="text" class="form-control" value="{{ $coupon->value }}" name="value" id=""
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Start Date</label>
                        <input type="date" class="form-control" value="{{ $coupon->starts_at }}" name="start_date" id=""
                            aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">End Date</label>
                        <input type="date" class="form-control" value="{{ $coupon->ends_at }}" name="end_date" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="modal-footer px-0">
                        <button type="button" class="btn btn-dark rounded-1" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success rounded-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
