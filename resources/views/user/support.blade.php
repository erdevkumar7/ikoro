@extends('user.layouts.app')
@section('title', 'Support')
@section('content')
  <div class="container-fluid" style="width: 93%;">
      <div class="container-fluid mt-4">
          <div class="row align-items-center">
              <!-- Heading on the left -->
              <div class="col-md-4 text-md-left">
                  <h4>Tickets</h4>
              </div>

              <!-- Form on the right -->
              <div class="col-md-8 text-md-right">
                  <button class=" btn btn-outline-success my-2 my-sm-0" id = "openModalBtn">Generate
                      Ticket</button>
              </div>
              <div id="simpleModal" class="modal">
                  <div class="modal-content">
                      <span class="close">&times;</span>
                      <h2>Your Ticket</h2>
                      <form id="taskForm">
                          <div class="form-group row">
                              <div class="col">
                                  <label for="Title">Title</label>
                                  <input type="text" id="Title" placeholder="Enter Title" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="description">Description</label>
                              <textarea id="description" rows="3" placeholder="Enter task description" required></textarea>
                          </div>
                          <div class="form-group">
                              <label for="myfile">Select a file:</label>
                              <input type="file" id="myfile" name="myfile">
                          </div>

                          <div class="text-end">
                              <button type="submit"
                                  class="submit-btn btn btn-outline-success text-right">Submit</button>
                          </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
      <table class="table table-responsive-md table-responsive-sm table-bordered mt-4">
          <thead>
              <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Title</th>
                  <th scope="col">Staus</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <th scope="row">20/4/2024</th>
                  <td>Issue</td>
                  <td>Approved</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">20/4/2024</th>
                  <td>Issue</td>
                  <td>Approved</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">20/4/2024</th>
                  <td>Issue</td>
                  <td>Approved</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">20/4/2024</th>
                  <td>Issue</td>
                  <td>Approved</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">20/4/2024</th>
                  <td>Issue</td>
                  <td>Approved</td>
                  <td class="action-td-width"><a href="#"
                          class=" btn btn-outline-success" href="">View</a></td>
              </tr>
              <tr>
                  <th scope="row">20/4/2024</th>
                  <td>Issue</td>
                  <td>Approved</td>
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
