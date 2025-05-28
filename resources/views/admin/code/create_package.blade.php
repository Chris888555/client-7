@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <x-page-header-text title="Codes" />

  <div class="flex flex-col lg:flex-row gap-6  bg-gray-100 min-h-screen">
  <!-- Left column - fixed smaller width -->
  <div class="flex-shrink-0 basis-1/4 max-w-sm">
    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Add new package</h2>
      <hr class="mb-4">
        <form method="POST" class="frmAddNewPackage mb-4">
            <div class="mb-4">
                <label for="codetype" class="block text-sm font-medium text-gray-700">Code Type</label>
                <input type="text" id="codetype" name="codetype" required value="P1" class="form-control">
            </div>
            <div class="mb-4">
                <label for="codename" class="block text-sm font-medium text-gray-700">Code Name</label>
                <input type="text" id="codename" name="codename" required value="Standard Package" class="form-control">
            </div>
            <div class="mb-4">
                <label for="prefix" class="block text-sm font-medium text-gray-700">Prefix</label>
                <input type="text" id="prefix" name="prefix" required value="P1" class="form-control">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" step="0.01" required value="1999" class="form-control">
            </div>
            <div class="mb-4">
                <label for="dr" class="block text-sm font-medium text-gray-700">DR</label>
                <input type="text" id="dr" name="dr" required value="200" class="form-control">
            </div>
            <div class="mb-4">
                <label for="pairing" class="block text-sm font-medium text-gray-700">Pairing</label>
                <input type="text" id="pairing" name="pairing" required value="300" class="form-control">
            </div>
            <div class="mb-4">
                <label for="pairing" class="block text-sm font-medium text-gray-700">infinity</label>
                <input type="text" id="infinity" name="infinity" required value="50" class="form-control">
            </div>
            <div class="mb-4">
                <label for="pv" class="block text-sm font-medium text-gray-700">PV</label>
                <input type="text" id="pv" name="pv" required value="30" class="form-control">
            </div>
            <div class="mb-4">
                <label for="dropshippercent" class="block text-sm font-medium text-gray-700">Dropship Percent</label>
                <input type="text" id="dropshippercent" name="dropshippercent" step="0.01" required value="0.25" class="form-control">
            </div>
            <div class="mb-4">
                <label for="rebatepercent" class="block text-sm font-medium text-gray-700">Rebate Percent</label>
                <input type="text" id="rebatepercent" name="rebatepercent" step="0.01" required value="0.25" class="form-control">
            </div>
            <div class="mb-4">
                <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                <input type="text" id="month" name="month" required value="3" class="form-control">
            </div>
            <div class="mb-4">
                <label for="maxcycles" class="block text-sm font-medium text-gray-700">Max Cycles</label>
                <input type="text" id="maxcycles" name="maxcycles" required value="14" class="form-control">
            </div>
            <div class="mb-4">
                <label for="lvlunilvl" class="block text-sm font-medium text-gray-700">Level Unilevel</label>
                <input type="text" id="lvlunilvl" name="lvlunilvl" required value="10" class="form-control">
            </div>
            <div class="mb-4">
                <label for="funnel" class="block text-sm font-medium text-gray-700">Funnel</label>
                <select name="funnel" id="funnel" required class="form-control">
                    <option value="basic">Basic</option>
                    <option value="builder">Builder</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="store" class="block text-sm font-medium text-gray-700">Store</label>
                <select name="store" id="store" required class="form-control">
                    <option value="basic">Basic</option>
                    <option value="builder">Builder</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-150">Create new package</button>
        </form method="POST">
    </div>
  </div>

  <!-- Right column - flexible -->
  <div class="flex-1">
    <div class="bg-white shadow rounded-lg p-6 flex flex-col">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Packages</h2>
      <hr class="mb-4">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date Created</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($types as $ctr => $value)
            <tr>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $ctr + 1 }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ date("F d, Y h:i A", strtotime($value['created_at'])) }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $value['codename'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $value['prefix'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">&#8369; {{ number_format($value['price'], 2) }}</td>
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

        $(".frmAddNewPackage").submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/admin/code/createPackage",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    loaderSwal();
                },
                success: function(data) {
                    if (data.status) {
                        success(data.msg);
                    } else {
                        error(data.msg);
                    }
                },
            });
        });

    });
</script>
@endsection
