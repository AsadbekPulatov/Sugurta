@extends('admin.master')
{{--@section('title', 'Фермерни таҳрирлаш')--}}
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Sug'urtani tahrirlash</h3>
                </div>
                <form method="post" action="{{route('services.update', $service->id)}}" id="form">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nomi:</label>
                            <input type="text" name="name" class="form-control" id="name" required value="{{ $service->name }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Narxi:</label>
                            <input type="text" name="price" class="form-control" id="price" required value="{{ $service->price }}">
                        </div>
                        <div class="form-group">
                            <label for="deadline">Muddati:</label>
                            <input type="text" name="deadline" class="form-control" id="deadline" required value="{{ $service->deadline }}">
                        </div>
                        <div class="form-group">
                            <label for="details_list">Kerakli ma'lumotlar:</label>
                            <textarea name="details_list" id="details_list" class="form-control" rows="3">{{ $service->details_list }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
