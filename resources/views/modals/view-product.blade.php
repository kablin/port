<div class="modal   fade" id="viewProduct" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content ">


      <div class="modal-header">
        <h1 class="modal-title text-white fs-5" id="viewProductModalLabel">Добавить продукт</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-3">
            <p class="text-white mb-0">Артикул</p>

            <p class="text-white mb-0 mt-3">Название</p>
            <p class="text-white mb-0 mt-3">Статус</p>

            <p class="text-white mb-0 mt-3">Атрибуты</p>


          </div>

          <div class="col-9">
            <p class="text-white mb-0">Артикул</p>

            <p class="text-white mb-0 mt-3">Название</p>
            <p class="text-white mb-0 mt-3">Статус</p>

            <p class="text-white mb-0 mt-3">Атрибуты</p>


          </div>


        </div>

      </div>

      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>



@push('push-scripts')
<script type="module">
$( function() {

  const myModalEl = document.getElementById('viewProduct')
  myModalEl.addEventListener('show.bs.modal', event => {
    var url = '{{ route("product.get", ":id") }}';
    url = url.replace(':id',event.relatedTarget.getAttribute('data-bs-product'));
    axios.post(url).then(function (res) {
      //$( document ).trigger( "ajaxFilterSetContent-country_hotel", res.data.content );
      $('#viewProduct').find('.modal-dialog').html(res.data.content)
    })
  })


    $('#viewProduct').on( "click",'.js_delete_product', function( event, data ) {
      var url = '{{ route("product.delete", ":id") }}';
      url = url.replace(':id',$(this).data('id'));
      axios.post(url).then(function (res) {
          location.reload();
      })

    });







});


</script>
@endpush
