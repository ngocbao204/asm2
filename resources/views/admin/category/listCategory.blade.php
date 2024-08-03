@extends('admin.layout.master')

@section('content')
<div class="card">
                <div class="card-header w-100 ">
                  <div class="d-flex justify-content-between">
                    <h4 class="card-title">Danh mục</h4>
                    <a href="{{route('Category.create')}}"><button class="btn btn-primary mt-3">Thêm mới</button></a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                      
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tên sản phẩm</th>
                          <th>Thao tác</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($listCategory as $listcate )
                        <tr>
                          <td>{{$listcate->id}}</td>
                          <td>{{$listcate->name_category}}</td>
                          
                          
                          <td>
                            <div class="d-flex">
                              <a href="{{route('Category.edit',$listcate->id)}}"><button class="btn btn-success">Chỉnh sửa</button></a>
                            <form action="{{route('Category.destroy',$listcate->id)}}" method="POST" class="ms-3">
                              @csrf
                              @method('DELETE')
                              <a href="" onclick="return confirm('Bạn có chắc muốn xóa không?')"><button class="btn btn-danger ">Xóa</button></a>
                            </form>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
@endsection
@section('script_libs')
<script>
    $(document).ready(function () {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
          this.api()
            .columns()
            .every(function () {
              var column = this;
              var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
                .appendTo($(column.footer()).empty())
                .on("change", function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      // Add Row
      $("#add-row").DataTable({
        pageLength: 5,
      });

      var action =
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

      $("#addRowButton").click(function () {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addPosition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>
@endsection