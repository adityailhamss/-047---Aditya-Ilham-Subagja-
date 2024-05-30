<script>
  $(function () {
    // Event handler when the 'createSchoolClassModal' is shown
    $('#createSchoolClassModal').on('shown.bs.modal', () => {
      $('#createSchoolClassModal').find('input').not('[type=hidden]')[0].focus();
    });

    // Event handler when the 'editSchollClassModal' is shown
    $('#editSchoolClassModal').on('shown.bs.modal', () => {
      $('#editSchoolClassModal').find('input').not('[type=hidden]')[0].focus();
    });

    //  Event handler for clicking the 'editSchollClassButton' in the datatable
    $('.datatable').on('click', '.editSchoolClassButton', function (e) {
      //  Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');

      // Replace placeholder 'param' with ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.school-classes.show', 'param') }}";
      let updateURL = "{{ route('administrators.school-classes.update', 'param') }}";
      showURL = showURL.replace('param', id);
      updateURL = updateURL.replace('param', id);

      // Prepare inputs in the modal with a loading message and disable them temporarily
      let input = $('#editSchoolClassModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.val('Sedang mengambil data..');
      input.attr('disabled', true);

      // Ajax request to fetch data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          input.attr('disabled', false);
          $('#editSchoolClassModal #name').val(res.data.name);
          // Set the form action in the modal to update data
          $('#editSchoolClassModal form').attr('action', updateURL);
        },
        error: (err) => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );

          $('#editSchoolClassModal').on('shown.bs.modal', () => {
            $('#editSchoolClassModal').modal('hide');
          });
        }
      });
    });
  });
</script>
