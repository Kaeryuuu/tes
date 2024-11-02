@extends('dashboard')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-edit"></i> Edit Booking
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i> Form Edit Booking
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bookings.update', $bookings->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="class">Kelas</label>
                                        <input type="text" id="class" name="class" value="{{ old('class', $bookings->class) }}" class="form-control @error('class') is-invalid @enderror" placeholder="Masukkan Kelas" required>
                                        @error('class')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Harga</label>
                                        <input type="number" id="price" step="0.01" name="price" value="{{ old('price', $bookings->price) }}" class="form-control @error('price') is-invalid @enderror" placeholder="Masukkan Harga" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="book_id">Pilih Buku</label>
                                <select id="book_id" name="book_id" class="form-control @error('book_id') is-invalid @enderror" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ $book->id == $bookings->book_id ? 'selected' : '' }}>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
