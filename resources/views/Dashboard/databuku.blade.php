@extends('Dashboard.layouts.app')

@section('css-content')
    <link rel="stylesheet" href="{{ asset('assets/css/petugas/databuku.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
 @endsection

@section('content')
    <div class="my-3 px-5">
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                <h3 class="fw-normal title-page">Dashboard /</h3>
                <h3 class="fw-semibold title-page">Data Buku</h3>
            </div>
            <button class="btn px-3 btn-tambahdata" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Tambah Data</button>
        </div>
        <hr class="line border border-2 rounded-bg opacity-100">
    </div>
    <div class="container">
    <div class="card p-3">
        <h5 class="card-header">Data Buku</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>File</th>
                        <th>Cover</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>
   

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Buku</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('databuku-petugas-store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" name="judul_buku">
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" cols="30" rows="10" class="foem-control" name="deskripsi"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" aria-label="Default select example" name="kategori">
                        @foreach ($kategori as $item)
                            <option value="{{$item->id}}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">File Buku</label>
                    <input type="file" class="form-control" name="file_buku">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cover Buku</label>
                    <input type="file" class="form-control" name="cover">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Buku</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editmodalLabel">Edit Buku</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('databuku-petugas-update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" name="judul_buku" id="judul_buku">
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" name="penulis" id="penulis">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea id="deskripsi_edit" cols="30" rows="10" class="form-control" name="deskripsi_edit"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" aria-label="Default select example" id="kategori" name="kategori">
                        @foreach ($kategori as $item)
                            <option value="{{$item->id}}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">File Buku</label>
                    <input type="file" class="form-control" name="file_buku" id="file_buku">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cover Buku</label>
                    <input type="file" class="form-control" name="cover" id="cover">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Buku</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
@endsection

@section('js-content')
<script src="{{ asset('assets/vendor/ckeditor5/ckeditor.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.js"></script>
<script src="{{asset('assets/vendor/datatables/datatables.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#deskripsi' ) )
        .catch( error => {
            console.error( error );
        } );
        let myEditor;
        ClassicEditor
        .create( document.querySelector( '#deskripsi_edit' ) )
        .then(editor => {
            window.editor = editor;
            myEditor = editor;
        })
        .catch( error => {
            console.error( error );
        } );
</script>
<script type="text/javascript">
  moment.locale('id');

var table = $('#table').DataTable({
    ajax: `{{ route('databuku-petugas-datatable') }}`,
    // scrollX: true,
    // searching: true,
    paging: true,
    processing: true,
    serverSide: true,
    columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'judul_buku',
            name: 'judul_buku',
            searchable: false
        },
        {
            data: 'penulis',
            name: 'penulis',
        },
        {
            data: 'deskripsi',
            name: 'deskripsi',
        },
        {
            data: 'kategori',
            name: 'kategori',
        },
        {
            data: 'file_buku',
            name: 'file_buku',
        },
        {
            data: 'cover',
            name: 'cover',
            render: function(data, type, row) {
                    if (type === 'display') {
                        return '<img src="' + data + '" alt="' + row.judul_buku + '" width="100" height="100%">';
                    }
                    return data;
                },
        searchable: true
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ]
})

$(document).delegate('.btn-edit', 'click', function() {
    // e.preventDefault();
    const id = $(this).data('id');
    $.ajax({
        url: "{{ url('databuku-petugas-edit') }}/" + id,
        type: 'get',
        data: {
            _token: `{{ csrf_token() }}`,
            id
        },
        success: function(resp) {
            $('#id').val(resp.id);
            $('#judul_buku').val(resp.judul_buku);
            $('#penulis').val(resp.penulis);
            $('#kategori').val(resp.category);
            myEditor.setData(resp.deskripsi);

            $('#editmodal').modal('show');
        },
        error: function(err) {
            const errorResp = JSON.parse(err.responseText);
            return Swal.fire('Gagal !',
                `Data gagal dihapus: ${errorResp.message}`, 'error');
        }
    })
})
$(document).delegate('.btn-delete', 'click', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: "Hapus Data ?",
                text: "Apakah anda yakin akan menghapus data ini ?",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                icon: 'question'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('databuku-petugas-destroy') }}/" + id,
                        type: 'get',
                        data: {
                            _token: `{{ csrf_token() }}`,
                            id
                        },
                        success: function(resp) {
                            return Swal.fire('Berhasil !', 'Data berhasil dihapus', 'success')
                                .then(() => table.ajax.reload());
                        },
                        error: function(err) {
                            const errorResp = JSON.parse(err.responseText);
                            return Swal.fire('Gagal !',
                                `Data gagal dihapus: ${errorResp.message}`, 'error');
                        }
                    })
                }
            })
        })
</script>
@endsection