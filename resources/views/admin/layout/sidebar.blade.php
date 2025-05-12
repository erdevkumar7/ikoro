  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/admin/dashboard') }}" class="brand-link">
          <img src="{{ asset('resources/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              <!-- <i class="right fas fa-angle-left"></i> -->
                          </p>
                      </a>
                  </li>

                  <!--

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link a">
              <i class="nav-icon fas fa-hotel"></i>
              <p>
                Hotel Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Hotels
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/hotelList') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Hotels List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/hotelAndStays_list') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Hotel & Stays</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/hotelReviewRatingList') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Hotel Review & Rating</p>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Rooms
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/roomlist') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Room List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/room_type_categories') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Room Types List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/roomNameList') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Room Name List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                  Amenities
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/hotelAmenity_list') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Amenity List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/hotelAmenityType_list') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Amenity Type</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Booking List
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/booking_list') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Room Booking List
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/rooms_approval_booking_list') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Approval Booking List
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>








          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-bus"></i>
              <p>
                Tour Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ url('/admin/tourTypeList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/tourSubTypeList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour Sub Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/tourList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour List</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Booking List
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/tourbooking_list') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tour Booking List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/tour_approval_booking_list') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Approval Booking List
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/customtourList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request Custom Tour List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/tourReviewRatingList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tour Review & Rating List</p>
                </a>
              </li>
            </ul>
          </li>







          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-archway"></i>
              <p>
                Space Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/space-list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Space List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Booking List
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/spaceBookingList') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Space Booking List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/space_approval_booking_list') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Approval Booking List
                      </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Space Category
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/space-category') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Category</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/space-subcategory') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Sub Category</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/spaceReviewRatingList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Space Review & Rating</p>
                </a>
              </li>
            </ul>
          </li>
    







          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Events Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/events_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Events List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/eventbooking_list') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Events Booking</p>
                </a>
              </li>
            </ul>
          </li>





          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/customer_management') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/scoutList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Scout List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/serviceProviderList') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Service Provider list</p>
                </a>
              </li>
            </ul>
          </li>






          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Transactions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ url('/admin/transactionHistory') }}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Transaction History</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('/admin/tourtransactionHistory') }}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Tour Transaction History</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ url('/admin/spacetransactionHistory') }}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Space Transaction History</p>
                  </a>
              </li>
            </ul>
          </li>






          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                CMS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/banner_management') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/showStaticData') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Static Pages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/showContactData') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Us</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Us</p>
                  <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('/admin/showAboutBanner') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Banner</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/showAboutContent') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Content Section</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('/admin/showChooseUs') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Why Choose Us</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>







          <li class="nav-item">
            <a href="{{ url('/admin/globalTime') }}" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Global Time
              </p>
            </a>
          </li>



          
          <li class="nav-item">
            <a href="{{ url('/admin/blogList') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Blog List
              </p>
            </a>
          </li>
-->


                  <li class="nav-item">
                      <a href="{{ url('/admin/tasks') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Tasks
                          </p>
                      </a>
                  </li>



                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                              Booking
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/booking/list/new_order') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>New Orders</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/booking/list/pending') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Pending Tasks</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/booking/list/completed') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Completed</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/booking/report-problem') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Report a Problem</p>
                              </a>
                          </li>
                      </ul>
                  </li>




                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                              Manage Hosts
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ url('/admin/hosts') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Pending</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/hosts/approved') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Approved</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ url('/admin/hosts/blocked') }}" class="nav-link">
                                  <i class="far fa-dot-circle nav-icon"></i>
                                  <p>Blocked</p>
                              </a>
                          </li>
                      </ul>
                  </li>



                  <li class="nav-item">
                      <a href="{{ url('/admin/users') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Manage Users
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ url('/admin/locations') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Locations
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ url('/admin/payments') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Payments
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ url('/admin/support') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Support
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ url('/admin/admin/problems') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Problems
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('admin.commission.form') }}" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Commission
                          </p>
                      </a>
                  </li>


              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
