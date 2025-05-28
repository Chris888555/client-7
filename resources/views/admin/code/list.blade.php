@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <x-page-header-text title="Codes" />

    <!-- <a href="/admin/codes" class="btn btn-info btn-md mb-4">Team</a>
    <a href="/admin/codes/create-package" class="btn btn-info btn-md active mb-4">Create Package</a> -->

  <div class="flex flex-col lg:flex-row gap-6  bg-gray-100 min-h-screen">
  <!-- Left column - fixed smaller width -->
  <div class="flex-shrink-0 basis-1/4 max-w-sm">
    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Generate codes</h2>
      <hr class="mb-4">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Select code type</label>
        <select name="codetype" id="codetype" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="none">--- Select ---</option>
          @foreach ($types as $row)
          <option value="{{ $row['recordid'] }}">{{ $row['codename'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
        <input type="number" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" id="quantity" name="quantity" placeholder="Enter quantity">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Batch name</label>
        <input type="text" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" id="batchname" name="batchname" placeholder="Enter batch name" value="-">
      </div>
      <div>
        <button class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-150" id="btnGenerateCode">
          Generate code
        </button>
      </div>
    </div>
  </div>

  <!-- Right column - flexible -->
  <div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Available codes</h2>
      <hr class="mb-4">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date Created</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Code ID</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created By</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($codes as $ctr => $value)
            <tr>
              <td class="px-4 py-2 text-sm text-gray-700">{{ $ctr + 1 }}</td>
              <td class="px-4 py-2 text-sm text-gray-700">{{ date("F d, Y h:i A", strtotime($value['created_at'])) }}</td>
              <td class="px-4 py-2 text-sm text-gray-700">{{ $value['codeid'] }}</td>
              <td class="px-4 py-2 text-sm text-gray-700">{{ $value->codesettings->codename }}</td>
              <td class="px-4 py-2 text-sm text-gray-700">{{ $value['owner'] }}</td>
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
    $(document).ready(function () {
        $("#btnGenerateCode").click(function () {
            $.post('/admin/code/generate', {
                codetype: $("#codetype").val(),
                batchname: $("#batchname").val(),
                quantity: $("#quantity").val()
            }, function (data) {
                if (data.status) {
                    success(data.msg)
                } else {
                    error(data.msg)
                }
            }, 'json');
        });
    });
</script>
@endsection
