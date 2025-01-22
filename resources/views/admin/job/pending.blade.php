@extends('admin.layouts.app')
@section('title', 'Pending Jobs')
@section('content')
  <div class="container-fluid" style="width: 93%;">
      <div class="container-fluid mt-4">
          <div class="row align-items-center">
              <!-- Heading on the left -->
              <div class="col-md-4 text-md-left">
                  <h4>My Jobs / Pending Jobs</h4>
              </div>

              <!-- Form on the right -->
              <div class="col-md-8 text-md-right">
                  <button class=" btn btn-outline-success my-2 my-sm-0" id = "openModalBtn">Add New
                      Booking</button>
              </div>
              <div id="simpleModal" class="modal">
                  <div class="modal-content">
                      <span class="close">&times;</span>
                      <h2>Add New Booking</h2>
                      <form id="taskForm">
                          <div class="form-group">
                              <label for="country">Country</label>
                              <select id="country" required>
                                  <option value="" disabled selected>Select country</option>
                                  <option value="USD">PAKISTAN</option>
                                  <option value="EUR">ENGLAND</option>
                                  <option value="GBP">KOREA</option>
                                  <!-- Add more country options as needed -->
                              </select>
                          </div>
                          <div class="form-group row">
                              <div class="col">
                                  <label for="state">State</label>
                                  <input type="text" id="state" placeholder="Enter state" required>
                              </div>
                              <div class="col">
                                  <label for="zipcode">ZipCode</label>
                                  <input type="text" id="zipcode" placeholder="Enter zipcode" required>
                              </div>
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
      <table class="table table-responsive-md table-responsive-sm table-bordered mt-4">
          <thead>
              <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Country</th>
                  <th scope="col">State</th>
                  <th scope="col">Zipcode</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <th scope="row">Roof</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                  <td>4600</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">Roof</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                  <td>4600</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">Roof</th>
                  <td>Prince</td>
                  <td>Toronto</td>
                  <td>@cat</td>
                  <td>4600</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">Roof</th>
                  <td>Jani</td>
                  <td>Thialand</td>
                  <td>@rat</td>
                  <td>4600</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">Roof</th>
                  <td>Jacob Oram</td>
                  <td>China</td>
                  <td>@bat</td>
                  <td>4600</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">Roof</th>
                  <td>Shayan</td>
                  <td>Islamabad</td>
                  <td>@Sat</td>
                  <td>4600</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
          </tbody>
      </table>
      <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-end">
              <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                  </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                  </a>
              </li>
          </ul>
      </nav>


  </div>
@endsection