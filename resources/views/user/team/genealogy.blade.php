@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Team</h1>

    <a href="/teams" class="btn btn-info btn-md mb-4">Team</a>
    <a href="/genealogy" class="btn btn-info btn-md mb-4 active">Genealogy</a>
    <input type="hidden" value="{{ $head_node->binnode}}" id="head_node">
    <!-- Recent Members Table (Static content) -->
    <div class="bg-white shadow rounded-lg p-6" style="background-color: #09adb6 !important;">
        <div class="row">
            <div class="col-12 mb-4">
                <table class="w-100">
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
                                @if(!empty(session()->get('node')))
                                    @if(session()->get('node') == session()->get('usersession'))
        
                                    @else
                                    <a href="javascript:void(0)" style="color:white" id="headnode" data-pos="T" data-node="{{ (!empty($node_1->username)) ? $node_1->binnode : '' }}" data-username="{{ (!empty($node_1->username)) ? $node_1->username : '' }}"><i class="fa fa-arrow-up"></i></a>
                                    @endif
                                @else
        
                                @endif
                                <a href="javascript:void(0)" id="view" data-pos="T" data-node="{{ (!empty($node_1->username)) ? $node_1->binnode : '' }}" data-username="{{ (!empty($node_1->username)) ? $node_1->username : '' }}">
                                    @if(!empty($node_1->username))
                                        <center><img src="{{ asset('images/'.$node_1->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                    <h6 class="mb-0 text-warning">{{ (!empty($node_1->username)) ? $node_1->username : '' }}</h6>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">
                                <img src="{{asset('images/treeline_1-white.png')}}" width="100%">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <a href="javascript:void(0)" id="view" data-pos="L" data-node="{{ (!empty($node_2->username)) ? $node_2->binnode : '' }}" data-username="{{ (!empty($node_2->username)) ? $node_2->username : '' }}">
                                    @if(!empty($node_2->username))
                                        <center><img src="{{ asset('images/'.$node_2->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                        <h6 class="mb-0 text-warning">{{ (!empty($node_2->username)) ? $node_2->username : '' }}</h6>
                                </a>
                            </td>
                            <td colspan="2" class="text-center">
                                <a href="javascript:void(0)" id="view" data-pos="R" data-node="{{ (!empty($node_3->username)) ? $node_3->binnode : '' }}" data-username="{{ (!empty($node_3->username)) ? $node_3->username : '' }}">
                                    @if(!empty($node_3->username))
                                        <center><img src="{{ asset('images/'.$node_3->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                    <h6 class="mb-0 text-warning">{{ (!empty($node_3->username)) ? $node_3->username : '' }}</h6>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center">
                                <img src="{{asset('images/treeline_2-white.png')}}" width="100%">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%;" class="text-center">
                                <a href="javascript:void(0)" id="nextnode" data-pos="L.L" data-node="{{ (!empty($node_5->username)) ? $node_5->binnode : '' }}" data-username="{{ (!empty($node_5->username)) ? $node_5->username : '' }}">
                                    @if(!empty($node_5->username))
                                        <center><img src="{{ asset('images/'.$node_4->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                    <h6 class="mb-0 text-warning">{{ (!empty($node_5->username)) ? $node_5->username : '' }}</h6>
                                </a>
                            </td>
                            <td style="width:25%;" class="text-center">
                                <a href="javascript:void(0)" id="nextnode" data-pos="L.R" data-node="{{ (!empty($node_4->username)) ? $node_4->binnode : '' }}" data-username="{{ (!empty($node_4->username)) ? $node_4->username : '' }}">
                                    @if(!empty($node_4->username))
                                        <center><img src="{{ asset('images/'.$node_4->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                    <h6 class="mb-0 text-warning">{{ (!empty($node_4->username)) ? $node_4->username : '' }}</h6>
                                </a>
                            </td>
                            <td style="width:25%;" class="text-center">
                                <a href="javascript:void(0)" id="nextnode" data-pos="R.L" data-node="{{ (!empty($node_6->username)) ? $node_6->binnode : '' }}" data-username="{{ (!empty($node_6->username)) ? $node_6->username : '' }}">
                                    @if(!empty($node_6->username))
                                        <center><img src="{{ asset('images/'.$node_6->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                    <h6 class="mb-0 text-warning">{{ (!empty($node_6->username)) ? $node_6->username : '' }}</h6>
                                </a>
                            </td>
                            <td style="width:25%;" class="text-center">
                                <a href="javascript:void(0)" id="nextnode" data-pos="R.R" data-node="{{ (!empty($node_7->username)) ? $node_7->binnode : '' }}" data-username="{{ (!empty($node_7->username)) ? $node_7->username : '' }}">
                                    @if(!empty($node_7->username))
                                        <center><img src="{{ asset('images/'.$node_7->codes->codesettings->codename.'.png') }}" style="width:50px"></center>
                                    @else
                                        <center><img src="{{ asset('images/networkuser.png') }}" style="width:50px"></center>
                                    @endif
                                    <h6 class="mb-0 text-warning">{{ (!empty($node_7->username)) ? $node_7->username : '' }}</h6>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <h4 class="box-title">NODE DETAILS <small> <i>Click a node to view the details</i> </small></h4><br>
                <div id="notedetails" style="padding: 10px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function(){

        var pos = "";
    	var head_node = $('#head_node').val();

		$(document).on('click','#headnode',function(){
			$.post('/user/account/headnode',{
				username: $(this).data('username')
			},function(data){
				if(data == "success"){
					location.reload();
				}
			});
		});

		$(document).on('click','#topnode',function(){
			$.post('/user/account/resetnode',function(data){
				if(data == "success"){
					location.reload();
				}
			});
		});

		$(document).on('click','#view',function(event){
			event.preventDefault();
			$.post('/user/account/addAccountHere',{
			// $.post('/user/account/genealogyacc',{
				username: $(this).data('username'),
                head_node: $('#head_node').val(),
				position: $(this).data('pos')
			},function(data){
				// $('#notedetails').html(data.data)
                if(data.status){
                    // window.location.href = `/add-new-account/${data.pos}/${data.upline}`;
                    //Double request
				}
				else{
					error(data.msg)
				}
			},'json');
		});

		$(document).on('click','#addcustomer',function(){
			$.post('/user/account/CheckAddCustomer',{
				head_node: $('#head_node').val(),
				position: $(this).data('pos')
			},function(data){
				if(data.status){
                    window.location.href = `/add-new-account/${data.pos}/${data.upline}`;
				}
				else{
					error(data.msg)
				}
			}, 'json');
		});

		$(document).on('click','#nextnode',function(){
			$.post('/user/account/nextnode',{
				username: $(this).data('username'),
				position: $(this).data('pos')
			},function(data){
				if(data == "success"){
					location.reload();
				}else{
					$('#notedetails').html(data)
				}
			});
		});

    });
</script>
@endsection