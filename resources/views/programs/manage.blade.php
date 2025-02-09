@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Gérer la Filière: {{ $program->name }}</h2>
        
        <form action="{{ route('admin.filieres.update', $program->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="universities">Modifier les Universités Associées</label>
                <select name="universities[]" id="universities" class="form-control" multiple>
                    @foreach ($universities as $university)
                        <option value="{{ $university->id }}" 
                            @if($program->universities->contains($university->id)) selected @endif>
                            {{ $university->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="mt-3 btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
