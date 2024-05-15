@extends('layouts.app')
@section('candidate', 'active')

@section('title', 'Admin - Tambah Candidate')
@section('content')
<div class="container-fluid">
    <!-- Approach -->
    <div class="row">
        <div>
            <a href="{{ route('adminCandidate') }}"><i class="fas fa-long-arrow-alt-left" style="margin-right: 5px;"></i>Back</a>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Candidate</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adminCandidateStore') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Election</label>
                            <select id="election_id" name="election_id" class="form-select @error('election_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($election as $list)
                                    <option value="{{ $list->id }}" data-gender="{{ $list->gender }}" {{ old('election_id') == $list->id ? 'selected' : '' }}>{{ $list->name }}</option>
                                @endforeach
                            </select>
                            @error('election_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Candidate</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Candidate">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select id="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="laki_laki" {{ old('gender') == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <input type="hidden" id="hidden_gender" name="gender" value="{{ old('gender') }}">
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Unggah Foto</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                            <small style="color: red; margin-top: 5px; display: block;">*Ukuran photo akan menjadi 3x4</small>
                            <small style="color: red; display: block;">*Ukuran photo maksimal 2 MB</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Visi Misi</label>
                            <textarea type="text" name="visi_misi" class="form-control @error('visi_misi') is-invalid @enderror" placeholder="visi-misi" rows="5" cols="50">{{ old('visi_misi') }}</textarea>
                            @error('visi_misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save" style="margin-right: 5px;"></i>Tambah</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const electionSelect = document.getElementById('election_id');
        const genderSelect = document.getElementById('gender');
        const hiddenGenderInput = document.getElementById('hidden_gender');

        function setGender() {
            const selectedOption = electionSelect.options[electionSelect.selectedIndex];
            const gender = selectedOption.getAttribute('data-gender');

            if (gender) {
                genderSelect.value = gender;
                hiddenGenderInput.value = gender;
                genderSelect.disabled = true;
            } else {
                genderSelect.disabled = false;
                genderSelect.value = '';
                hiddenGenderInput.value = '';
            }
        }

        setGender();

        electionSelect.addEventListener('change', setGender);
    });
</script>
@endsection