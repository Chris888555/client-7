@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Team</h1>

    <a href="/teams" class="btn btn-info btn-md mb-4">Team</a>
    <a href="/add-new-account" class="btn btn-info btn-md active mb-4">Add new account</a>

    @php
        $env = env('APP_ENV');

        $firstname = $env == 'local' ? 'Test' : '';
        $lastname = $env == 'local' ? 'Test' : '';
        $emailaddress = $env == 'local' ? 'Test@test.test' : '';
        $mobilephone = $env == 'local' ? '0995955555' : '';
        $username = $env == 'local' ? "main".$totalaccounts : '';
        $password = $env == 'local' ? '0000' : '';
        $code = "";
        if($env == 'local'){
            if(!empty($activationcode)){
                $code = $activationcode->codeid;
            }
        }

    
    @endphp

    <div class="bg-white shadow rounded-lg p-6">
        <form class="frmAddNewAccount row">
            <div class="form-group col-6 mb-4">
                <label  class="control-label"><strong>First name</strong></label>
                <input type="text" placeholder="Enter First Name" class="form-control" value="{{ $firstname }}" required id="firstname" name="firstname" />
            </div>
            <div class="form-group col-6 mb-4">
                <label  class="control-label"><strong>Last name</strong></label>
                <input type="text" placeholder="Enter last name" class="form-control" value="{{ $lastname }}" required id="lastname" name="lastname" />
            </div>
            <div class="form-group col-6 mb-4">
                <label  class="control-label"><strong>Email Address</strong></label><span><strong><a href="javascript:void(0)" style="font-size:10px" id="email-error"></a></strong></span>
                <input type="email" placeholder="Enter Email Address" class="form-control" value="{{ $emailaddress }}" required id="emailaddress" name="emailaddress"/>
            </div>
            <div class="form-group col-6 mb-4">
                <label  class="control-label"><strong>Mobile Number</strong></label><span><strong><a href="javascript:void(0)" style="font-size:10px" id="mobile-error"></a></strong></span>
                <input type="number" placeholder="Enter number" class="form-control" value="{{ $mobilephone }}" required id="mobilephone" name="mobilephone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" />
            </div>
            <div class="form-group col-6 mb-4">
                <label  class="control-label"><strong>Username</strong></label>
                <input type="text" placeholder="Username" value="{{ $username }}" required class="form-control" id="username" name="username" />
            </div>
            <div class="form-group col-6 mb-4">
                <label class="control-label"><strong>Password</strong></label>
                <input type="password" placeholder="Password" id="password" class="form-control" value="{{ $password }}" required name="password" />
            </div>
            <div class="form-group col-6 mb-4">
                <label class="control-label"><strong>Activation code</strong></label>
                <input type="text" placeholder="Enter activation code" name="codeid" id="codeid" class="form-control" value="{{ $code }}" required>
            </div>
            <div class="form-group col-6 mb-4">
                <label class="control-label"><strong>Position</strong></label>
                <select name="position" id="position" class="form-control" required>
                    <option value="L">Left</option>
                    <option value="R">Right</option>
                </select>
            </div>
            <div class="form-group col-6 mb-4">
                <label class="control-label"><strong>Sponsor ID</strong></label>
                <input type="text" placeholder="Enter your sponsor" id="sponsor" value="{{ session()->get('usersession') }}" class="form-control" required name="sponsor" />
            </div>
            <div class="form-group col-6 mb-4">
                <label  class="control-label"><strong>Upline ID</strong></label>
                <input type="text" name="upline" id="upline" class="form-control" required>
            </div>
            <div class="col-6 mb-4">
                <button type="submit" class="form-control btn btn-success">
                    <span class="fa fa-save"></span> Add new account
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function(){

        $('.frmAddNewAccount').submit(function(e){
            e.preventDefault();
            var frmData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "/user/addNewAccount",
                data: frmData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(){
                    loaderSwal()
                },success: function (data){
                    if(data.status){
                        success(data.msg);
                    }
                    else{
                        error(data.msg);
                    }
                }
            });
        });

    });
</script>
@endsection