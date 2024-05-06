@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Tuzilgan sug'urtalar</h3>
                </div>
                <div class="modal fade" id="modal-create">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Filter</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="get" action="{{ route('list_user_service_all') }}" id="form">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="from_date">Sanadan:</label>
                                            <input type="date" name="from_date" class="form-control" id="from_date"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="to_date">Sanagacha:</label>
                                            <input type="date" name="to_date" class="form-control" id="to_date"
                                                   required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Bekor
                                            qilish
                                        </button>
                                        <button type="submit" class="btn btn-primary">Saqlash</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <button type="button" class="ml-3 btn btn-info" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sug'urta</th>
                                <th>Jismoniy shaxs</th>
                                <th>Narxi</th>
                                <th>Ariza berilgan sana</th>
                                <th>Tugash sana</th>
                                <th>Holati</th>
                                <th>Amallar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_services as $firm)
                                <?php
                                $deadline = \Carbon\Carbon::parse($firm->created_at)->addDays($firm->service->deadline)->format('d.m.Y');
                                $now = \Carbon\Carbon::now()->format('d.m.Y');
                                ?>
                                <tr @if(strtotime($now) < strtotime($deadline)) class="bg-lime"
                                    @else class="bg-warning" @endif>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$firm->service->name}}</td>
                                    <td>{{$firm->user->surname." ".$firm->user->name}}</td>
                                    <td>{{number_format($firm->service->price, 0, ' ', ' ')}} so'm</td>
                                    <td>
                                        {{date('d.m.Y', strtotime($firm->created_at))}}
                                    </td>
                                    <td>
                                        {{ $deadline }}
                                    </td>
                                    <td>
                                        @if ($firm->status == "2")
                                            Qoplab beriladi.
                                        @endif
                                        @if ($firm->status == 1)
                                            Tasdiqlandi.
                                        @endif
                                        @if ($firm->status == 0)
                                            Kutilmoqda.
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">

                                        <a href="{{ route('user_services.show', $firm->id) }}" class="btn btn-info">
                                            Ma'lumotlarni ko'rish
                                        </a>

                                        @if ($firm->status == 0)
                                            <a href="{{ route('user_service_status', $firm->id) }}" class="btn btn-warning">
                                                Tasdiqlash
                                            </a>
                                        @endif

                                        <form action="{{route('user_services.destroy', $firm->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger show_confirm">Bekor qilish</button>
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
