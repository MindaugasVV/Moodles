@extends('layouts.BaseLayout')
@section('container')

    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>Lecture Edit Form</b></h3>
    </div>

    <form role="form" action="{{ route('lectures.update', $lecture->id) }}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')

        <input type="file" name="filesArray[]" id="multipleDragDrop" multiple style="display: none;">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Lecture name</label>
                                    <input name="lecture_name" placeholder="Lecture Name" class="form-control" value="{{ $lecture->lecture_name }}">
                                    @if($errors->has('lecture_name'))
                                        @foreach ($errors->get('lecture_name') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Group name</label>
                                    <select name="group_id" class="form-control">
                                        <option value="0">None</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" @if($group->id == $lecture->group->id){{'selected'}}@endif>{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Start date</label>
                                    <input name="start_date" class="form-control" type="date" value="{{ Carbon\Carbon::parse($lecture->start_date)->format('Y-m-d') }}">
                                </div>
                                <div style="display:flex; margin-top: 25px;">
                                    <input type="submit" value="Save" name="Save" class="btn btn-success" style="min-width: 100px; max-height: 35px;">
                                    <div style="display: block;">
                                        <h3 style="margin: 0 0 15px 50px;">Existing Files List</h3>
                                        <div>
                                            @foreach($lecture->Files as $file)
                                                <div style="display:flex;justify-content:space-between;margin-bottom:5px;">
                                                    <p style="margin: 0 0 0 50px;">{{ $file->file_name }}</p>
                                                    <a href="{{ route('removeFile', $file->id) }}" class="btn btn-danger" style="padding:0 5px;margin-left:10px;">Delete</a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div style="display: block;">
                                            <div style="display: flex;margin: 0 0 15px 50px;">
                                                <a href="" class="btn btn-danger" id="resetFilesbtn" style="max-height: 35px;margin-right: 15px;">Reset files</a>
                                                <h3>Drag & Drop File List</h3>
                                            </div>
                                            <div id="filesSelected"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Lecture Description</label>
                                    <textarea style="min-height: 100px;" name="lecture_description" class="form-control" rows="3" placeholder="Lecture Description">{{ $lecture->lecture_description }}</textarea>
                                    @if($errors->has('lecture_description'))
                                        @foreach ($errors->get('lecture_description') as $error)
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


@section('footer_js')
    <script>
        let target = document.documentElement;
        let body = document.getElementById('page-content-wrapper');
        let fileInput = document.getElementById('multipleDragDrop');

        target.addEventListener('dragover', function (e) {
            e.preventDefault();
            body.classList.add('dragging');
        });

        target.addEventListener('dragleave', function (e) {
            body.classList.remove('dragging');
        });

        target.addEventListener('drop', function (e) {
            e.preventDefault();
            body.classList.remove('dragging');
            fileInput.files = e.dataTransfer.files;
        });
    </script>

    <script>
        (function () {

            let fileInput = document.getElementById('multipleDragDrop');
            let fileList = document.getElementById('filesSelected');
            let resetBtn = document.getElementById('resetFilesbtn');

            resetBtn.addEventListener('click', function (e) {
                e.preventDefault();
                fileInput.value = '';
                fileList.innerHTML = '';
            });

            fileInput.addEventListener('change', function (e) {
                for (let i = 0, len = fileInput.files.length; i < len; i++) {
                    renderFileList(i, fileInput.files[i].name);
                }
            });

            renderFileList = function (index, fileName) {
                let k = document.createElement("p");
                k.setAttribute("id", fileName);
                k.setAttribute("style", "margin:0 0 0 50px");
                fileList.appendChild(k);
                document.getElementById(fileName).innerHTML =' '+ fileName;
            };

        })();
    </script>
@endsection