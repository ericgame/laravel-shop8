@extends('layouts.app')
@section('title', '收貨地址列表')

@section('content')
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card panel-default">
        <div class="card-header">收貨地址列表 <a href="{{ route('user_addresses.create') }}" class="float-end">新增收貨地址</a></div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>收貨人</th>
              <th>地址</th>
              <th>郵編</th>
              <th>電話</th>
              <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($addresses as $address)
              <tr>
                <td>{{ $address->contact_name }}</td>
                <td>{{ $address->full_address }}</td>
                <td>{{ $address->zip }}</td>
                <td>{{ $address->contact_phone }}</td>
                <td>
                  <a href="{{ route('user_addresses.edit', ['user_address' => $address->id]) }}" class="btn btn-primary">修改</a>
                  <button class="btn btn-danger btn-del-address" type="button" data-id="{{ $address->id }}">刪除</button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scriptsAfterJs')
<script>
$(document).ready(function() {
  // 刪除按鈕點擊事件
  $('.btn-del-address').click(function() {
    // 獲取按鈕上 data-id 屬性的值，也就是地址 ID
    var id = $(this).data('id');
    // 調用 sweetalert
    swal({
        title: "確認要刪除該地址？",
        icon: "warning",
        buttons: ['取消', '確定'],
        dangerMode: true,
      })
    .then(function(willDelete) { // 用戶點擊按鈕後會觸發這個回調函數
      // 用戶點擊確定 willDelete 值為 true， 否則為 false
      // 用戶點了取消，啥也不做
      if (!willDelete) {
        return;
      }
      // 調用刪除接口，用 id 來拼接出請求的 url
      axios.delete('/user_addresses/' + id)
        .then(function () {
          // 請求成功之後重新加載頁面
          location.reload();
        })
    });
  });
});
</script>
@endsection
