@extends('layouts.BaseLayout')
@section('container')

    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>Lecture Add Form</b></h3>
    </div>

    <form role="form" action="{{ route('lectures.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="file" name="filesArray[]" id="multipleDragDrop" multiple style="display: none;">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Lecture name</label>
                                    <input name="lecture_name" placeholder="Lecture Name" class="form-control">
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
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Start date</label>
                                    <input name="start_date" class="form-control" type="date" value="{{ now()->format('Y-m-d') }}">
                                </div>
                                <div style="display:flex; margin-top: 25px;">
                                    <input type="submit" value="Save" name="Save" class="btn btn-success" style="min-width: 100px; max-height: 35px;">
                                    <div style="display: block;">
                                        <div style="display: flex;margin: 0 0 15px 50px;">
                                            <a href="" class="btn btn-danger" id="resetFilesbtn" style="max-height: 35px;margin-right: 15px;">Reset files</a>
                                            <h3>Drag & Drop File List</h3>
                                        </div>
                                        <div id="filesSelected"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Lecture Description</label>
                                    <textarea style="min-height: 100px;" name="lecture_description" class="form-control" rows="3" placeholder="Lecture Description"></textarea>
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


    <script>
        var target = document.documentElement;
        var body = document.getElementById('page-content-wrapper');
        var fileInput = document.getElementById('multipleDragDrop');

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

            var fileInput = document.getElementById('multipleDragDrop');
            var fileList = document.getElementById('filesSelected');
            var resetBtn = document.getElementById('resetFilesbtn');

            resetBtn.addEventListener('click', function (e) {
                e.preventDefault();
                fileInput.value = '';
                fileList.innerHTML = '';
            });

            fileInput.addEventListener('change', function (e) {
                for (var i = 0, len = fileInput.files.length; i < len; i++) {
                    renderFileList(i, fileInput.files[i].name);
                }
            });

            renderFileList = function (index, fileName) {
            var btn = document.createElement("p");
                btn.setAttribute("id", fileName);
                btn.setAttribute("style", "margin:0 0 0 50px");
                fileList.appendChild(btn);
                document.getElementById(fileName).innerHTML =' '+ fileName;
            };

        })();
    </script>
@endsection
