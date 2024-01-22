<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .wrapper {
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

                @if(Session::has('msg'))
                    <p class="alert alert-success mt-3">{{Session::get('msg')}}</p>
                @endif

                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add an employee record to the database.</p>

                    <form action="{{url('/send')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <!-- New section for email -->
                        <div class="form-group" id="emailSection">
                            <label>Emails</label>
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <!-- New section for phone numbers -->
                        <div class="form-group" id="phoneNumbersSection">
                            <label>Phone Numbers</label>
                            <div class="input-group mb-3">
                                <input type="number" name="phone_numbers[]" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="addPhoneNumber()">Add</button>
                                    <button class="btn btn-outline-secondary" type="button" onclick="removePhoneNumber(this)">Delete</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Designation</label>
                            <input type="text" name="designation" class="form-control">
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Salary</label>
                            <input type="number" name="salary" class="form-control">
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>District</label>
                            <select name="district" id="district" class="form-control" onchange="updateUpazila()">
                                <!-- Populate districts from the database -->
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Upazila</label>
                            <select name="upazila" id="upazila" class="form-control">
                                <!-- Options will be populated dynamically using JavaScript -->
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Union</label>
                            <select name="union" class="form-control">
                                <option value="district1">District 1</option>
                                <option value="district2">District 2</option>
                                <option value="district3">District 3</option>
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

    <script>
        var phoneNumberIndex = 0;

        function addPhoneNumber() {
            var phoneNumbersSection = document.getElementById('phoneNumbersSection');
            var phoneNumbersCount = phoneNumbersSection.querySelectorAll('.input-group').length;

            if (phoneNumbersCount < 3) {
                // Clone the input group
                var clone = phoneNumbersSection.querySelector('.input-group').cloneNode(true);

                // Assign a unique index to the new phone number input field
                phoneNumberIndex++;
                clone.querySelector('input').name = 'phone_numbers[' + phoneNumberIndex + ']';
                clone.querySelector('input').value = '';

                // Append the clone to the phoneNumbersSection
                phoneNumbersSection.appendChild(clone);
            }
        }

        function removePhoneNumber(button) {
            var phoneNumbersSection = document.getElementById('phoneNumbersSection');
            var phoneNumbersCount = phoneNumbersSection.querySelectorAll('.input-group').length;

            if (phoneNumbersCount > 1) {
                // Remove the parent input group of the clicked delete button
                button.parentNode.parentNode.remove();
            }
        }

        function updateUpazila() {
            var districtId = $('#district').val();

            // Make an Ajax request to get upazila data
            $.ajax({
                url: '/get-upazilas/' + districtId,
                type: 'GET',
                success: function(response) {
                    console.log('Upazila data:', response);

                    // Clear and populate the upazila select options
                    $('#upazila').empty();
                    $.each(response, function(key, value) {
    $('#upazila').append('<option value="' + key + '">' + value + '</option>');
});
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
