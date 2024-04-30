@extends('admin.master')
@section('content')
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" style="font-size: x-large">Sug'urtalar</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div>
                                <a href="{{ route('services.create') }}" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Qo'shish
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomi</th>
                                    <th>Narxi</th>
                                    <th>Muddati</th>
                                    <th>Kerakli ma'lumotlar</th>
                                    <th>Amallar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $item)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->price}} so'm</td>
                                        <td>{{$item->deadline}} kun</td>
                                        <td>{{$item->details_list}}</td>
                                        <td class="d-flex">

                                            <a href="{{ route('services.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </a>


                                            <form action="{{route('services.destroy', $item->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger show_confirm"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.col-md-6 -->
        </div>
@endsection
