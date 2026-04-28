@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline-dark btn-sm rounded-circle p-2">
                ←
            </a>
            <div>
                <h3 class="fw-bold mb-0">Edit Portfolio</h3>
                <p class="text-muted small mb-0">ID #{{ $portfolio->id }}</p>
            </div>
        </div>

        {{-- ERROR BIAR GA BUTA --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        @endif

        <div class="card p-4 shadow-sm">

            <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- FIX PALING PENTING --}}
                <input type="hidden" name="type" value="{{ $portfolio->type }}">

                {{-- IMAGE --}}
                <div class="mb-3 text-center">
                    <img id="preview" src="{{ asset('storage/'.$portfolio->image_path) }}" 
                        style="width:200px;height:200px;object-fit:cover;border-radius:10px;">

                    <input type="file" name="image_path" class="form-control mt-2" onchange="previewImage(event)">
                </div>

                {{-- TITLE --}}
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ old('title', $portfolio->title) }}" required>
                </div>

                {{-- DESC --}}
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description', $portfolio->description) }}</textarea>
                </div>

                {{-- CATEGORY --}}
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" 
                                {{ $portfolio->category_id == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FEATURED --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_featured" value="1" 
                        class="form-check-input"
                        {{ $portfolio->is_featured ? 'checked' : '' }}>
                    <label class="form-check-label">Featured</label>
                </div>

                <button type="submit" class="btn btn-dark w-100">
                    UPDATE
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(e){
    const reader = new FileReader();
    reader.onload = () => {
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}
</script>

@endsection