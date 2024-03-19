@isset($destroy)
    <button class="btn btn-danger" onclick="Delete(this.id, this.name)" id="{{ $destroy['id'] }}" name="{{ $destroy['name'] }}"> <i class="fa fa-trash"></i></button>
@endisset

@isset($approve)
    <a class="btn btn-success" href="{{ $approve  }}"> <i class="fa fa-check"></i></a>
@endisset