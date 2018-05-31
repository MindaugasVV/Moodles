@extends('layouts.BaseLayout')
@section('container')

    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>Message Edit Form</b></h3>
    </div>

    <form role="form" action="{{ route('messages.update', $message_id) }}" method="post">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Group name</label>
                                    <select v-on:change="onChangeList" name="group_id" class="form-control">
                                        <option value="0">None</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('group_id'))
                                        @foreach ($errors->get('group_id') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Recipient name</label>
                                    <select name="recipient_id" class="form-control">
                                        <option value="0">To All</option>
                                        <option v-for="Student in Students" :value="Student.id">@{{ Student.name }}</option>
                                    </select>
                                </div>
                                <input type="submit" value="Save" name="Save" class="btn btn-success">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message_text" class="form-control" rows="3" placeholder="Message Text"></textarea>
                                    @if($errors->has('message_text'))
                                        @foreach ($errors->get('message_text') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </form>

@endsection
