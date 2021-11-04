<style type="text/css">

  div#table_main_div{
    overflow: auto;
  }
  table.table{
    margin-bottom: 1%;
  }

  @media screen and (max-width: 860px) {
    button.width_filter{
      width:4rem;
    }
} 
  @media screen and (max-width: 767px) {
    button.width_filter{
      width:6rem;
    }
  }
</style>       
            <!-- BEGIN: Content -->
            <div class="content">
                           <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Urbanfence</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Sales List</a> </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                 <?php include(APPPATH."views/inc/account_menu.php")?>
                <!-- END: Account Menu -->
            </div>
            <!-- BEGIN: Filters -->
              <div class="intro-y grid grid-cols-12 p-5 mt-5 gap-2 box">
                <h2 class="col-span-12 font-medium text-base  border-b border-gray-200">Filters</h2>
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                  <div class=""> <label>Sales Person</label>
                      <div class="mt-1"> <select class="select2 w-full">
                                <option>Chris Evans</option>
                                <option>Liam Neeson</option>
                                <option>Daniel Craig</option>
                           </select> 
                      </div>
                  </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                  <div> <label>Jobs Per Month</label>
                      <div class="mt-1"> <select class="select2 w-full">
                                <option>APR</option>
                                <option>MAY</option>
                                <option>JUN</option>
                           </select> 
                      </div>
                  </div>
                </div>
                 <div class="col-span-12 sm:col-span-6 md:col-span-4">
                  <div> <label>Jobs per Date</label>
                      <div class="mt-1 relative"> <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"> <i data-feather="calendar" class="w-4 h-4"></i> </div> <input type="text" class="datepicker input pl-12 border w-full">
                      </div>
                  </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                  <div> <label>City</label>
                      <div class="mt-1"> <select class="select2 w-full">
                                <option>Klinburg</option>
                                <option>Vaughan</option>
                                <option>Maple</option>
                           </select> 
                      </div>
                  </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4">
                  <div> <label>Job Total bigger than</label>
                      <div class="mt-1"> <select class="select2 w-full">
                                <option>10,000</option>
                                <option>20,000</option>
                                <option>30,000</option>
                           </select> 
                      </div>
                  </div>
                </div>
               
                <div class="col-span-12 sm:col-span-6 md:col-span-4 flex items-end">
                  <div>
                    <button class="button w-24 mr-1  bg-theme-1 text-white">Clear filter</button> <button  class="button w-24 mr-1 width_filter bg-theme-6 text-white">filter</button>
                  </div>
                </div>
               </div> 
            <!-- END: Filters -->

            <!-- BEGIN: Datatable -->
                <div class="intro-y box p-5 mt-5" id="table_main_div">
                    <table class="table table-report table-report--bordered display datatable">
                        <thead>
                            <tr>
                                <th class="border-b-2">Job ID</th>
                                <th class="border-b-2 text-center">Customer</th>
                                <th class="border-b-2 text-center">Job Type</th>
                                <th class="border-b-2 text-center">Job City</th>
                                <th class="border-b-2 text-center">Sales Person</th>
                                <th class="border-b-2 text-center">Date</th>
                               
                                <th class="border-b-2 text-center">Job Price</th>
                                <th class="border-b-2 text-center">Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                               <td class="text-center border-b">000001</td>
                               <td class="text-center border-b">Aviad Kriaf</td>
                               <td class="text-center border-b">New Fence</td>
                               <td class="text-center border-b">Concord</td>
                               <td class="text-center border-b">David</td>
                               <td class="text-center border-b">10/6/20</td>
                               
                               <td class="text-center border-b">11300</td>
                               <td class="text-center border-b">2000</td>
                           </tr>
                           <tr>
                               <td class="text-center border-b">000001</td>
                               <td class="text-center border-b">Aviad Kriaf</td>
                               <td class="text-center border-b">New Fence</td>
                               <td class="text-center border-b">Concord</td>
                               <td class="text-center border-b">David</td>
                               <td class="text-center border-b">10/6/20</td>
                               
                               <td class="text-center border-b">11300</td>
                               <td class="text-center border-b">2000</td>
                           </tr><tr>
                               <td class="text-center border-b">000001</td>
                               <td class="text-center border-b">Aviad Kriaf</td>
                               <td class="text-center border-b">New Fence</td>
                               <td class="text-center border-b">Concord</td>
                               <td class="text-center border-b">David</td>
                               <td class="text-center border-b">10/6/20</td>
                               
                               <td class="text-center border-b">11300</td>
                               <td class="text-center border-b">2000</td>
                           </tr><tr>
                               <td class="text-center border-b">000001</td>
                               <td class="text-center border-b">Aviad Kriaf</td>
                               <td class="text-center border-b">New Fence</td>
                               <td class="text-center border-b">Concord</td>
                               <td class="text-center border-b">David</td>
                               <td class="text-center border-b">10/6/20</td>
                               
                               <td class="text-center border-b">11300</td>
                               <td class="text-center border-b">2000</td>
                           </tr><tr>
                               <td class="text-center border-b">000001</td>
                               <td class="text-center border-b">Aviad Kriaf</td>
                               <td class="text-center border-b">New Fence</td>
                               <td class="text-center border-b">Concord</td>
                               <td class="text-center border-b">David</td>
                               <td class="text-center border-b">10/6/20</td>
                               
                               <td class="text-center border-b">11300</td>
                               <td class="text-center border-b">2000</td>
                           </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->
            </div>
            <!-- END: Content -->
