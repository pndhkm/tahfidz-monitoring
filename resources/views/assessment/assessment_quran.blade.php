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

    <div class="form-group">
      <label>Surat </label>
      <select class="js-example-basic-single form-control" name="surah_id" id="surah_id" style="width: 100%;">
            <option></option>
          </select>
      @if ($errors->has('surah_id'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('surah_id') }}</p></div>
      @endif
    </div>

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Mulai Ayat</label>
        <input class="form-control" id="begin" name="begin">
        @if ($errors->has('begin'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('begin') }}</p></div>
        @endif
    </div>

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Sampai Ayat</label>
        <input class="form-control" id="end" name="end">
        @if ($errors->has('end'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('end') }}</p></div>
        @endif
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

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label for="nilai">Nilai</label>
      <select class="form-control" id="nilai" name="nilai">
        @for ($i = 1; $i <= 10; $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </select>
      @if ($errors->has('nilai'))
        <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('nilai') }}</p></div>
      @endif
    </div>


    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Banyak Halaman</label>
        <input class="form-control" id="banyak_halaman" name="banyak_halaman">
        @if ($errors->has('banyak_halaman'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('banyak_halaman') }}</p></div>
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
          <th width="30%">Surat </th>
          <th width="20%">Ayat </th>
          <th width="20%">Kelancaran</th>
          <th width="20%">Tajwid</th>
          <th width="20%">Makhraj</th>
          <th width="20%">Nilai</th>
          <th width="20%">Banyak Halaman</th>
          <th width="20%">Keterangan</th>
          <th width="50%">Tanggal </th>
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
        "aaSorting": [[ 3, "desc" ]],
        ajax: url,
        columns: [
            {data: 'assessment', name: 'assessment'},
            {data: 'range', name: 'range'},
            {data: 'kelancaran', name: 'kelancaran'},
            {data: 'tajwid', name: 'tajwid'},
            {data: 'makhraj', name: 'makhraj'},
            {data: 'nilai', name: 'nilai'},
            {data: 'banyak_halaman', name: 'banyak_halaman'},
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

    $( "#surah_id" ).change(function() {
      id_ayat = $(this).val();
        $.ajax({
        type:'GET',
        url: base_url + '/assessment/get-total-ayat',
        data:{
              id_ayat:id_ayat, 
              "_token": "{{ csrf_token() }}",
        },
       success:function(data) {
         total_ayat = data;
       },
       error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });
    });

    // $('#begin').on('input', function () {
    //   var value = $(this).val();
    //   if ((value !== '') && (value.indexOf('.') === -1)) {
    //       $(this).val(Math.max(Math.min(value, total_ayat), 0));
    //   }
    // });

    // $('#end').on('input', function () {
    //   var value = $(this).val();
    //   if ((value !== '') && (value.indexOf('.') === -1)) {
    //       $(this).val(Math.max(Math.min(value, total_ayat), 0));
    //   }
    // });
    
  });

</script>

@endpush