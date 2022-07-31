<div class="modal fade" id="retrievePatientModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this Patient account?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Patient Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_patient">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="retrieveProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this Product?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Product is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_product">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveServiceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this Service?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Service is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_service">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveDoctorModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this Doctor?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Doctor Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_doctor">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveSecretaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this Secretary?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Secretary Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_secretary">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="retrieveStaffModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this Staff?</p>
        </div>
        {{-- <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf --}}
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
            <div class="archiveupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Staff Account is Successfully Retrieved</label>
               </div>
                   <div class="archivereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Error, Please try again</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_retrieve_staff">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>