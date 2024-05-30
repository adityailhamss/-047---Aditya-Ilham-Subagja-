<script>
    $(function () {
      // Event handler when the 'createProgramStudyModal' is shown
      $('#createProgramStudyModal').on('shown.bs.modal', () => {
        $('#createProgramStudyModal').find('input').not('[type=hidden]')[0].focus();
      });
  
      // Event handler when the and 'editProgramStudyModal' is shown
      $('#editProgramStudyModal').on('shown.bs.modal', () => {
        $('#editProgramStudyModal').find('input').not('[type=hidden]')[0].focus();
      });
  
      //  Event handler for clicking the 'editProgramStudyButton' in the datatable
      $('.datatable').on('click', '.editProgramStudyButton', function (e) {
        //  Get the commodity ID from the data-id attribute of the clicked button
        let id = $(this).data('id');
        
        // Replace placeholder 'param' with ID in the URLs for fetching and updating data
        let showURL = "{{ route('api.v1.program-studies.show', 'param') }}";
        let updateURL = "{{ route('administrators.program-studies.update', 'param') }}";
        showURL = showURL.replace('param', id);
        updateURL = updateURL.replace('param', id);
  
        // Prepare inputs in the 'editOfficerModal' with a loading message and disable them temporarily
        let input = $('#editProgramStudyModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
        input.val('Sedang mengambil data..');
        input.attr('disabled', true);
  
        // Ajax request to fetch data based on the ID
        $.ajax({
          url: showURL,
          method: 'GET',
          success: (res) => {
            input.attr('disabled', false);
            $('#editProgramStudyModal #name').val(res.data.name);
            // Set the form action in the modal to update data
            $('#editProgramStudyModal form').attr('action', updateURL);
          },
          error: (err) => {
            Swal.fire(
              // Show an error message if there is an error in the request
              'Error',
              'Terjadi kesalahan, lapor kepada administrator!',
              'error'
            );
  
            $('#editProgramStudyModal').on('shown.bs.modal', () => {
              $('#editProgramStudyModal').modal('hide');
            });
          }
        });
      });
    });
  </script>
  