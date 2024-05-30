<script>
    $(function () {
      // Event handler when the 'createCommodityModal' is shown
      $('#createCommodityModal').on('shown.bs.modal', () => {
        $('#createCommodityModal').find('input').not('[type=hidden]')[0].focus();
      });

      // Event handler when the 'editCommodityModal' is shown
      $('#editCommodityModal').on('shown.bs.modal', () => {
        $('#editCommodityModal').find('input').not('[type=hidden]')[0].focus();
      });

      // Event handler for clicking the 'editCommodityButton' in the datatable
      $('.datatable').on('click', '.editCommodityButton', function (e) {
        // Get the commodity ID from the data-id attribute of the clicked button
        let id = $(this).data('id');
        // Replace placeholder 'param' with ID in the URLs for fetching and updating data
        let showURL = "{{ route('api.v1.commodities.show', 'param') }}";
        let updateURL = "{{ route('administrators.commodities.update', 'param') }}";
        showURL = showURL.replace('param', id);
        updateURL = updateURL.replace('param', id);

        // Prepare inputs in the 'editCommodityModal' with a loading message and disable them temporarily
        let input = $('#editCommodityModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
        input.val('Sedang mengambil data..');
        input.attr('disabled', true);

        // Ajax request to fetch data based on the ID
        $.ajax({
          url: showURL,
          method: 'GET',
          success: (res) => {
            // Enable the inputs again and fill them with the fetched data
            input.attr('disabled', false);
            $('#editCommodityModal #name').val(res.data.name);
            // Set the form action in the modal to update data
            $('#editCommodityModal form').attr('action', updateURL);
          },
          error: (err) => {
            // Show an error message if there is an error in the request
            Swal.fire(
              'Error',
              'Terjadi kesalahan, lapor kepada administrator!',
              'error'
            );

            $('#editCommodityModal').on('shown.bs.modal', () => {
              $('#editCommodityModal').modal('hide');
            });
          }
        });
      });  
    });

</script>