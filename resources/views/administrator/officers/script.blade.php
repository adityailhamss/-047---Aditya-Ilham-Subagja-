<script>
  function formatPhoneNumber(phoneNumber) {
    // Menghapus semua karakter non-digit
    let cleaned = ('' + phoneNumber).replace(/\D/g, '');
    // Memeriksa apakah nomor handphone memiliki panjang yang sesuai
    let match = cleaned.match(/^(\d{1})(\d{3})(\d{3})(\d{4})$/);
    if (match) {
        // Jika sesuai, mengembalikan nomor handphone dengan format yang benar
        return match[1] + '-' + match[2] + '-' + match[3] + '-' + match[4];
    }
    // Jika tidak sesuai, mengembalikan nomor handphone asli
    return phoneNumber;
}
  $(function () {
    function focusFirstInput(modal) {
      modal.find('input').not('[type=hidden]')[0].focus();
    }

    $('#createofficerModal, #editOfficerModal').on('shown.bs.modal', function () {
      focusFirstInput($(this));
    });

    $('.datatable').on('click', '.showOfficerButton', function () {
      let id = $(this).data('id');
      let showURL = "{{ route('api.v1.officers.show', 'param') }}".replace('param', id);
      console.log('Show URL:', showURL);  // Debugging

      let inputs = $('#detailOfficerModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      inputs.val('Sedang mengambil data..');

      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          $('#detailOfficerModal #name').val(res.data.name);
          $('#detailOfficerModal #email').val(res.data.email);
          $('#detailOfficerModal #phone_number').val(res.data.phone_number);
        },
        error: () => {
          Swal.fire(
            'Error',
            'Terjadi kesalahan, lapor kepada administrator!',
            'error'
          );
          $('#detailOfficerModal').modal('hide');
        }
      });
    });

    $('.datatable').on('click', '.editOfficerButton', function () {
      let id = $(this).data('id');
      let showURL = "{{ route('api.v1.officers.show', 'param') }}".replace('param', id);
      let updateURL = "{{ route('administrators.officers.update', 'param') }}".replace('param', id);
      console.log('Show URL:', showURL);  // Debugging
      console.log('Update URL:', updateURL);  // Debugging

      let inputs = $('#editOfficerModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      inputs.not('[type=password]').not('select').val('Sedang mengambil data..');
      inputs.attr('disabled', true);

      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          inputs.attr('disabled', false);
          $('#editOfficerModal #name_officer').val(res.data.name);
          $('#editOfficerModal #email_officer').val(res.data.email);
          $('#editOfficerModal #phone_number_officer').val(formatPhoneNumber(res.data.phoneNumber));
          $('#editOfficerModal form').attr('action', updateURL);
        },
        error: () => {
          Swal.fire(
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
