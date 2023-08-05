<!-- Modal -->

<div class="modal fade" id="newDocumentation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Photos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="file" name="doc_img" id="doc_img" class="dropify" data-height="250" data-max-file-size="2M">
            <input type="text" name="caption" class="form-control mt-2" id="caption" placeholder="Write your caption here">
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary btn-sm"  data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-sm" id="saveDocument">Save</button>
        </div>
      </div>
    </div>
  </div> 