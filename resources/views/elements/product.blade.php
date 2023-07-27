<div class="modal-content ">


  <div class="modal-header">
    <h1 class="modal-title text-white fs-5" id="viewProductModalLabel">{{$product->name}}</h1>
    <img src="/images/edit.svg" data-bs-toggle="modal" data-bs-target="#editProduct" role="button" data-id="{{$product->id}}" class="ms-auto" >
    <img src="/images/delete.svg" class="js_delete_product ms-2" data-id="{{$product->id}}" role="button" >
    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Закрыть"></button>
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
        <p class="text-white mb-0">{{$product->article}}</p>
        <p class="text-white mb-0 mt-3">{{$product->name}}</p>
        <p class="text-white mb-0 mt-3">{{$product->status}}</p>
        <p class="text-white mb-0 mt-3"> <x-attr-viewer :attrs="$product->data"/> </p>


      </div>


    </div>

  </div>

  <div class="modal-footer">

  </div>
</div>
