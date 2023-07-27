<div class="w-100">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Артикул</th>
        <th scope="col">Название</th>
        <th scope="col">Статус</th>
        <th scope="col">Атрибуты</th>

      </tr>
    </thead>
        <tbody>
          @foreach ($products as $product)
            <tr data-bs-toggle="modal" data-bs-target="#viewProduct"  data-bs-product="{{$product->id}}">
              <td>{{ $product->article}}</td>
              <td>{{ $product->name}}</td>
              <td>{{ $product->status}}</td>
              <td>   <x-attr-viewer :attrs="$product->data"/>   </td>
            </tr>

          @endforeach

        </tbody>
  </table>
</div>
