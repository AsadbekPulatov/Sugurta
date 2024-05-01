@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Sug'urta ma'lumotlari</h3>
                </div>
                <div class="card-body d-flex justify-content-around">
                    <div>
                        <h1 class="mb-2">Sug'urta tuzuvchi</h1>
                        <p>F.I.SH: {{ $userService->user->surname." ".$userService->user->name }}</p>
                        <p>Telefon raqami: {{ $userService->user->phone }}</p>
                        <p>Passport: {{ $userService->user->passport }}</p>
                    </div>

                    <div>
                        <h1 class="mb-2">Sug'urta</h1>
                        <?php
                        $deadline = \Carbon\Carbon::parse($userService->created_at)->addDays($userService->service->deadline)->format('d.m.Y');
                        ?>
                        <p>Nomi: {{ $userService->service->name }}</p>
                        <p>Ariza berilgan sana: {{date('d.m.Y', strtotime($userService->created_at))}}</p>
                        <p>Tugash sanasi: {{ $deadline }}</p>
                        <p>Narxi: {{number_format($userService->service->price, 0, ' ', ' ')}} so'm</p>
                    </div>

                    <div>
                        <h1 class="mb-2">Hujjatlar</h1>
                        @foreach(json_decode($userService->details) as $key => $item)
                            <p>{{ $key }}: {{ $item }}</p>
                        @endforeach

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
