@extends('master')

@section('title', '')

@section('content')

@if(Session::has('alert_success'))
  @component('components.alert')
        @slot('class')
            success
        @endslot
        @slot('title')
            
        @endslot
        @slot('message')
            {{ session('alert_success') }}
        @endslot
  @endcomponent
@elseif(Session::has('alert_error'))
  @component('components.alert')
        @slot('class')
            error
        @endslot
        @slot('title')
            Cek Kembali
        @endslot
        @slot('message')
            {{ session('alert_error') }}
        @endslot
  @endcomponent 
@endif

  <form method="post" action="{{route('do-assessment')}}">

    @csrf

    <div class="form-group">
      <label>Nama Santri</label>
      <input type="text" class="form-control" value="{{ $data_siswa->siswa_name }}" disabled>
    </div>
    <div id="surat-container">
      <div class="surat-group row">
        <div class="form-group col-md-6">
          <label>Surat </label>
          <select class="js-example-basic-single form-control" name="surah_id" id="surah_id">
                <option></option>
              </select>
          @if ($errors->has('surah_id'))
              <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('surah_id') }}</p></div>
          @endif
        </div>

        <div class="form-group col-md-3">
            <label for="begin">Mulai Ayat</label>
            <select class="form-control" id="begin" name="begin"></select>
            @if ($errors->has('begin'))
              <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('begin') }}</p></div>
            @endif
        </div>
        <div class="form-group col-md-3">
            <label for="end">Sampai Ayat</label>
            <select class="form-control" id="end" name="end"></select>
            @if ($errors->has('end'))
              <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('end') }}</p></div>
            @endif
        </div>
      </div>
    </div>

    <div class="form-group col-md-4" style="padding-left: 0px">
      <label for="kelancaran">Kelancaran</label>
      <select class="form-control" id="kelancaran" name="kelancaran">
        @for ($i = 1; $i <= 10; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      @if ($errors->has('kelancaran'))
        <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('kelancaran') }}</p></div>
      @endif
    </div>

    <div class="form-group col-md-4" style="padding-left: 0px">
      <label for="tajwid">Tajwid</label>
      <select class="form-control" id="tajwid" name="tajwid">
        @for ($i = 1; $i <= 10; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      @if ($errors->has('tajwid'))
        <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('tajwid') }}</p></div>
      @endif
    </div>

    <div class="form-group col-md-4" style="padding-left: 0px">
      <label for="makhraj">Makhraj</label>
      <select class="form-control" id="makhraj" name="makhraj">
        @for ($i = 1; $i <= 10; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      @if ($errors->has('makhraj'))
        <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('makhraj') }}</p></div>
      @endif
    </div>

    <div class="form-group">
      <label>Keterangan </label>
      <input type="text" class="form-control" name="note">
      @if ($errors->has('note'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('note') }}</p></div>
      @endif
    </div>
      
    <div class="form-group" id="submit_yes" style="padding-top: 20px; padding-bottom: 20px">
      <button type="submit" class="btn btn-info" value="text 1"> SUBMIT </button>
    </div>

    <div class="form-group">
      <input type="hidden" class="form-control" name="id_siswa" value="{{ $data_siswa->id }}">
    </div>

  </form>

<hr>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
  <thead>
      <tr>
          <th>Surat </th>
          <th>Ayat </th>
          <th>Keterangan </th>
          <th>Tanggal </th>
      </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>
  
@endsection

@push('scripts')

<script type="text/javascript">

  var id_ayat;
  var total_ayat;
  var id_siswa = '{{ $data_siswa->id }}';
  var table;

  $(function () {
    
    var url = '{{ route("create-assessment", ":id") }}';
    url = url.replace(':id', id_siswa);
    
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        bInfo: false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        // "aaSorting": [[ 3, "desc" ]],
        ajax: url,
        columns: [
            {data: 'assessment', name: 'assessment'},
            {data: 'range', name: 'range'},
            // {data: 'kelancaran', name: 'kelancaran'},
            // {data: 'tajwid', name: 'tajwid'},
            // {data: 'makhraj', name: 'makhraj'},
            {data: 'note', name: 'note'},
            {data: 'date', name: 'date'},
        ]
    });
  });

  $(document).ready(function() {

    $('#surah_id').select2({
      allowClear: true,
      ajax: {
        url: base_url + '/assessment/get-surah',
        dataType: 'json',
        data: function(params) {
            return {
              search: params.term
            }
        },
        processResults: function (data, page) {
            return {
              results: data
            };
        }
      }
    });
    $("#surah_id").change(function() {
    var id_ayat = $(this).val();
    $.ajax({
        type: 'GET',
        url: base_url + '/assessment/get-total-ayat',
        data: {
            id_ayat: id_ayat,
            "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
            total_ayat = data;

            $('#begin').empty();
            $('#end').empty();

            for (var i = 1; i <= total_ayat; i++) {
                $('#begin').append('<option value="' + i + '">' + i + '</option>');
                $('#end').append('<option value="' + i + '">' + i + '</option>');
            }

            $('#begin').val('1');
            $('#end').val(total_ayat);
        },
        error: function(error) {
            swal('Terjadi kegagalan sistem', { button: false, icon: "error", timer: 1000 });
        }
      });
  });
});


$(document).ready(function() {
    // Tambahkan event listener untuk tombol "Tambah Surat"
    $('#add-surat').click(function() {
        var index = $('.surat-group').length + 1; // Hitung jumlah elemen surat-group
        var suratGroup = `
              <div class="surat-group row">
                  <div class="form-group col-md-3">
                      <label>Surat</label>
                      <select class="js-example-basic-single form-control surah-select" name="surah_id[]" id="surah_id_${index}">
                          <option></option>
                      </select>
                  </div>

                  <div class="form-group col-md-3">
                      <label for="begin">Mulai Ayat</label>
                      <select class="form-control begin-select" id="begin_${index}" name="begin[]"></select>
                  </div>

                  <div class="form-group col-md-3">
                      <label for="end">Sampai Ayat</label>
                      <select class="form-control end-select" id="end_${index}" name="end[]"></select>
                  </div>
                  <div class="form-group col-md-2">
                    <br>
                    <button type="button" class="btn btn-danger remove-surat">x</button>
                  </div>
              </div>
        `;

        $('#surat-container').append(suratGroup);

        // Inisialisasi select2 untuk elemen yang baru ditambahkan
        $(`.surah-select#surah_id_${index}`).select2({
            allowClear: true,
            ajax: {
                url: base_url + '/assessment/get-surah',
                dataType: 'json',
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    };
                }
            }
        });

        $(`.surah-select#surah_id_${index}`).change(function() {
            var id_ayat = $(this).val();
            var $parentGroup = $(this).closest('.surat-group');
            $.ajax({
                type: 'GET',
                url: base_url + '/assessment/get-total-ayat',
                data: {
                    id_ayat: id_ayat,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    total_ayat = data;

                    $parentGroup.find('.begin-select').empty();
                    $parentGroup.find('.end-select').empty();

                    for (var i = 1; i <= total_ayat; i++) {
                        $parentGroup.find('.begin-select').append('<option value="' + i + '">' + i + '</option>');
                        $parentGroup.find('.end-select').append('<option value="' + i + '">' + i + '</option>');
                    }

                    $parentGroup.find('.begin-select').val('1');
                    $parentGroup.find('.end-select').val(total_ayat);
                },
                error: function(error) {
                    swal('Terjadi kegagalan sistem', { button: false, icon: "error", timer: 1000 });
                }
            });
        });
    });

    $(document).on('click', '.remove-surat', function() {
        $(this).closest('.surat-group').remove();
    });
});

</script>

@endpush