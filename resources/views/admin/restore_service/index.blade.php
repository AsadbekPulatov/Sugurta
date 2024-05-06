@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Sug'urtani qoplab berish</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sug'urta</th>
                                <th>Jismoniy shaxs</th>
                                <th>Narxi</th>
                                <th>Rasm</th>
                                <th>Holati</th>
                                <th>Amallar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_services as $firm)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$firm->user_service->service->name}}</td>
                                    <td>{{$firm->user_service->user->surname." ".$firm->user_service->user->name}}</td>
                                    <td>{{number_format($firm->user_service->service->price, 0, ' ', ' ')}} so'm</td>
                                    <td>
                                        <img src="{{ asset('restore/'. $firm->image) }}" alt="">
                                    </td>
                                    <td>
                                        @if ($firm->status == 1)
                                            Tasdiqlandi.
                                        @endif
                                        @if ($firm->status == 0)
                                            <a href="{{ route('restore_service_status', $firm->id) }}">Tasdiqlash</a>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <form action="{{route('restore.delete', $firm->id)}}" method="get">
                                            <button type="submit" class="btn btn-danger show_confirm">Bekor qilish
                                            </button>
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
