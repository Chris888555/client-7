@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
  
@endsection

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Codes</h1>

    <!-- Stats Section (Static data muna) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-500">Total Users</h2>
            <p class="text-2xl font-bold text-blue-600">1,204</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-500">Total Sales</h2>
            <p class="text-2xl font-bold text-green-600">₱350,000</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-sm font-semibold text-gray-500">New Signups</h2>
            <p class="text-2xl font-bold text-purple-600">58</p>
        </div>
    </div>

    <div class="row p-6">
        <div class="col-4">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Generate codes</h2>
                <hr>
                <div class="form-group mb-2">
                    <label for="">Select code type</label>
                    <select name="codetype" id="codetype" class="form-control">
                        <option value="none">--- Select ---</option>
                        @foreach ($types as $row)
                            <option value="{{ $row['recordid'] }}">{{ $row['codename'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                </div>
                <div class="form-group mb-2">
                    <label for="">Batch name</label>
                    <input type="text" class="form-control" id="batchname" name="batchname" placeholder="Enter batch name" value="-">
                </div>
                <div class="form-group mb-2">
                    <button class="form-control btn btn-md btn-success" id="btnGenerateCode">
                        Generate code
                    </button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Available codes</h2>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DATE CREATED</th>
                                <th>CODE ID</th>
                                <th>TYPE</th>
                                <th>CREATED BY</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($codes as $ctr => $value)
                                <tr>
                                    <td>{{ $ctr + 1 }}</td>
                                    <td>{{ date("F d, Y h:i A", strtotime($value['created_at'])) }}</td>
                                    <td>{{ $value['codeid'] }}</td>
                                    <td>{{ $value->codesettings->codename }}</td>
                                    <td>{{ $value['owner'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $("#btnGenerateCode").click(function(){
            $.post('/admin/code/generate', {
                codetype: $("#codetype").val(),
                batchname: $("#batchname").val(),
                quantity: $("#quantity").val()
            }, function(data){
                if(data.status){
                    success(data.msg)
                }else{
                    error(data.msg)
                }
            }, 'json');
        });
        
    });
</script>
@endsection