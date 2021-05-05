@extends('layouts.app')

@section('content')
<div class="row chat-row">

    <div class="col-md-3">
        <div class="users">
        <h1>Users</h1>

        <ul class="list-group list-chart-item">
            @if($users->count())
                @foreach($users as $user)
                    <li class="chat-user-list">
                        <a href="{{ route('message.conversation', $user->id) }}">
                            <div class="chat-image">
                               {!!  makeImageFromName($user->name) !!}
                               <i class="fa fa circle user-status-icon user-icon-{{$user->id}}" title="away"></i>

                            </div>
                            <div class="chat-name font-weight-bold">
                                {{$user->name}}
                            </div>
                        </a>
                    </li>        
                @endforeach
            @endif     
        </ul>
        
        </div>
    
    </div>

    <div class="col-md-9">
   <h1>
       Message Section
    </h1>

   <p class="lead">
       Select Users from the list to begin Conversation
   </p>
    </div>

</div>
@endsection

@push('scripts')

    <script>
        $(function (){
            let user_id = "{{ auth()->user()->id}}";
            let ip_address = 'http://127.0.0.1';
            let socket_port = '8005';
            let socket = io(ip_address + + socket_port);
            

            socket.on('connect', function(){
               alert("here")
                socket.emit('user_connected', user_id);
            });

            socket.on('UpdateUserStatus', (data) => {
                $.each(data, function(key, val) {
                    if(val !== null && val !== 0) {
                        console.log(key);
                        let userIcon = $(".user-icon"+key);
                        $userIcon.addClass('test succes');
                        $userIcon.attr('test', 'online')
                    }
                });
            });

        });
    </script>

@endpush