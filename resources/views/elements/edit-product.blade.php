<div class="modal-content ">
  <div class="modal-header">
    <h1 class="modal-title text-white fs-5" id="editProductModalLabel">Редактировать {{$product->name}}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
  </div>
  <div class="modal-body">


    <form id="editProductForm" class='needs-validation' >
        <input type="hidden"  name="id" id="id" value="{{$product->id}}" >
      <p class="text-white mb-0">Артикул</p>
      <input type="text"   name= "article" @if (!$user->can('edit articles'))   readonly   @endif  pattern="[a-zA-Z0-9]+" required class="form-control  @if (!$user->can('edit articles'))   bg-secondary   @endif " placeholder="" value="{{$product->article}}" >
      <div  class="invalid-feedback">   </div>


      <p class="text-white mb-0 mt-3">Название</p>
      <input type="text"  name="name"  required pattern=".{10,}" class="form-control" placeholder="" value="{{$product->name}}" >
      <div  class="invalid-feedback">   </div>

      <p class="text-white mb-0 mt-3">Статус</p>
      <select class="form-select"  name="status" aria-label="Default select example">
        <option  value="available" @if ($product->status=="Доступен")  selected   @endif >Доступен</option>
        <option value="unavailable" @if ($product->status=="Недоступен")  selected   @endif >Недоступен</option>

      </select>

      <h1 class="mt-4 text-white fs-5" > Атрибуты</h1>
      <div id="attributes">

        @if ($product->data)
          @foreach ($product->data as $key => $attr)
          <div class='d-flex' >
            <div>
              <p class='text-white mb-0 mt-3'>Название</p>
              <input type='text' name='attrnames[]' class='form-control'  placeholder='' value={{$key}} >
            </div>
            <div class ='ms-3'>
              <p class='text-white mb-0 mt-3'>Значение</p>
              <input type='text' name='attrvals[]' class='form-control'  placeholder='' value={{$attr}} >
            </div>
            <div class='mx-2 mt-auto js_delete_attribute'>
              <img class='mb-3 ' src='/images/basket.svg'>
            </div>
          </div>
          @endforeach
        @endif

      </div>

      <a href="#" class="text-info mt-5 js_add_attribute" >+ Добавить атрибут</a>

    </div>


  </form>
  <div class="modal-footer">
    <button type="button" class="btn btn-info me-auto text-white js_submit">Сохранить</button>
  </div>
</div>
