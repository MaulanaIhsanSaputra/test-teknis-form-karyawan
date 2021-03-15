@extends('educations.layout')
@section('content')
<div class="row">
    <div class="col-lg-12" style="text-align: center">
        <div>
            <h2>Form Karyawan</h2>
        </div>
        <br />
    </div>
    <form>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="nama" class="form-control" id="nama" placeholder="Enter Nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea type="alamat" class="form-control" id="alamat" placeholder="Enter Alamat"></textarea>
        </div>
        <div class="form-group">
            <label for="noKtp">Np. KTP</label>
            <input type="noKtp" class="form-control" id="noKtp" placeholder="Enter No. KTP" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p id="msg-edu">{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <h2>Pendidikan</h2>
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-education" data-toggle="modal">New
                Education</a>
        </div>
    </div>
</div>
<br />
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Sekolah/Universitas</th>
        <th>Jurusan</th>
        <th>Tahun Masuk</th>
        <th>Tahun Lulus</th>
        <th width="280px">Action</th>
    </tr>

    @foreach ($educations as $education)
    <tr id="education_id_{{ $education->id }}">
        <td>{{ $education->id }}</td>
        <td>{{ $education->sekolah }}</td>
        <td>{{ $education->jurusan }}</td>
        <td>{{ $education->tahun_masuk }}</td>
        <td>{{ $education->tahun_lulus }}</td>
        <td>
            <form action="{{ route('educations.destroy',$education->id) }}" method="POST">
                <a href="javascript:void(0)" class="btn btn-success" id="edit-education" data-toggle="modal"
                    data-id="{{ $education->id }}">Edit </a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a id="delete-education" data-id="{{ $education->id }}" class="btn btn-danger delete-user">Delete</a>
        </td>
        </form>
        </td>
    </tr>
    @endforeach

</table>
{!! $educations->links() !!}
<!-- Add and Edit customer modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="educationCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="eduForm" action="{{ route('educations.store') }}" method="POST">
                    <input type="hidden" name="edu_id" id="edu_id">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Sekolah:</strong>
                                <input type="text" name="sekolah" id="sekolah" class="form-control"
                                    placeholder="Sekolah" onchange="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Jurusan:</strong>
                                <input type="text" name="jurusan" id="jurusan" class="form-control"
                                    placeholder="jurusan" onchange="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tahun Masuk:</strong>
                                <input type="text" name="tahun_masuk" id="tahun_masuk" class="form-control"
                                    placeholder="tahun_masuk" onchange="validate()" onkeypress="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tahun Lulus:</strong>
                                <input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control"
                                    placeholder="tahun_lulus" onchange="validate()" onkeypress="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Submit</button>
                            <a href="{{ route('educations.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Show customer modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="educationCrudModal-show"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2"></div>
                    <div class="col-xs-10 col-sm-10 col-md-10 ">
                        @if(isset($education->sekolah))

                        <table>
                            <tr>
                                <td><strong>Sekolah:</strong></td>
                                <td>{{$education->sekolah}}</td>
                            </tr>
                            <tr>
                                <td><strong>jurusan:</strong></td>
                                <td>{{$education->jurusan}}</td>
                            </tr>
                            <tr>
                                <td><strong>tahun_masuk:</strong></td>
                                <td>{{$education->tahun_masuk}}</td>
                            </tr>
                            <tr>
                                <td><strong>tahun_lulus:</strong></td>
                                <td>{{$education->tahun_lulus}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: right "><a href="{{ route('educations.index') }}"
                                        class="btn btn-danger">OK</a> </td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <h2>Pengalaman Kerja</h2>
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-experience" data-toggle="modal">New
                Experience</a>
        </div>
    </div>
</div>
<br />
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Perusahaan</th>
        <th>Jabatan</th>
        <th>Tahun</th>
        <th width="280px">Action</th>
    </tr>

    @foreach ($experiences as $experience)
    <tr id="experience_id_{{ $experience->id }}">
        <td>{{ $experience->id }}</td>
        <td>{{ $experience->perusahaan }}</td>
        <td>{{ $experience->jabatan }}</td>
        <td>{{ $experience->tahun }}</td>
        <td>
            <form action="{{ route('experiences.destroy',$experience->id) }}" method="POST">
                <a href="javascript:void(0)" class="btn btn-success" id="edit-experience" data-toggle="modal"
                    data-id="{{ $experience->id }}">Edit </a>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <a id="delete-experience" data-id="{{ $experience->id }}" class="btn btn-danger delete-user">Delete</a>
        </td>
        </form>
        </td>
    </tr>
    @endforeach

</table>
{!! $experiences->links() !!}
<!-- Add and Edit customer modal -->
<div class="modal fade" id="crud-modal-experience" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="experienceCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="expForm" action="{{ route('experiences.store') }}" method="POST">
                    <input type="hidden" name="exp_id" id="exp_id">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Perusahaan:</strong>
                                <input type="text" name="perusahaan" id="perusahaan" class="form-control"
                                    placeholder="perusahaan" onchange="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Jabatan:</strong>
                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                    placeholder="jabatan" onchange="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Tahun</strong>
                                <input type="text" name="tahun" id="tahun" class="form-control" placeholder="tahun"
                                    onchange="validate()" onkeypress="validate()" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Submit</button>
                            <a href="{{ route('educations.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Show customer modal -->
<div class="modal fade" id="crud-modal-show-experience" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="experienceCrudModal-show"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2"></div>
                    <div class="col-xs-10 col-sm-10 col-md-10 ">
                        @if(isset($experience->perusahaan))

                        <table>
                            <tr>
                                <td><strong>Perusahaan:</strong></td>
                                <td>{{$experience->perusahaan}}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan:</strong></td>
                                <td>{{$experience->jabatan}}</td>
                            </tr>
                            <tr>
                                <td><strong>Tahun:</strong></td>
                                <td>{{$experience->tahun}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: right "><a href="{{ route('educations.index') }}"
                                        class="btn btn-danger">OK</a> </td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    error = false

    function validate() {
        if (document.eduForm.name.value != '' && document.eduForm.email.value != '' && document.eduForm.address
            .value != '')
            document.eduForm.btnsave.disabled = false
        else
            document.eduForm.btnsave.disabled = true
    }

    function validate() {
        if (document.expForm.name.value != '' && document.expForm.email.value != '' && document.expForm.address
            .value != '')
            document.expForm.btnsave.disabled = false
        else
            document.expForm.btnsave.disabled = true
    }

</script>
