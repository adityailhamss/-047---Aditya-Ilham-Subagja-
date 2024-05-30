<script>
  $(function () {
    // Event handler when the 'createStudentModal' is shown
    $('#createStudentModal').on('shown.bs.modal', () => {
      $('#createStudentModal').find('input').not('[type=hidden]')[0].focus();
    });

    // Event handler when the 'editStudentModal' is shown
    $('#editStudentModal').on('shown.bs.modal', () => {
      $('#editStudentModal').find('input').not('[type=hidden]')[0].focus();
    });

    //  Event handler for clicking the 'ShowStudentButton' in the datatable
    $('.datatable').on('click', '.showStudentButton', function (e) {
      //  Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');

      // Replace placeholder 'param' with ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.students.show', 'param') }}";
      showURL = showURL.replace('param', id);

      // Prepare inputs in the 'editOfficerModal' with a loading message and disable them temporarily
      let input = $('#detailStudentModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.val('Sedang mengambil data..');

      // Ajax request to fetch data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          $('#detailStudentModal #identification_number').val(res.data.identificationNumber);
          $('#detailStudentModal #name').val(res.data.name);
          $('#detailStudentModal #program_study_id').val(res.data.programStudy.name);
          $('#detailStudentModal #school_class_id').val(res.data.schoolClass.name);
          $('#detailStudentModal #email').val(res.data.email);
          $('#detailStudentModal #phone_number').val(res.data.phoneNumber);
        },
        error: (err) => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );

          $('#detailStudentModal').on('shown.bs.modal', () => {
            $('#detailStudentModal').modal('hide');
          });
        }
      });
    });

    //  Event handler for clicking the 'editStudentButton' in the datatable
    $('.datatable').on('click', '.editStudentButton', function (e) {
      //  Get the commodity ID from the data-id attribute of the clicked button
      let id = $(this).data('id');

      // Replace placeholder 'param' with ID in the URLs for fetching and updating data
      let showURL = "{{ route('api.v1.students.show', 'param') }}";
      let updateURL = "{{ route('administrators.students.update', 'param') }}";
      showURL = showURL.replace('param', id);
      updateURL = updateURL.replace('param', id);

      // Prepare inputs in the modal with a loading message and disable them temporarily
      let input = $('#editStudentModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.not('[type=password]').not('select').val('Sedang mengambil data..');
      input.attr('disabled', true);

      // Ajax request to fetch data based on the ID
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          input.attr('disabled', false);
          $('#editStudentModal #identification_number').val(res.data.identificationNumber);
          $('#editStudentModal #name').val(res.data.name);
          $('#editStudentModal #program_study_id').val(res.data.programStudy.id);
          $('#editStudentModal #school_class_id').val(res.data.schoolClass.id);
          $('#editStudentModal #email').val(res.data.email);
          $('#editStudentModal #phone_number').val(res.data.phoneNumber);
          // Set the form action in the modal to update data
          $('#editStudentModal form').attr('action', updateURL);
        },
        error: (err) => {
          Swal.fire(
            // Show an error message if there is an error in the request
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );

          $('#editStudentModal').on('shown.bs.modal', () => {
            $('#editStudentModal').modal('hide');
          });
        }
      });
    });
  });
</script>
