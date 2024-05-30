<script>
  $(function () {
    // Event handler when the modal is shown
    $('#createAdministratorModal').on('shown.bs.modal', () => {
      $('#createAdministratorModal').find('input').not('[type=hidden]')[0].focus();
    });

    // Event handler when the modal is shown
    $('#editAdministratorModal').on('shown.bs.modal', () => {
      $('#editAdministratorModal').find('input').not('[type=hidden]')[0].focus();
    });

    //  Event handler for clicking the button in the datatable
    $('.datatable').on('click', '.editAdministratorButton', function (e) {
      //  Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');

      // Replace placeholder 'param' with ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.users.show', 'param') }}";
      let updateURL = "{{ route('administrators.users.update', 'param') }}";
      showURL = showURL.replace('param', id);
      updateURL = updateURL.replace('param', id);

      // Prepare inputs in the modal with a loading message and disable them temporarily
      let input = $('#editAdministratorModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.not('[type=password]').val('Sedang mengambil data..');
      input.attr('disabled', true);

      // Ajax request to fetch data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          input.attr('disabled', false);
          $('#editAdministratorModal #code').val(res.data.code);
          $('#editAdministratorModal #name').val(res.data.name);
          $('#editAdministratorModal #email').val(res.data.email);
          $('#editAdministratorModal #phone_number').val(res.data.phone_number);
          // Set the form action in the modal to update data
          $('#editAdministratorModal form').attr('action', updateURL);
        },
        error: (err) => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );

          $('#editAdministratorModal').on('shown.bs.modal', () => {
            $('#editAdministratorModal').modal('hide');
          });
        }
      });
    });
  });
</script>
