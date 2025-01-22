@extends('host.layouts.app')
@section('title', 'Tasks')
@section('content')
  <div class="container-fluid" style="width: 93%;">
    <div class="container-fluid mt-4">
      <div class="row align-items-center">
        <!-- Heading on the left -->
        <div class="col-md-4 text-md-left">
          <h4>Manage Tasks</h4>
        </div>

        <!-- Form on the right -->
        <div class="col-md-8 text-md-right">
          <button class=" btn btn-outline-success my-2 my-sm-0" id="openModalBtn">Add New Task</button>
        </div>
        <div id="simpleModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Tasks</h2>
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
                <button type="submit" class="submit-btn btn btn-outline-success text-right">Save Task</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <table class="table table-responsive-md table-responsive-sm table-bordered mt-4">
      <thead>
        <tr>
          <th scope="col">Task Location</th>
          <th scope="col">Host Gender</th>
          <th scope="col">Date/Time</th>
          <th scope="col">Live App Id</th>
          <th scope="col">Breifying</th>
          <th scope="col">Pay</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Roof</th>
          <td>Murree</td>
          <td>Male</td>
          <td>12-04-2024</td>
          <td>12-34-56</td>
          <td>stripe</td>
          <td class="action-td-width"><a class=" btn btn-outline-success" href="">Pending</a></td>
        </tr>
        <tr>
          <th scope="row">Roof</th>
          <td>Murree</td>
          <td>Male</td>
          <td>12-04-2024</td>
          <td>12-34-56</td>
          <td>stripe</td>
          <td class="action-td-width"><a class=" btn btn-outline-success" href="">Pending</a></td>
        </tr>
        <tr>
          <th scope="row">Roof</th>
          <td>Murree</td>
          <td>Female</td>
          <td>12-04-2024</td>
          <td>12-34-56</td>
          <td>Paypal</td>
          <td class="action-td-width"><a class=" btn btn-outline-success" href="">Pending</a></td>
        </tr>
        <tr>
          <th scope="row">Roof</th>
          <td>Murree</td>
          <td>Male</td>
          <td>12-04-2024</td>
          <td>12-34-56</td>
          <td>stripe</td>
          <td class="action-td-width"><a class=" btn btn-outline-success" href="">Pending</a></td>
        </tr>
        <tr>
          <th scope="row">Roof</th>
          <td>Murree</td>
          <td>Male</td>
          <td>12-04-2024</td>
          <td>12-34-56</td>
          <td>stripe</td>
          <td class="action-td-width"><a class=" btn btn-outline-success" href="">Completed</a></td>
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