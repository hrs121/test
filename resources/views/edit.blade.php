<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
            @if ($errors->any())
                    <div class="alert alert-danger m-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <!--  -->
                @if(Session::has('msg'))
                <p class="alert alert-success mt-3">{{Session::get('msg')}}</p>
                @endif

                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    
                    <form action="{{url('/update/'.$editData->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$editData->name}}" class="form-control ">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{$editData->email}}" class="form-control ">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" name="designation" value="{{$editData->designation}}" class="form-control >
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="number" name="salary" value="{{$editData->salary}}" class="form-control >
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                        <label>District</label>
                        <select name="district" class="form-control" value="{{$editData->district}}">
                                <option value="district1" {{ $editData->district == 'district1' ? 'selected' : '' }}>District 1</option>
                                <option value="district2" {{ $editData->district == 'district2' ? 'selected' : '' }}>District 2</option>
                                <option value="district3" {{ $editData->district == 'district3' ? 'selected' : '' }}>District 3</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label>Upazila</label>
                        <select name="upazila" class="form-control" value="{{$editData->upazila}}">
                                <option value="district1" {{ $editData->upazila == 'district1' ? 'selected' : '' }}>District 1</option>
                                <option value="district2" {{ $editData->upazila == 'district2' ? 'selected' : '' }}>District 2</option>
                                <option value="district3" {{ $editData->upazila == 'district3' ? 'selected' : '' }}>District 3</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                        
                     <div class="form-group">
                            <label>Union</label>
                            <select name="union" class="form-control">
                                <option value="district1" {{ $editData->union == 'district1' ? 'selected' : '' }}>District 1</option>
                                <option value="district2" {{ $editData->union == 'district2' ? 'selected' : '' }}>District 2</option>
                                <option value="district3" {{ $editData->union == 'district3' ? 'selected' : '' }}>District 3</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>



                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="{{url('/')}}" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>