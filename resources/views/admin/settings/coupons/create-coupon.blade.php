<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="createCoupon" tabindex="-1" data-bs-backdrop="static" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.settings.coupon.add') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Code</label>
                        <input type="text" class="form-control" maxlength="10" name="code" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Type</label>
                        <select class="form-select form-select" name="type" id="">
                            <option selected>Select one</option>
                            <option value="percent">Percent</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Maximum Usage</label>
                        <input type="text" class="form-control" name="max_usage" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Discount Value</label>
                        <input type="text" class="form-control" name="value" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>
                    <div class="modal-footer px-0">
                        <button type="button" class="btn btn-dark rounded-1" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success rounded-1">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
