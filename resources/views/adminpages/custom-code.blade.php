@extends('layouts.admin-layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('custom.code.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" id="title" class="form-control" name="code_file" value="">
                            <small class="text-muted">If uploading file, Then Don't add the Link.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" id="description" class="form-control" name="link" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Section</label>
                        <div class="col-sm-4">
                            <select id="fileSelect" class="form-control" name="for" required>
                                <option selected disabled>----Select a option----</option>
                                <option value="For Head Section">For Head Section</option>
                                <option value="For Footer Section">For Footer Section</option>
                            </select>
                        </div>

                        <label for="title" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-4">
                            <select id="fileSelect" class="form-control" name="type" required>
                                <option selected disabled>----Select a option----</option>
                                <option value="Stylesheet">Stylesheet</option>
                                <option value="JavaScript">JavaScript</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="page" value="home"
                                class="btn btn-gradient-success me-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>
        <div class="card">
            <div class="card-body"></div>
            <div class="table-responsive">
                <table class="table table-striped  ">
                    <thead>
                        <tr>
                            <th> Section </th>
                            <th> Type </th>
                            <th> Action </th>
                            <th> link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty(\App\Helpers\SiteviewHelper::customCode()))
                            @foreach (\App\Helpers\SiteviewHelper::customCode() as $link)
                                <tr>
                                    <td>{{ $link->for }}</td>
                                    <td>{{ $link->type }}</td>
                                    <td>
                                        <form action="{{ route('custom.code.delete', ['id' => $link->id]) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this link?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">Delete</button>
                                        </form>

                                    </td>
                                    <td>{{ $link->link }}</td>
                                </tr>
                            @endforeach
                        @else
                            <td></td>
                            <td></td>
                            <td>No files</td>
                            <td></td>
                            <td></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('custom.code.store') }}" method="post">
                    @csrf
                    <h5 class="card-title">CSS</h5>
                    <textarea name="css" class="form-control" rows="25" placeholder="Enter your custom CSS here...">{{App\Helpers\SiteviewHelper::getS3FileContent('clientside/js-css-other/custom.css')}}</textarea>
                    <div class="form-group row mt-3">
                        <div class="col-sm-10">
                            <button type="submit" name="action" value="save_css"
                                class="btn btn-gradient-success me-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('custom.code.store') }}" method="post">
                    @csrf
                    <h5 class="card-title">JS/JQuery</h5>
                    <textarea name="js" class="form-control" rows="25"
                        placeholder="Enter your custom JavaScript/Jquery here...">{{App\Helpers\SiteviewHelper::getS3FileContent('clientside/js-css-other/custom.js')}}</textarea>

                    <div class="form-group row mt-3">
                        <div class="col-sm-10">
                            <button type="submit" name="action" value="save_js"
                                class="btn btn-gradient-success me-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </form>
    </div>
@stop
