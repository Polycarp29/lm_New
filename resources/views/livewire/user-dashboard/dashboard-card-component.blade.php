<div class="col-lg-6 col-12">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <span class="mask bg-primary opacity-10 border-radius-lg"></span>
          <div class="card-body p-3 position-relative">
            <div class="row">
              <div class="col-8 text-start">
                <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                  <i class="ni ni-circle-08 text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                </div>
                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                  {{ $countTasks }}
                </h5>
                <span class="text-white text-sm">Your Tasks</span>
              </div>
              <div class="col-4">
                <div class="dropdown text-end mb-6">
                  <a href="javascript:;" class="cursor-pointer" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-h text-white"></i>
                  </a>
                </div>
                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+55%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
        <div class="card">
          <span class="mask bg-dark opacity-10 border-radius-lg"></span>
          <div class="card-body p-3 position-relative">
            <div class="row">
              <div class="col-8 text-start">
                <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                  <i class="ni ni-active-40 text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                </div>
                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                  {{ $totalEarnings }}
                </h5>
                <span class="text-white text-sm">Total Earnings</span>
              </div>
              <div class="col-4">
                <div class="dropstart text-end mb-6">
                  <a href="javascript:;" class="cursor-pointer" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-h text-white"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
          <span class="mask bg-dark opacity-10 border-radius-lg"></span>
          <div class="card-body p-3 position-relative">
            <div class="row">
              <div class="col-8 text-start">
                <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                  <i class="ni ni-cart text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                </div>
                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                  {{ $rejectedTasks }}
                </h5>
                <span class="text-white text-sm">Rejected Tasks</span>
              </div>
              <div class="col-4">
                <div class="dropdown text-end mb-6">
                  <a href="javascript:;" class="cursor-pointer" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-h text-white"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
        <div class="card">
          <span class="mask bg-dark opacity-10 border-radius-lg"></span>
          <div class="card-body p-3 position-relative">
            <div class="row">
              <div class="col-8 text-start">
                <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                  <i class="ni ni-like-2 text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                </div>
                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                  {{ $approvedTasks }}
                </h5>
                <span class="text-white text-sm">Approved</span>
              </div>
              <div class="col-4">
                <div class="dropstart text-end mb-6">
                  <a href="javascript:;" class="cursor-pointer" id="dropdownUsers4" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-h text-white"></i>
                  </a>
                </div>
                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+90%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
