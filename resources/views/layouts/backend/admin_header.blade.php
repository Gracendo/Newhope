<!-- Header Section starts -->
        <header class="header-main">
          <div class="container-fluid">
            <div class="row">
              <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
                <span class="header-toggle me-3">
                  <i class="ph ph-circles-four"></i>
                </span>
              </div>

              <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">

                <ul class="d-flex align-items-center">

                  

                  <li class="header-language">
                    <div id="lang_selector" class="flex-shrink-0 dropdown">
                      <a href="#" class="d-block head-icon ps-0" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="lang-flag lang-en ">
                          <span class="flag rounded-circle overflow-hidden">
                            <i class=""></i>
                          </span>
                        </div>
                      </a>
                      <ul class="dropdown-menu language-dropdown header-card border-0">
                        <li class="lang lang-en selected dropdown-item p-2" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="US">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-usa flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">US</span>
                          </span>
                        </li>
                        <li class="lang lang-pt dropdown-item p-2" title="FR">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-fra flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">France</span>
                          </span>
                        </li>
                        <li class="lang lang-es dropdown-item p-2" title="UK">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-gbr flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">UK</span>
                          </span>
                        </li>
                        <li class="lang lang-es dropdown-item p-2" title="IT">
                          <span class="d-flex align-items-center">
                            <i class="flag-icon flag-icon-ita flag-icon-squared b-r-10 f-s-22"></i>
                            <span class="ps-2">Italy</span>
                          </span>
                        </li>
                      </ul>
                    </div>

                  </li>

                  <li class="header-searchbar">
                    <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                      <i class="ph ph-magnifying-glass"></i>
                    </a>

                    <div class="offcanvas offcanvas-end header-searchbar-canvas" tabindex="-1" id="offcanvasRight"
                         aria-labelledby="offcanvasRight">
                      <div class="header-searchbar-header">
                        <div class="d-flex justify-content-between mb-3">
                          <form class="app-form app-icon-form w-100" action="#">
                            <div class="position-relative">
                              <input type="search" class="form-control search-filter" placeholder="Search..."
                                     aria-label="Search">
                              <i class="ti ti-search text-dark"></i>
                            </div>
                          </form>

                          <div class="app-dropdown flex-shrink-0">
                            <a class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-secondary search-list-avtar ms-2"
                               href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                               aria-expanded="false">
                              <i class="ph-duotone  ph-gear f-s-20"></i>
                            </a>

                            <ul class="dropdown-menu mb-3">
                              <li class="dropdown-item mt-2">
                                <a href="#">
                                  <h6 class="mb-0">Search Settings</h6>
                                </a>
                              </li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between">
                                <a href="#">
                                  <h6 class="mb-0 text-secondary f-s-14">Safe Search Filtering</h6>
                                </a>
                                <div class="flex-shrink-0">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" type="checkbox" id="searchSwitch"
                                           checked>
                                  </div>
                                </div>
                              </li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between">
                                <a href="#">
                                  <h6 class="mb-0 text-secondary f-s-14">Search Suggestions</h6>
                                </a>
                                <div class="flex-shrink-0">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" type="checkbox"
                                           id="searchSwitch1">
                                  </div>
                                </div>
                              </li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 text-secondary f-s-14"> Search History</h6>
                                <i class="ti ti-message-circle me-3  text-success"></i>
                              </li>
                              <li class="dropdown-divider"></li>
                              <li class="dropdown-item d-flex align-items-center justify-content-between mb-2">
                                <a href="#">
                                  <h6 class="mb-0 text-dark f-s-14">Custom Search Preferences</h6>
                                </a>
                                <div class="flex-shrink-0">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input form-check-primary" type="checkbox"
                                           id="searchSwitch2">
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <p class="mb-0 text-secondary f-s-15 mt-2">Recently Searched Data:</p>
                      </div>
                      <div class="offcanvas-body app-scroll p-0">
                        <div>
                          <ul class="search-list">
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-secondary search-list-avtar">
                                <i class="ph-duotone  ph-gear f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="api.html" target="_blank"><h6 class="mb-0 text-dark">user management</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#RA789</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-warning search-list-avtar">
                                <i class="ph-duotone  ph-projector-screen-chart f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="privacy_policy.html" target="_blank"><h6 class="mb-0 text-dark">data visualization</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#RY810</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-dark search-list-avtar">
                                <i class="ph-duotone  ph-shield-check f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="terms_condition.html" target="_blank"><h6 class="mb-0 text-dark">security protocols</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#ATR56</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-primary search-list-avtar">
                                <i class="ph-duotone  ph-app-window f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="sign_in.html" target="_blank"><h6 class="mb-0 text-dark">authentication methods</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#YE615</p>
                              </div>
                            </li>
                            <li class="search-list-item">
                              <div
                                      class="h-35 w-35 d-flex-center b-r-15 overflow-hidden bg-light-dark search-list-avtar">
                                <i class="ph-duotone  ph-table f-s-20"></i>
                              </div>
                              <div class="search-list-content">
                                <a href="data_table.html" target="_blank"><h6 class="mb-0 f-s-16 text-dark">Data Table</h6></a>
                                <p class="f-s-13 mb-0 text-secondary">#YE615</p>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="header-apps">
                    <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#appscanvasRights" aria-controls="appscanvasRights">
                      <i class="ph ph-bounding-box"></i>

                    </a>

                    <div class="offcanvas offcanvas-end header-apps-canvas" tabindex="-1" id="appscanvasRights"
                         aria-labelledby="appscanvasRightsLabel">
                      <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="appscanvasRightsLabel">Shortcut</h5>
                        <div class="app-dropdown flex-shrink-0">
                          <a class=" p-1" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                             aria-expanded="false">
                            <i class="ph-bold  ph-faders-horizontal f-s-20"></i>
                          </a>
                          <ul class="dropdown-menu mb-3 p-2">
                            <li class="dropdown-item">
                              <a href="setting.html" target="_blank">
                                Privacy Settings
                              </a>
                            </li>
                            <li class="dropdown-item">
                              <a href="setting.html" target="_blank">
                                Account Settings
                              </a>
                            </li>
                            <li class="dropdown-item">
                              <a href="setting.html" target="_blank">
                                Accessibility
                              </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item border-0">
                              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More Settings
                              </a>
                              <ul class="dropdown-menu sub-menu">
                                <li class="dropdown-item">
                                  <a href="setting.html" target="_blank">
                                    Backup and Restore
                                  </a>
                                </li>
                                <li class="dropdown-item">
                                  <a href="setting.html" target="_blank">
                                    <span>Data Usage</span>
                                  </a>
                                </li>
                                <li class="dropdown-item">
                                  <a href="setting.html" target="_blank">
                                    <span>Theme</span>
                                  </a>
                                </li>
                                <li class="dropdown-item d-flex align-items-center justify-content-between">
                                  <a href="#">
                                    <p class="mb-0">Notification</p>
                                  </a>
                                  <div class="flex-shrink-0">
                                    <div class="form-check form-switch">
                                      <input class="form-check-input  form-check-primary" type="checkbox"
                                             id="notificationSwitch">
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </li>

                          </ul>
                        </div>
                      </div>
                      <div class="offcanvas-body app-scroll">
                        <div class="row row-cols-3">
                          <div class="d-flex-center text-center mb-3">
                            <a href="product.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-shopping-bag-open text-success f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">E-shop</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="email.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-envelope text-danger f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Email</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="chat.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-chat-circle-text text-info f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Chat</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="project_app.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-projector-screen-chart text-warning f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Project</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-light text-center mb-3">
                            <a href="invoice.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-scroll text-secondary f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Invoice</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="blog.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-notebook text-primary f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Blog</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="calendar.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-calendar text-dark f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Calender</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="file_manager.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-folder-open text-warning f-s-30"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">File Manager</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="gallery.html " target="_blank">
                              <span>
                                <i class="ph-duotone  ph-google-photos-logo f-s-30 text-success"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Gallery</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="profile.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-users-three f-s-30 text-primary"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Profile</p>
                            </a>
                          </div>
                          <div class="d-flex-center text-center mb-3">
                            <a href="kanban_board.html" target="_blank">
                              <span>
                                <i class="ph-duotone  ph-selection-foreground f-s-30 text-secondary"></i>
                              </span>
                              <p class="mb-0 f-w-500 text-secondary">Task Board</p>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="header-dark">
                    <div class="sun-logo head-icon">
                      <i class="ph ph-moon-stars"></i>
                    </div>
                    <div class="moon-logo head-icon">
                      <i class="ph ph-sun-dim"></i>
                    </div>
                  </li>

                  <li class="header-notification">
                    <a href="#" class="d-block head-icon position-relative" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#notificationcanvasRight" aria-controls="notificationcanvasRight">
                      <i class="ph ph-bell"></i>
                      <span
                              class="position-absolute translate-middle p-1 bg-success border border-light rounded-circle animate__animated animate__fadeIn animate__infinite animate__slower"></span>
                    </a>
                    <div class="offcanvas offcanvas-end header-notification-canvas" tabindex="-1"
                         id="notificationcanvasRight" aria-labelledby="notificationcanvasRightLabel">
                      <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="notificationcanvasRightLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body app-scroll p-0">
                        <div class="head-container">
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="../assets/images/ai_avtar/6.jpg" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute bottom-30 end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">

                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-500 text-secondary">Gene Hart</span> wants to edit <span
                                      class="f-w-500 text-secondary">Report.doc</span></a>
                              <div>
                                <a class="d-inline-block f-w-500 text-success me-1" href="#">Approve</a>
                                <a class="d-inline-block f-w-500 text-danger" href="#">Deny</a>
                              </div>
                              <span class="badge text-light-secondary mt-2"> sep 23 </span>

                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-light-dark h-35 w-35 d-flex-center b-r-10 position-relative">
                                <i class="ph-duotone  ph-truck f-s-18"></i>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0">Hey <span
                                      class="f-w-500 text-secondary">Emery McKenzie</span>, get ready: Your order from <span
                                      class="f-w-500 text-secondary">@Shopper.com</span> is out for delivery today!</a>
                              <span class="badge text-light-secondary mt-2"> sep 23 </span>

                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="../assets/images/ai_avtar/2.jpg" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute  end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-500 text-secondary">Simon Young</span> shared a file called <span
                                      class="f-w-500 text-secondary">Dropdown.pdf</span></a>
                              <span class="badge text-light-secondary mt-2"> 30 min</span>

                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="../assets/images/ai_avtar/5.jpg" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-500 text-secondary">Becky G. Hayes</span> has added a comment to <span
                                      class="f-w-500 text-secondary">Final_Report.pdf</span></a>
                              <span class="badge text-light-secondary mt-2"> 45 min</span>
                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>
                          <div class="notification-message head-box">
                            <div class="message-images">
                              <span class="bg-secondary h-35 w-35 d-flex-center b-r-10 position-relative">
                                <img src="../assets/images/ai_avtar/1.jpg" alt="" class="img-fluid b-r-10">
                                <span
                                        class="position-absolute  end-0 p-1 bg-secondary border border-light rounded-circle notification-avtar"></span>
                              </span>
                            </div>
                            <div class="message-content-box flex-grow-1 ps-2">
                              <a href="./read_email.html" class="f-s-15 text-secondary mb-0"><span
                                      class="f-w-600 text-secondary">Romaine Nadeau</span> invited you to join a meeting
                              </a>
                              <div>
                                <a class="d-inline-block f-w-500 text-success me-1" href="#">Join</a>
                                <a class="d-inline-block f-w-500 text-danger" href="#">Decline</a>
                              </div>

                              <span class="badge text-light-secondary mt-2"> 1 hour ago </span>
                            </div>
                            <div class="align-self-start text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                            </div>
                          </div>

                          <div class="hidden-massage py-4 px-3">
                            <img src="../assets/images/icons/bell.png" class="w-50 h-50 mb-3 mt-2" alt="">
                            <div>
                              <h6 class="mb-0">Notification Not Found</h6>
                              <p class="text-secondary">When you have any notifications added here,will
                                appear here.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </li>
                  @php
                    $profile_img = get_attachment_image_by_id(auth()->user()->image,null,true);
                  @endphp
                  <li class="header-profile">
                    <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#profilecanvasRight" aria-controls="profilecanvasRight">
                      @if (!empty($profile_img))
                        <img src="{{$profile_img['img_url']}}" alt="{{auth()->user()->first_name}}" class="b-r-10 h-35 w-35">
                      @endif
                    </a>

                    <div class="offcanvas offcanvas-end header-profile-canvas" tabindex="-1" id="profilecanvasRight"
                         aria-labelledby="profilecanvasRight">
                      <div class="offcanvas-body app-scroll">
                        <ul class="">
                          <li>
                            @if (!empty($profile_img))
                              <div class="d-flex-center">
                                <span class="h-45 w-45 d-flex-center b-r-10 position-relative">
                                  <img src="{{$profile_img['img_url']}}" alt="{{auth()->user()->first_name}}" class="img-fluid b-r-10">
                                </span>
                              </div>
                            @endif
                            <div class="text-center mt-2">
                              <h6 class="mb-0"> {{ Auth::user()->first_name }}</h6>
                              <p class="f-s-12 mb-0 text-secondary">{{ Auth::user()->email }}</p>
                            </div>
                          </li>

                          <li class="app-divider-v dotted py-1"></li>
                          <li>
                            <a class="f-w-500" href="{{route('admin.profile')}}">
                              <i class="ph-duotone  ph-user-circle pe-1 f-s-20"></i> {{__('Edit Profile')}}
                            </a>
                          </li>
                          <li>
                            <a class="f-w-500" href="{{route('admin.password.change')}}">
                              <i class="ph-duotone  ph-gear pe-1 f-s-20"></i> Update password
                            </a>
                          </li>
                          
                          <li class="app-divider-v dotted py-1"></li>

                          <li>
                            <a class="mb-0 text-danger" href="{{ route('admin.logout') }}">
                              <i class="ph-duotone  ph-sign-out pe-1 f-s-20"></i> {{ __('Logout') }}
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </header>
        <!-- Header Section ends -->