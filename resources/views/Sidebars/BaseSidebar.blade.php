<div id="sidebar-wrapper">
    <ul class="sidebar-nav">

        @if(Auth::user()->type == 2)
            <li class="sidebar-brand">
                <h3 style="color: #ffffff; line-height: inherit; margin: 0;">
                    Admin Panel
                </h3>
                <hr style="margin:0; color:#ffffff; border: 0.1vh solid;">
            </li>
            <li @if(isset($activeTab) && $activeTab == 'courses'){{'class=bg-dark'}}@endif >
                <a href="{{ route('courses.index') }}">Courses</a>
            </li>
            <li @if(isset($activeTab) && $activeTab == 'groups'){{'class=bg-dark'}}@endif >
                <a href="{{ route('groups.index') }}">Groups</a>
            </li>
            <li @if(isset($activeTab) && $activeTab == 'lectures'){{'class=bg-dark'}}@endif >
                <a href="{{ route('lectures.index') }}">Lectures</a>
            </li>
            <li @if(isset($activeTab) && $activeTab == 'messages'){{'class=bg-dark'}}@endif >
                <a href="{{ route('messages.index') }}">Messages</a>
            </li>
            <li @if(isset($activeTab) && $activeTab == 'users'){{'class=bg-dark'}}@endif >
                <a href="{{ route('users.index') }}">Users</a>
            </li>
        @endif

        @if(Auth::user()->type == 1)
            <li class="sidebar-brand">
                <h3 style="color: #ffffff; line-height: inherit; margin: 0;">
                    My Groups
                </h3>
                <hr style="margin:0; color:#ffffff; border: 0.5px solid">
            </li>
            @foreach($groups as $group)
                <li @if(isset($activeTab) && $activeTab == $group->id){{'class=bg-dark'}}@endif>
                    <a href="{{ route('showLectures', $group->id) }}">{{ $group->group_name }}</a>
                </li>
            @endforeach
                <hr style="margin:0; color:#ffffff; border: 0.5px solid">
                <li class="sidebar-brand">
                    <h3 style="color: #ffffff; line-height: inherit; margin: 0;">
                        Messages
                    </h3>
                    <hr style="margin:0; color:#ffffff; border: 0.5px solid">
                </li>
                <li @if(isset($activeTab) && $activeTab == 'showMessages'){{'class=bg-dark'}}@endif>
                    <a href="{{ route('showMessages') }}" style="color:white;">All Messages</a>
                </li>
            @foreach($side_messages as $message)
                <li @if(isset($activeTab) && $activeTab == $message->id){{'class=bg-dark'}}@endif>
                    <a href="{{ route('showMessage', $message->id) }}">{{ Carbon\Carbon::parse($message->created_at)->format('Y-m-d') }} @if( Carbon\Carbon::parse($message->created_at)->isToday()) <span style="padding-left: 40px; color:red;">Today</span> <i class="fa fa-warning fa_custom"></i> @endif</a>
                </li>
            @endforeach
        @endif
    </ul>
</div>