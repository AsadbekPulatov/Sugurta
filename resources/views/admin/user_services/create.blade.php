@extends('admin.master')
{{--@section('title', 'Бажарилган ишларни киритиш')--}}
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Sug'urta tuzish</h3>
                </div>
                <form method="post" action="{{route('user_services.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="service_id">Sug'urta:</label>
                            <select name="service_id" class="form-control" id="service_id" required
                                    onchange="add_items()">
                                <option value="">Sug'urtani tanlang:</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="dynamic_section">

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
                {{--                </div>--}}
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
@section('custom-scripts')
    <script>
        var services = @json($services);

        function add_items() {
            var id = $("#service_id").val();
            var details = services[id].details_list;
            details = details.split(", ");
            document.getElementById('dynamic_section').innerHTML = "";
            for (var i=0; i<details.length; i++)
            {
                var div = document.createElement('div');
                div.className = "dynamic_item";
                div.innerHTML = `
                         <div class="form-group">
                            <label for="`+details[i]+`">`+details[i].charAt(0).toUpperCase() + details[i].slice(1)+`:</label>
                            <input type="text" name="details[`+details[i]+`]" class="form-control" id="`+details[i]+`" required>
                        </div>
                           `;
                document.getElementById('dynamic_section').appendChild(div);
            }
        }
    </script>
@endsection
