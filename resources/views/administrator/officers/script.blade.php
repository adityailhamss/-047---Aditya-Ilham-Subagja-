<script>
  function formatPhoneNumber(phoneNumber) {
    // Removes all non-digit characters
    let cleaned = ('' + phoneNumber).replace(/\D/g, '');
    // Checks whether the mobile number has the correct length
    let match = cleaned.match(/^(\d{1})(\d{3})(\d{3})(\d{4})$/);
    if (match) {
        // If appropriate, returns the mobile number in the correct format
        return match[1] + '-' + match[2] + '-' + match[3] + '-' + match[4];
    }
    return phoneNumber;
}
  $(function () {
    function focusFirstInput(modal) {
      modal.find('input').not('[type=hidden]')[0].focus();
    }

    // Event handler when the 'createOfficerModal' and 'editOfficerModal' is shown
    $('#createofficerModal, #editOfficerModal').on('shown.bs.modal', function () {
      focusFirstInput($(this));
    });

    // Event handler for clicking the 'showOfficerButton' in the datatable
    $('.datatable').on('click', '.showOfficerButton', function () {
      // Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');
      // Replace placeholder 'param' with the commodity ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.officers.show', 'param') }}".replace('param', id);
  
      // Prepare inputs in the 'detailOfficerModal' with a loading message and disable them temporarily
      let inputs = $('#detailOfficerModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      inputs.val('Sedang mengambil data..');

      // Ajax request to fetch commodity data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          // Enable the inputs again and fill them with the fetched data
          $('#detailOfficerModal #name').val(res.data.name);
          $('#detailOfficerModal #email').val(res.data.email);
          $('#detailOfficerModal #phone_number').val(res.data.phone_number);
        },
        error: () => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );
          $('#detailOfficerModal').modal('hide');
        }
      });
    });

    // Event handler for clicking the 'editOfficerButton' in the datatable
    $('.datatable').on('click', '.editOfficerButton', function () {
      // Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');
      // Replace placeholder 'param' with the commodity ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.officers.show', 'param') }}".replace('param', id);
      let updateURL = "{{ route('administrators.officers.update', 'param') }}".replace('param', id);

      // Prepare inputs in the 'editOfficerModal' with a loading message and disable them temporarily
      let inputs = $('#editOfficerModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      inputs.not('[type=password]').not('select').val('Sedang mengambil data..');
      inputs.attr('disabled', true);

      // Ajax request to fetch data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          // Enable the inputs again and fill them with the fetched data
          inputs.attr('disabled', false);
          $('#editOfficerModal #name_officer').val(res.data.name);
          $('#editOfficerModal #email_officer').val(res.data.email);
          $('#editOfficerModal #phone_number_officer').val(formatPhoneNumber(res.data.phoneNumber));
          // Set the form action in the modal to update data
          $('#editOfficerModal form').attr('action', updateURL);
        },
        error: () => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );
          $('#editOfficerModal').modal('hide');
        }
      });
    });
  });
</script>
