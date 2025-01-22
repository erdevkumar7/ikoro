@extends('host.layouts.app')
@section('title', 'Destinations')
@section('content')
  <div class="container">
      <div class="container-fluid mb-3">
          <div class="row align-items-center">
              <!-- Heading on the left -->
              <div class="col-md-4 text-md-left">
                  <h4>Manage Destination</h4>
              </div>
              <!-- Form on the right -->
              <div class="col-md-8 text-md-right">
                  <button class=" btn btn-outline-success my-2 my-sm-0" id = "openModalBtn">Add New
                      Destination</button>
              </div>
              <div id="simpleModal" class="modal">
                  <div class="modal-content">
                      <span class="close">&times;</span>
                      <h2>Add New Destination</h2>
                      <form id="taskForm">
                          <div class="form-group">
                              <label for="Country">Country</label>
                              <select id="Country" required>
                                  <option value="" disabled selected>Select Country</option>
                                  <option value="Pakistan">Pakistan</option>
                                  <option value="EUROPE">EUROPE</option>
                                  <option value="GERMANY">GERMANY</option>
                                  <!-- Add more Country options as needed -->
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="City">City</label>
                              <select id="City" required>
                                  <option value="" disabled selected>Select City</option>
                                  <option value="RAWALPINDI">RAWALPINDI</option>
                                  <option value="KARACHI">KARACHI</option>
                                  <option value="LAHORE">LAHORE</option>
                                  <!-- Add more City options as needed -->
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="State">State</label>
                              <select id="State" required>
                                  <option value="" disabled selected>Select State</option>
                                  <option value="CALIFORNIA">CALIFORNIA</option>
                                  <option value="CALIFORNIA">CALIFORNIA</option>
                                  <option value="CALIFORNIA">CALIFORNIA</option>
                                  <!-- Add more State options as needed -->
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="ZipCode">ZipCode</label>
                              <select id="ZipCode" required>
                                  <option value="" disabled selected>Select ZipCode</option>
                                  <option value="46000">46000</option>
                                  <option value="45000">45000</option>
                                  <option value="44000">44000</option>
                                  <!-- Add more ZipCodey options as needed -->
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="description">Description</label>
                              <textarea id="description" rows="3" placeholder="Enter task description" required></textarea>
                          </div>
                          <div class="text-end">
                              <button type="submit" class="submit-btn btn btn-outline-success text-right">Save
                                  Task</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <table class="table table-responsive-md table-responsive-sm table-bordered">
          <thead>
              <tr>
                  <th scope="col">Task Title</th>
                  <th scope="col" colspan="2">Description</th>
                  <th scope="col">Price</th>
                  <th scope="col">Price/hr</th>
                  <th scope="col">Currency</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            <tr>
                <td colspan="7" class="text-center">Under Development</td>
            </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-end">
              <li class="page-item"></li>
          </ul>
      </nav>


  </div>
@endsection
