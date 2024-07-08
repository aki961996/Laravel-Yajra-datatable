<div class="modal fade categoriesModal" id="categoriesModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form id="categoriesAdd">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- This side will come form group --}}

                    <input type="hidden" id="category_id" name="category_id" />

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="categoryName" class="form-control" />
                        <span id="nameError" class="text-danger error-messages"></span>
                    </div>


                    <div class="form-group mb-1">
                        <label for="" class="form-label">Type</label>
                        <select name="type" id="categoryType" class="form-control">
                            <option disabled selected>Choose option</option>
                            <option value="electronic">Electronic</option>


                        </select>

                        <span id="typeError" class="text-danger error-messages"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeBtn"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBtn"></button>
                </div>
            </div>
        </div>
    </form>
</div>