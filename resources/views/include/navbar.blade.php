<?php 
    use Yajra\Datatables\Datatables; 
    use App\Model\User\User;

    // get user auth
    $user = Auth::user();
?>

<div class="sidebar-wrapper" style="background: #1e1b4b;">
    <div class="logo">
        <!-- <a href="<?= URL::to('/'); ?>" class="simple-text" style="color: #22c55e; font-size: 16px;">
            RAHMATAN LIL'ALAMIN
        </a> -->
        <img src="<?= URL::to('/layout/assets/img/logo.png'); ?>" style="width:200px;height:50px;" class="center">
    </div>

<br>
<div class="text-center m-auto user-login">
    <i style="font-size: 100px;" class="pe-7s-user pe-lg pe-va"></i>
    <p>{{ $user->full_name }}</p>
     <a href="<?= URL::to('/profile'); ?>">
         <!-- <span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp Profile -->
         Edit
     </a>
</div>


<ul class="nav">
    <li class="<?= $active == 'home' ? 'active' : '' ?>">
        <a href="<?= URL::to('/'); ?>">
            <i class="pe-7s-graph"></i>
            <p>Home</p>
        </a>
    </li>

    @if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN)

    <li class="<?= $active == 'user' ? 'active' : '' ?>">
        <a href="<?= URL::to('/user'); ?>">
            <i class="pe-7s-user"></i>
            <p>Pengguna</p>
        </a>
    </li>

    @endif

    @if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN)

    <li class="<?= $active == 'parent' ? 'active' : '' ?>">
        <a href="<?= URL::to('/parent'); ?>">
            <i class="pe-7s-id"></i>
            <p>Orang Tua</p>
        </a>
    </li>
    
    <li class="<?= $active == 'student_class' ? 'active' : '' ?>">
        <a href="<?= URL::to('/student-class'); ?>">
            <i class="pe-7s-note2"></i>
            <p>Halaqah</p>
        </a>
    </li>

    <li class="<?= $active == 'siswa' ? 'active' : '' ?>">
        <a href="<?= URL::to('/siswa'); ?>">
            <i class="pe-7s-smile"></i>
            <p>Santri</p>
        </a>
    </li>

    <li class="<?= $active == 'alquran' ? 'active' : '' ?>">
        <a href="<?= URL::to('/alquran'); ?>">
            <i class="glyphicon glyphicon-book"></i>
            <p>Qur'an</p>
        </a>
    </li>

    @endif

    @if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_TEACHER)
    
    <li class="<?= $active == 'assessment' ? 'active' : '' ?>">
        <a href="<?= URL::to('/assessment'); ?>">
            <i class="pe-7s-note2"></i>
            <p style="color: yellow">Penilaian Santri</p>
        </a>
    </li>

    @endif

</ul>
</div>

<style type="text/css">

.center 
{
    display: block;
    margin-left: auto;
    margin-right: auto;
}

</style>

@push('scripts')


@endpush


@section('modal')

<div class="modal fade" id="detailNotification" role="dialog" >
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <p class="modal-title">Detail Notifikasi</p>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Judul Notifikasi</label>
      <input disabled="true" type="text" class="form-control" value="" name="notification_title" id="notification_title">
    </div>

    <div class="form-group">
      <label>Isi Pesan Notifikasi</label>
      <input disabled="true" type="text" class="form-control" value="" name="notification_message" id="notification_message">
    </div>

    <div class="form-group">
      <label>Dikeluarkan Pada Tanggal</label>
      <input disabled="true" type="text" class="form-control" value="" name="date" id="date">
    </div>

    </div>
    
  </div>
</div>
</div>

@endsection