<div class="modal   fade" id="editProduct" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content ">
      <div class="modal-header">
        <h1 class="modal-title text-white fs-5" id="editProductModalLabel">Редактировать </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">


        <form id="editProductForm" class='needs-validation' >
          <p class="text-white mb-0">Артикул</p>
          <input   type="text"    @if (!$user->can('edit articles'))   readonly   @endif   name= "article" pattern="[a-zA-Z0-9]+" required class="form-control" placeholder=""  >
          <div  class="invalid-feedback">   </div>

          <p class="text-white mb-0 mt-3">Название</p>
          <input type="text"  name="name"  required pattern=".{10,}" class="form-control" placeholder=""  >
          <div  class="invalid-feedback">   </div>

          <p class="text-white mb-0 mt-3">Статус</p>
          <select class="form-select"  name="status" aria-label="Default select example">
            <option  value="available" selected>Доступен</option>
            <option value="unavailable">Недоступен</option>

          </select>

          <h1 class="mt-4 text-white fs-5" > Атрибуты</h1>
          <div id="attributes">

          </div>

          <a href="#" class="text-info mt-5 js_add_attribute" >+ Добавить атрибут</a>

        </div>


      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-info me-auto text-white js_submit">Добавить</button>
      </div>
    </div>
  </div>
</div>



@push('push-scripts')
<script type="module">
$( function() {



  const myModalEl = document.getElementById('editProduct')
  myModalEl.addEventListener('show.bs.modal', event => {
    var url = '{{ route("product.edit", ":id") }}';
    url = url.replace(':id',event.relatedTarget.getAttribute('data-id'));
    axios.post(url).then(function (res) {
      //$( document ).trigger( "ajaxFilterSetContent-country_hotel", res.data.content );
      $('#editProduct').find('.modal-dialog').html(res.data.content)
    })
  })



  $('#editProduct').on( "click", ".js_add_attribute",function( event, data ) {
    event.preventDefault();

    var  html = "<div class='d-flex' ><div><p class='text-white mb-0 mt-3'>Название</p> \
    <input type='text' name='attrnames[]' class='form-control'  placeholder=''  > </div>\
    <div class ='ms-3'><p class='text-white mb-0 mt-3'>Значение</p>\
    <input type='text' name='attrvals[]' class='form-control'  placeholder=''  >\
    </div> <div class='mx-2 mt-auto js_delete_attribute'><img class='mb-3 ' src='/images/basket.svg'></div></div>  ";

    $(this).parent().find('#attributes').append(html);

  });


  $('#editProduct').on( "click", ".js_delete_attribute",function( event, data ) {
    event.preventDefault();
    $(this).parent().remove();

  });



  $('#editProduct').on( "click", ".js_submit",function( event, data ) {

    var  form = document.getElementById("editProductForm")

    if ( form.checkValidity()) {

      var attrnames = $('#editProductForm').find('input[name^=attrnames]').map(function(idx, elem) {
        if ($(elem).val())    return $(elem).val();
        else return idx;
      }).get();

      var attrvals = $('#editProductForm').find('input[name^=attrvals]').map(function(idx, elem) {
        return $(elem).val();
      }).get();

      var url = '{{ route("product.store", ":id") }}';
      url = url.replace(':id',$("#editProductForm").find('input[name="id"]').val());

      axios.post(url, {
        article: $("#editProductForm").find('input[name="article"]').val(),
        name: $("#editProductForm").find('input[name="name"]').val(),
        status: $("#editProductForm").find('select[name="status"]').val(),
        attrnames: attrnames,
        attrvals: attrvals,
      })
      .then(function (res) {
            location.reload();
      }).catch(error => {
        if (error.response) {
          for (var key in error.response.data.errors) {
            if (error.response.data.errors.hasOwnProperty(key)) {
              $("#editProductForm").find('input[name="'+key+'"]').toggleClass('is-invalid',true)
              $("#editProductForm").find('input[name="'+key+'"]').next().html( error.response.data.errors[key])
            }
          }
        }
      });
    }

    form.classList.add('was-validated')

  });

});


</script>
@endpush
