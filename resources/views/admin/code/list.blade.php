@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .col {
        flex: 1;
        padding: 15px;
        box-sizing: border-box;
    }

    .col-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-4 {
        flex: 0 0 33.3333%;
        max-width: 33.3333%;
    }

    .col-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-8 {
        flex: 0 0 66.6667%;
        max-width: 66.6667%;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn {
        display: inline-block;
        font-weight: 500;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        background-color: #007bff;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
        text-decoration: none;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-md {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .mt-2 { margin-top: 0.5rem; }   /* ~8px */
    .mt-4 { margin-top: 1.5rem; }   /* ~24px */

    .mb-2 { margin-bottom: 0.5rem; } /* ~8px */
    .mb-4 { margin-bottom: 1.5rem; } /* ~24px */

    .p-2 { padding: 0.5rem; }   /* ~8px */
    .p-4 { padding: 1.5rem; }   /* ~24px */

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
        color: #212529;
        border: 1px solid #dee2e6;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border: 1px solid #dee2e6;
        text-align: left;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }





</style>    
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