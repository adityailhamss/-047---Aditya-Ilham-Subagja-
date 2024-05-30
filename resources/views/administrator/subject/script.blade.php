<script>
  $(function () {
    // Event handler when the modal is shown
    $('#createSubjectModal').on('shown.bs.modal', () => {
      $('#createSubjectModal').find('input').not('[type=hidden]')[0].focus();
    });

    // Event handler when the modal is shown
    $('#editSubjectModal').on('shown.bs.modal', () => {
      $('#editSubjectModal').find('input').not('[type=hidden]')[0].focus();
    });

    //  Event handler for clicking the button in the datatable
    $('.datatable').on('click', '.editSubjectButton', function (e) {
      //  Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');

      // Replace placeholder 'param' with ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.subjects.show', 'param') }}";
      let updateURL = "{{ route('administrators.subjects.update', 'param') }}";
      showURL = showURL.replace('param', id);
      updateURL = updateURL.replace('param', id);

      // Prepare inputs in the modal with a loading message and disable them temporarily
      let input = $('#editSubjectModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.val('Sedang mengambil data..');
      input.attr('disabled', true);

      // Ajax request to fetch data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          input.attr('disabled', false);
          $('#editSubjectModal #code').val(res.data.code);
          $('#editSubjectModal #name').val(res.data.name);
          // Set the form action in the modal to update data
          $('#editSubjectModal form').attr('action', updateURL);
        },
        error: (err) => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );

          $('#editSubjectModal').on('shown.bs.modal', () => {
            $('#editSubjectModal').modal('hide');
          });
        }
      });
    });
  });
</script>
