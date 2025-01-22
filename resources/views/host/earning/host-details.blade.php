@extends('host.layouts.app')
@section('title', 'Host Details')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/Host-Details.css') }}">
    @endpush
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Entry Form For Host</h5>
                        <form action="/submit-signup" method="post" class="host-form">
                            <div class="form-row">
                                <!-- Name -->
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <!-- Sex -->
                                <div class="form-group col-md-6">
                                    <label for="sex">Sex</label>
                                    <select class="form-control" id="sex" name="sex" required>
                                        <option value="" disabled selected>Select your gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Country -->
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>

                                <!-- State -->
                                <div class="form-group col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- City -->
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>

                                <!-- ZIP CODE -->
                                <div class="form-group col-md-6">
                                    <label for="zipCode">ZIP CODE</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Best Task Offered -->
                                <div class="form-group col-md-6">
                                    <label for="bestTask">Best Task Offered</label>
                                    <input type="text" class="form-control" id="bestTask" name="bestTask" required>
                                </div>

                                <!-- Available Hours -->
                                <div class="form-group col-md-6">
                                    <label for="availableHours">Available Hours</label>
                                    <input type="text" class="form-control" id="availableHours" name="availableHours"
                                        required>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Email -->
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <!-- Phone -->
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- WhatsApp No. -->
                                <div class="form-group col-md-6">
                                    <label for="whatsappNo">WhatsApp No.</label>
                                    <input type="tel" class="form-control" id="whatsappNo" name="whatsappNo">
                                </div>

                                <!-- Skype Id -->
                                <div class="form-group col-md-6">
                                    <label for="skypeId">Skype Id</label>
                                    <input type="text" class="form-control" id="skypeId" name="skypeId">
                                </div>
                            </div>

                            <!-- Enrollment Briefing Date/Time -->
                            <div class="form-group" style="padding-bottom: 30px;">
                                <label for="enrolmentDateTime">Enrolment Briefing Date / Time</label>
                                <input type="datetime-local" class="form-control" id="enrolmentDateTime"
                                    name="enrolmentDateTime" required>
                            </div>

                            <!-- Bank Information -->
                            <fieldset class="form-group">
                                <legend>Bank Information</legend>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Bank 1</th>
                                            <th>Bank 2</th>
                                            <th>Bank 3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="bankName1">Bank Name</label>
                                                    <input type="text" class="form-control" id="bankName1"
                                                        name="bankName1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bankAccountNumber1">Bank Account Number</label>
                                                    <input type="text" class="form-control" id="bankAccountNumber1"
                                                        name="bankAccountNumber1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="branchCode1">Branch Code</label>
                                                    <input type="text" class="form-control" id="branchCode1"
                                                        name="branchCode1" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="swiftCode1">Swift Code</label>
                                                    <input type="text" class="form-control" id="swiftCode1"
                                                        name="swiftCode1" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="bankName2">Bank Name</label>
                                                    <input type="text" class="form-control" id="bankName2"
                                                        name="bankName2" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bankAccountNumber2">Bank Account Number</label>
                                                    <input type="text" class="form-control" id="bankAccountNumber2"
                                                        name="bankAccountNumber2" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="branchCode2">Branch Code</label>
                                                    <input type="text" class="form-control" id="branchCode2"
                                                        name="branchCode2" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="swiftCode2">Swift Code</label>
                                                    <input type="text" class="form-control" id="swiftCode2"
                                                        name="swiftCode2" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="bankName3">Bank Name</label>
                                                    <input type="text" class="form-control" id="bankName3"
                                                        name="bankName3" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bankAccountNumber3">Bank Account Number</label>
                                                    <input type="text" class="form-control" id="bankAccountNumber3"
                                                        name="bankAccountNumber3" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="branchCode3">Branch Code</label>
                                                    <input type="text" class="form-control" id="branchCode3"
                                                        name="branchCode3" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="swiftCode3">Swift Code</label>
                                                    <input type="text" class="form-control" id="swiftCode3"
                                                        name="swiftCode3" required>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Dropdown -->
                                <div class="btn-group">
                                    <select id="MoreOptions" required>
                                        <option value="" disabled selected>More Options</option>
                                        <option value="USD">Pending Host</option>
                                        <option value="EUR">Approved Host</option>
                                    </select>
                                </div>

                                <!-- Submit and Edit Buttons -->
                                <div class="text-end">
                                    <button type="button" class="btn btn-outline-primary ms-2 mr-4">Edit</button>
                                    <button type="submit" class="submit-btn btn btn-outline-success">Signup</button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection