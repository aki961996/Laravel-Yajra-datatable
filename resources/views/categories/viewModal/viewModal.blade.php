<!-- Modal -->
<div class="modal fade categoriesViewModal " id="viewCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="table_hide">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="viewCategoryId"></td>
                            <td id="viewCategoryName"></td>
                            <td id="viewCategoryType"></td>

                        </tr>

                        <div id="rowContainer">
                            <!-- New rows will be appended here -->
                        </div>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" id="nextBtn">onlyTrashed</button>

            </div>
        </div>
    </div>
</div>