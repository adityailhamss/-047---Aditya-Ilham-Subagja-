<script>
    $(function () {
      $('#createCommodityModal').on('shown.bs.modal', () => {
        $('#createCommodityModal').find('input').not('[type=hidden]')[0].focus();
      });
    });

</script>