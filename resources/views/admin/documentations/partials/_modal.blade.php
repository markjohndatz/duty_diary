<!-- Modal -->

<div class="modal fade" id="newDocumentation" tabindex="-1" aria-labelledby="newDocumentation" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Photos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('documentations.store') }}" method="POST" id="documentation-upload-form" enctype="multipart/form-data">
           @csrf
            <div class="modal-body">
                <input type="file" name="doc_img" id="doc_img" class="dropify" data-show-error="true" data-height="250" data-max-file-size="2M">
                <input type="text" name="caption" id="caption" class="form-control mt-2"  placeholder="Write your caption here">
            </div>
            <div class="modal-footer">
              <button type="button"  class="btn btn-secondary btn-sm"  data-bs-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary btn-sm" id="submit-doc-form" value="Save">
            </div>
        </form>
      </div>
    </div>
  </div> 

