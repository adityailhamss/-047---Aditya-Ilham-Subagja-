<script>
  $(function() {
    // Initialize tooltips for elements that have the data-bs-toggle="tooltip" attribute
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Event listener for click events on elements with the class 'showBorrowingButton' inside the '.datatable' element
    $('.datatable').on('click', '.showBorrowingButton', function (e) {
      // Get the borrowing ID from the data-id attribute of the clicked button
      let id = $(this).data('id');
      // Construct the URL for fetching borrowing details, replacing 'param' with the actual ID
      let showURL = "{{ route('api.v1.borrowings.show', 'param') }}";
      showURL = showURL.replace('param', id);

       // Set a placeholder text while data is being fetched
      let input = $('#detailBorrowingModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.val('Sedang mengambil data..');

      // Make an AJAX GET request to fetch borrowing details
      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          // On success, populate the modal inputs with the fetched data
          $('#detailBorrowingModal #student_identification_number').val(res.data.student.identificationNumber);
          $('#detailBorrowingModal #student_name').val(res.data.student.name);
          $('#detailBorrowingModal #student_phone_number').val(res.data.student.phoneNumber);
          $('#detailBorrowingModal #program_study_name').val(res.data.student.programStudy);
          $('#detailBorrowingModal #school_class_name').val(res.data.student.schoolClass);

          $('#detailBorrowingModal #commodity_name').val(res.data.commodity.name);
          $('#detailBorrowingModal #subject_name').val(res.data.subject.name);
          $('#detailBorrowingModal #time_start').val(res.data.timeStart);
          $('#detailBorrowingModal #time_end').val(res.data.timeEnd);
          $('#detailBorrowingModal #is_returned').val(res.data.isReturned);
          $('#detailBorrowingModal #note').val(res.data.note);
        },
        error: (err) => {
          // On error, show an error alert using Swal.fire
          Swal.fire(
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );

          $('#detailBorrowingModal').on('shown.bs.modal', () => {
            $('#detailBorrowingModal').modal('hide');
          });
        }
      });
    });
  });
</script>