@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Sug'urta qo'shish</h3>
                </div>
                <form method="post" action="{{route('services.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nomi:</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Narxi:</label>
                            <input type="text" name="price" class="form-control" id="price" required>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Muddati:</label>
                            <input type="text" name="deadline" class="form-control" id="deadline" required>
                        </div>
                        <div class="form-group">
                            <label for="details_list">Kerakli ma'lumotlar:</label>
                            <textarea name="details_list" id="details_list" class="form-control" rows="3"></textarea>
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
